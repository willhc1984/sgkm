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

        //Carregar view
        return view('produtos.index', [
            'menu' => 'produtos',
            'produtos' => $produtos,
            'nome' => $request->nome,
            'consultores' => $consultores
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
            //Transaçõ não concluida com exito
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

        $links = [];

        // Verifica se request possui imagens e escreve caminho completo das url's.
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('imagens', 'public');
                $urlCompleta = asset('storage/' . $path);
                $links[] = $urlCompleta;
            }
        }

        //Inicio da transação
        DB::beginTransaction();

        try {
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

    public function exportarCsv()
    {
        $produtos = Produto::with('categoria')->get();

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

            $linha = [
                $produto->nome,
                $produto->descricao ?? 'Sem descricao',
                $produto->descricao_curta ?? 'Sem descricao',
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
}
