<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Consultor;
use App\Models\Produto;
use Exception;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class ProdutoController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-produtos', ['only' => ['index']]);
        $this->middleware('permission:show-produtos', ['only' => ['show']]);
        $this->middleware('permission:create-produtos', ['only' => ['create']]);
        $this->middleware('permission:edit-produtos', ['only' => ['edit']]);
        $this->middleware('permission:destroy-produtos', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Recuperar os consultores
        $consultores = Consultor::orderBy('nome')->get();

        //Recuperar os registros no banco de dados conforme parametros do formulario de pesquisa
        $produtos = Produto::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('consultor'), function ($whenQuery) use ($request) {
                $whenQuery->where('consultor_id', '=', $request->consultor);
        })
            // ->when($request->filled('data_cadastro_inicio'), function($whenQuery) use($request){
            //     $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->data_cadastro_inicio)->format('Y-m-d H:i:s'));
            // })
            // ->when($request->filled('data_cadastro_fim'), function($whenQuery) use($request){
            //     $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->data_cadastro_fim)->format('Y-m-d H:i:s'));
            // })

            ->orderByDesc('nome')
            ->paginate(20)
            ->withQueryString();

        //Carregar view
        return view('produtos.index', [
            'menu' => 'produtos',
            'produtos' => $produtos,
            'nome' => $request->nome,
            'consultores' => $consultores
            // 'email' => $request->email,
            // 'data_cadastro_inicio' => $request->data_cadastro_inicio,
            // 'data_cadastro_fim' => $request->data_cadastro_fim,
        ]);
    }

    //Listar produtos do consultor
    // public function index(Consultor $consultor)
    // {
    //     //Recuperar registros conforme parametros do formulario
    //     $produtos = Produto::with('consultor')
    //         ->where('consultor_id', $consultor->id)
    //         ->orderBy('id')->paginate(20);

    //     $query = Produto::with('consultor')->where('consultor_id', $consultor->id);

    //     $total_lucro_consultor = $query->sum('lucro_consultor');
    //     $total_lucro_loja = $query->sum('lucro_loja');

    //     return view('produtos.index', [
    //         'produtos' => $produtos,
    //         'consultor' => $consultor,
    //         'total_lucro_consultor' => $total_lucro_consultor,
    //         'total_lucro_loja' => $total_lucro_loja
    //     ]);
    // }


    //Formulario para alocar produto ao consultor
    public function create(Consultor $consultor)
    {
        //Carrega view
        return view('produtos.create', ['consultor' => $consultor]);
    }

    //Cadastrar e alocar produto para consultor
    public function store(ProdutoRequest $request)
    {
        //Validar o formulario 
        $request->validated();
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
                'consultor_id' => $request->consultor_id
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
                ->with('success', 'Produto alocado para : ' . $request->consultor);
        } catch (Exception $e) {
            //Transaçõ não concluida com exito
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Produto não foi alocado! Tente novamente.');
        }
    }

    //Formulario editar produtos
    public function edit(Produto $produto)
    {

        //dd($produto->data_venda);

        return view('produtos.edit', [
            'produto' => $produto,
            'consultor' => $produto->consultor->nome
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
            $produto->update([
                'nome' => $request->nome,
                'preco_fornecedor' => str_replace(',', '.', str_replace('.', '', $request->preco_fornecedor)),
                'preco_final' => str_replace(',', '.', str_replace('.', '', $request->preco_final)),
                'comissao_consultor' => $request->comissao_consultor,
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
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
            return redirect()->back()->with('error', 'Produto não editado! Tenete novamente.' . $e->getMessage());
        }
    }

    //Excluir produto no banco de dados
    public function destroy(Produto $produto)
    {
        try {
            //Excluir registro do banco de dados
            $produto->delete();
            //Redireciona o usuario
            return redirect()->route('produto.index', ['consultor' => $produto->consultor_id])->with('success', 'Produto excluido!');
        } catch (Exception $e) {
            //Redireciona usuario, envia mensagem de erro
            return redirect()->back()->with('error', 'Produto não excluido! Tente novamente.');
        }
    }
}
