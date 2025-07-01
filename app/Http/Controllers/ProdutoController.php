<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterProdutoRequest;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\UpdateConsultorRequest;
use App\Models\Categoria;
use App\Models\Consultor;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-produtos', ['only' => ['index']]);
        $this->middleware('permission:show-produtos', ['only' => ['show']]);
        $this->middleware('permission:create-produtos', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-produtos', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-produtos', ['only' => ['destroy']]);
        $this->middleware('permission:alter-produtos', ['only' => ['alter, updateAlter']]);
        $this->middleware('permission:alter-produtos-consultor', ['only' => ['alterConsultor, updateConsultor']]);
        $this->middleware('permission:upload-temporario', ['only' => ['uploadTemporario']]);
        $this->middleware('permission:exportar-produtos', ['only' => ['exportarProdutos']]);
        $this->middleware('permission:alterar-consultor', ['only' => ['alterarConsultor']]);
    }

    public function index(Request $request)
    {
        //Recuperar os consultores
        $consultores = Consultor::orderBy('nome')->get();

        //Recupera usuario logado
        $user = auth()->user();

        //Recuperar os registros no banco de dados conforme parametros do formulario de pesquisa
        $produtos = Produto::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('consultor'), function ($whenQuery) use ($request) {
                $whenQuery->where('consultor_id', '=', $request->consultor);
            })
            ->when($request->filled('codigo'), function ($whenQuery) use ($request) {
                $whenQuery->where('id', '=', $request->codigo);
            })
            ->when($request->filled('situacao'), function ($whenQuery) use ($request) {
                $whenQuery->where('situacao', 'like', $request->situacao);
            })
            ->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
                $whenQuery->where('data_venda', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
                $whenQuery->where('data_venda', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->when(!$user->hasRole(['Admin', 'Super Admin']), function ($query) use ($user) {
                //Se usuario não for admin filtra os produtos do consultor correspondente
                $query->whereHas('Consultor', function ($query) use ($user) {
                    $query->where('email', $user->email);
                });
            })

            ->orderByDesc('nome')
            ->paginate($request->qtde)
            ->withQueryString();

        //Busca consultor_atual caso o código tenha sido informado.
        $consultorAtual = null;
        if ($request->filled('codigo') && !$request->filled('consultor')) {
            $produto = Produto::find($request->codigo);
            if ($produto) {
                $consultorAtual = $produto->consultor_id;
            }
        } else {
            $consultorAtual = $request->consultor;
        }

        //Carregar view
        return view('produtos.index', [
            'menu' => 'produtos',
            'produtos' => $produtos,
            'nome' => $request->nome,
            'consultores' => $consultores,
            'consultorAtual' => $consultorAtual
        ]);
    }

    //Formulario para alocar produto ao consultor
    public function create(Consultor $consultor)
    {
        //Recupera categoria de produtos
        $categorias = Categoria::orderBy('nome')->get();

        //Carrega view
        return view('produtos.create', [
            'consultor' => $consultor,
            'categorias' => $categorias
        ]);
    }

    //Cadastrar e alocar produto para consultor
    public function store(ProdutoRequest $request)
    {
        //Validar o formulario 
        $request->validated();

        $links = [];

        // Verifica se request possui imagens e escreve caminho completo das url's.
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('imagens', 'public');
                $urlCompleta = asset('storage/' . $path);
                $links[] = $urlCompleta;
            }
        }

        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Aloca produto para consultor no banco de dados
            $produto = Produto::create([
                'nome' => $request->nome,
                'preco_fornecedor' => str_replace(',', '.', str_replace('.', '', $request->preco_fornecedor)),
                'preco_final' => str_replace(',', '.', str_replace('.', '', $request->preco_final)),
                'comissao_consultor' => $request->comissao_consultor,
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
                'consultor_id' => $request->consultor_id,
                'categoria_id' => $request->categoria,
                'descricao' => $request->descricao,
                'descricao_curta' => $request->descricao_curta,
                'images' => implode(',', $links)
            ]);

            DB::commit();
            //Calcula valores - lucro consultor e lucro da loja
            $produto->update([
                'lucro_consultor' => $produto->preco_final * ($produto->comissao_consultor / 100)
            ]);
            DB::commit();

            $produto->update([
                'lucro_loja' => $produto->preco_final - $produto->preco_fornecedor - $produto->lucro_consultor
            ]);
            DB::commit();

            //Redireciona com msg de sucesso
            return redirect()->route('consultor.index')
                ->with('success', 'Produto alocado para : ' . $request->consultor . '. Código: ' . $produto->id);
        } catch (Exception $e) {
            //Transação não concluida com exito
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Produto não foi alocado! Tente novamente.' . $e->getMessage());
        }
    }

    //Formulario editar produtos
    public function edit(Produto $produto)
    {
        //Recupera categoria de produtos
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.edit', [
            'produto' => $produto,
            'consultor' => $produto->consultor->nome,
            'categorias' => $categorias
        ]);
    }

    //Atualiza produto no banco de dados
    public function update(ProdutoRequest $request, Produto $produto)
    {
        //Valida o formulario
        $request->validated();

        //Inicio da transação
        DB::beginTransaction();

        try {
            $links = [];

            // Caso usuário envie novas imagens via <input type="file">
            if ($request->hasFile('images')) {
                // Remove imagens antigas
                if ($produto->images) {
                    $imagensAntigas = explode(',', $produto->images);

                    foreach ($imagensAntigas as $imagemUrl) {
                        $path = parse_url($imagemUrl, PHP_URL_PATH);
                        $relativePath = str_replace('/storage/', '', $path);

                        if (Storage::disk('public')->exists($relativePath)) {
                            Storage::disk('public')->delete($relativePath);
                        }
                    }
                }

                // Salva novas imagens
                foreach ($request->file('images') as $file) {
                    $path = $file->store('imagens', 'public');
                    $links[] = asset('storage/' . $path);
                }
            }

            // Caso não tenha novas imagens, mas existam caminhos já salvos via AJAX
            elseif ($request->has('uploaded_images')) {
                foreach ($request->input('uploaded_images') as $tempUrl) {
                    $path = parse_url($tempUrl, PHP_URL_PATH); //storage/temp/arquivo.jpg
                    $relativePath = str_replace('/storage/', '', $path); // temp/arquivo.jpg

                    $filename = basename($relativePath);
                    $newPath = 'imagens/' . $filename;

                    //Move arquivos da pasta temp para imagens
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->move($relativePath, $newPath);
                        $links[] = asset('storage/' . $newPath);
                    }
                }
                //$links = $request->input('uploaded_images'); // já são URLs completas
            }

            //Atualiza o produto
            $produto->update([
                'nome' => $request->nome,
                'preco_fornecedor' => str_replace(',', '.', str_replace('.', '', $request->preco_fornecedor)),
                'preco_final' => str_replace(',', '.', str_replace('.', '', $request->preco_final)),
                'comissao_consultor' => $request->comissao_consultor,
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
                'consultor_id' => $request->consultor_id,
                'categoria_id' => $request->categoria,
                'descricao' => $request->descricao,
                'descricao_curta' => $request->descricao_curta,
                'images' => count($links) > 0 ? implode(',', $links) : $produto->images
            ]);

            //Transação com sucesso
            DB::commit();

            $produto->update([
                'lucro_consultor' => $produto->preco_final * ($produto->comissao_consultor / 100)
            ]);

            DB::commit();

            $produto->update([
                'lucro_loja' => $produto->preco_final - $produto->preco_fornecedor - $produto->lucro_consultor
            ]);

            DB::commit();

            //Redireciona com msg de sucesso
            return redirect()->route('produto.index', ['consultor' => $produto->consultor_id])
                ->with('success', 'Produto editado!');
        } catch (Exception $e) {
            //Transação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Produto não editado! Tente novamente.' . $e->getMessage());
        }
    }

    //Formulario para alterar status do produto
    public function alter(Produto $produto)
    {
        return view('produtos.alter', [
            'produto' => $produto,
            'consultor' => $produto->consultor->nome
        ]);
    }

    //Altera status do produto no banco de dados
    public function updateAlter(AlterProdutoRequest $request, Produto $produto)
    {
        //Valida o formulario
        $request->validated();

        //Inicio da transação
        DB::beginTransaction();

        try {
            $produto->update([
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
            ]);

            //Transação com sucesso
            DB::commit();

            //Redireciona com msg de sucesso
            return redirect()->route('produto.index', ['consultor' => $produto->consultor_id])
                ->with('success', 'Alterado para ' . $request->situacao . '!');
        } catch (Exception $e) {
            //Transação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Status não alterado! Tente novamente.' . $e->getMessage());
        }
    }

    //Formulario para alterar consultor do produto
    public function alterConsultor(Produto $produto)
    {
        //Recuperar os consultores
        $consultores = Consultor::orderBy('nome')->get();

        return view('produtos.alterConsultor', [
            'produto' => $produto,
            'consultor' => $produto->consultor->nome,
            'consultores' => $consultores
        ]);
    }

    //Alterar consultor do produto no banco de dados
    public function updateConsultor(UpdateConsultorRequest $request, Produto $produto)
    {
        //Valida o formulario
        $request->validated();

        //Inicio da transação
        DB::beginTransaction();

        try {
            $produto->update([
                'consultor_id' => $request->consultor,
            ]);

            //Transação com sucesso
            DB::commit();

            //Redireciona com msg de sucesso
            return redirect()->route('produto.index')
                ->with('success', 'Consultor alterado');
        } catch (Exception $e) {
            //Transação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Consultor não alterado! Tente novamente.' . $e->getMessage());
        }
    }

    //Altera o consultor dos produtos na paginação
    public function alterarConsultor(Request $request)
    {

        $request->validate([
            'consultorAtual' => 'required|integer|exists:consultores,id',
            'novo_consultor' => 'required|integer|exists:consultores,id'
        ]);

        $user = auth()->user();

        //Busca produtos com base nos filtros selecionados, MAS sempre restringe pelo consultor_atual
        $produtos = Produto::query()
            ->where('consultor_id', $request->consultorAtual)
            ->when($request->filled('nome'), function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            })
            ->when($request->filled('codigo'), function ($q) use ($request) {
                $q->where('id', $request->codigo);
            })
            ->when($request->filled('situacao'), function ($q) use ($request) {
                $q->where('situacao', 'like', $request->situacao);
            })
            ->when($request->filled('consultor'), function ($q) use ($request) {
                $q->where('consultor_id', $request->consultor);
            })
            ->when($request->filled('data_inicio'), function ($q) use ($request) {
                $q->where('data_venda', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($q) use ($request) {
                $q->where('data_venda', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->when(!$user->hasRole(['Admin', 'Super Admin']), function ($query) use ($user) {
                $query->whereHas('Consultor', function ($query) use ($user) {
                    $query->where('email', $user->email);
                });
            });

        // Atualiza todos os produtos filtrados
        $totalAtualizados = $produtos->update([
            'consultor_id' => $request->novo_consultor
        ]);

        $novoConsultor = Consultor::find($request->novo_consultor);

        return redirect()->route('produto.index', $request->except('_token'))
            ->with('success', "$totalAtualizados produto(s) alocados para o consultor selecionado: {$novoConsultor->nome}");
    }

    //Excluir produto no banco de dados
    public function destroy(Produto $produto)
    {
        try {
            //Deleta imagens do produto
            if ($produto->images) {
                $urls = explode(',', $produto->images);
                foreach ($urls as $url) {
                    $caminhoRelativo = str_replace(asset('storage') . '/', '', trim($url));
                    Storage::disk('public')->delete($caminhoRelativo);
                }
            }
            //Excluir registro do banco de dados
            $produto->delete();
            //Redireciona o usuario
            return redirect()->route('produto.index', ['consultor' => $produto->consultor_id])->with('success', 'Produto excluido!');
        } catch (Exception $e) {
            //Redireciona usuario, envia mensagem de erro
            return redirect()->back()->with('error', 'Produto não excluido! Tente novamente.');
        }
    }

    //Gerar PDF
    public function generatePdf(Request $request)
    {
        //Recuperar os registros no banco de dados conforme parametros do formulario de pesquisa
        $produtos = Produto::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('consultor'), function ($whenQuery) use ($request) {
                $whenQuery->where('consultor_id', '=', $request->consultor);
            })
            ->when($request->filled('situacao'), function ($whenQuery) use ($request) {
                $whenQuery->where('situacao', 'like', $request->situacao);
            })
            ->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
                $whenQuery->where('data_venda', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
                $whenQuery->where('data_venda', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->orderByDesc('nome')
            ->get();

        //Carrega a string com HTML/conteudo 
        $pdf = Pdf::loadView('produtos.generate-pdf', [
            'produtos' => $produtos,
        ])->setPaper('a4', 'portrait');

        //Fazer download do arquivo
        return $pdf->download('produtos.pdf');
    }

    //Formulario para exportar CSV
    public function exportarProdutos()
    {
        return view('produtos.export');
    }

    public function exportarCsv(Request $request)
    {
        //Validação
        $request->validate(
            [
                'inicio' => 'required|integer',
                'fim' => 'required|integer',
            ],
            [
                'inicio' => "Código inicial é obrigatório!",
                'fim' => "Código final é obrigatório!",
            ]
        );

        // Valores do intervalo
        $inicio = $request->inicio;
        $fim = $request->fim;

        // Corrige caso o usuário inverta inicio/fim
        if ($inicio > $fim) {
            [$inicio, $fim] = [$fim, $inicio];
        }

        //Produtos dentro do intervalo digitado
        $produtos = Produto::with('categoria')
            ->whereBetween('id', [$inicio, $fim])
            ->orderBy('id')
            ->get();

        // Cabeçalho
        $csv = "name,description,short description,sku,regular price,categories,images,stock status\n";

        foreach ($produtos as $produto) {

            $urlBase = config('app.url');

            if (is_array($produto->images)) {
                $imagesArray = $produto->images;
            } elseif (is_string($produto->images) && str_starts_with($produto->images, '[')) {
                $decoded = json_decode($produto->images, true);
                $imagesArray = is_array($decoded) ? $decoded : [];
            } else {
                $imagesArray = explode(',', $produto->images ?? '');
            }

            // Agora tratamos corretamente:
            if (empty($imagesArray) || (count($imagesArray) === 1 && trim($imagesArray[0]) === '')) {
                $images = '""'; // campo vazio
            } else {
                $fullImages = array_map(function ($img) use ($urlBase) {
                    $img = trim($img);

                    // Se já começa com http ou https, não adiciona o domínio novamente
                    if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                        return $img;
                    }

                    // Se for apenas o caminho relativo, adiciona o domínio
                    return rtrim($urlBase, '/') . '/' . ltrim($img, '/');
                }, $imagesArray);

                $images = '"' . implode(',', $fullImages) . '"';
            }

            $descricao = str_replace(['"', "\n", "\r"], ['""', ' ', ' '], $produto->descricao);
            $descricao = '"' . $descricao . '"';

            $descricao_curta = str_replace(['"', "\n", "\r"], ['""', ' ', ' '], $produto->descricao_curta);
            $descricao_curta = '"' . $descricao_curta . '"';

            $linha = [
                $produto->nome,
                $descricao ?? 'Sem descricao',
                $descricao_curta ?? 'Sem descricao',
                $produto->id,
                number_format($produto->preco_final, 2, '.', ','),
                $produto->categoria->nome ?? 'Sem categoria',
                $images,
                'instock'
            ];

            $csv .= implode(',', $linha) . "\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="produtos.csv"');
    }

    public function exportarCsvSelecionado(Request $request)
    {
        $request->validate([
            'codigos' => 'required|string'
        ], [
            'codigos' => 'Digite os códigos dos produtos separados por ponto e virgula (;).'
        ]);

        //Pega os codigos digitados e transforma em array
        $ids = collect(explode(';', $request->codigos))
            ->map(fn($item) => trim($item))
            ->filter()
            ->unique();

        //Busca produtos correspondentes
        $produtos = Produto::with('categoria')
            ->whereIn('id', $ids)
            ->get();

        //Monta o conteudo do CSV
        $csv = "name,description,short description,sku,regular price,categories,images,stock status\n";

        foreach ($produtos as $produto) {
            $linha = [
                $this->limparCampo($produto->nome),
                $this->limparCampo($produto->descricao),
                $this->limparCampo($produto->descricao_curta),
                $this->limparCampo($produto->id),
                number_format($produto->preco_final, 2, '.', ''),
                $produto->categoria ? $this->limparCampo($produto->categoria->nome) : '',
                '"' . $produto->images . '"', // Aspas apenas no campo images, por conter vírgulas
                'instock'
            ];

            $csv .= implode(',', $linha) . "\n";
        }

        // Retorna o CSV como download
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="produtos.csv"');
    }

    // Função auxiliar para limpar campo de quebra de linha e vírgulas
    private function limparCampo($texto)
    {
        return '"' . str_replace(["\r", "\n", '"'], [' ', ' ', "'"], $texto) . '"';
    }

    public function uploadTemporario(Request $request)
    {
        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('temp', 'public');
                $paths[] = asset('storage/' . $path);
            }
        }

        return response()->json(['paths' => $paths]);
    }
}
