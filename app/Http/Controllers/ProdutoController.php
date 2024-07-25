<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Consultor;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    //Listar produtos do consultor
    public function index(Consultor $consultor)
    {
        $produtos = Produto::with('consultor')
            ->where('consultor_id', $consultor->id)
            ->orderBy('nome')->paginate(10);

        return view('produtos.index', [
            'produtos' => $produtos,
            'consultor' => $consultor
        ]);
    }

    //Formulario para alocar produto ao consultor
    public function create(Consultor $consultor)
    {
        //Carrega view
        return view('produtos.create', ['consultor' => $consultor]);
    }

    //Cadastrar e alocar produto para consultor
    public function store(ProdutoRequest $request, Consultor $consultor)
    {

        //dd($request);
        //Validar o formulario 
        $request->validated();
        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Aloca produto para consultor no banco de dados
            $produto = Produto::create([
                'nome' => $request->nome,
                'preco_fornecedor' => $request->preco_fornecedor,
                'comissao_consultor' => $request->comissao_consultor,
                'comissao_loja' => $request->comissao_loja,
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
                'consultor_id' => $request->consultor_id
            ]);

            DB::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('produto.index', ['consultor' => $request->consultor_id])
                ->with('success', 'Produto alocado para : ' . $consultor->nome);
        } catch (Exception $e) {
            //Transaçõ não concluida com exito
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Produto não foi alocado! Tente novamente.' . $e->getMessage());
        }
    }
}
