<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Consultor;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class ProdutoController extends Controller
{
    //Listar produtos do consultor
    public function index(Consultor $consultor)
    {
        $produtos = Produto::with('consultor')
            ->select(
                'id',
                'nome',
                'preco_fornecedor',
                'preco_final',
                'comissao_consultor',
                'situacao',
                'data_venda',
                DB::raw('preco_final * (comissao_consultor / 100) as lucro_consultor'),
                DB::raw('preco_final - preco_fornecedor - (preco_final * (comissao_consultor / 100)) as lucro_loja')
            )
            ->where('consultor_id', $consultor->id)
            ->orderBy('nome')->paginate(50);

        //dd($produtos);

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
    public function store(ProdutoRequest $request)
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
                'preco_fornecedor' => str_replace(',', '.', str_replace('.', '', $request->preco_fornecedor)),
                'preco_final' => str_replace(',', '.', str_replace('.', '', $request->preco_final)),
                'comissao_consultor' => $request->comissao_consultor,
                'data_venda' => $request->data_venda,
                'situacao' => $request->situacao,
                'consultor_id' => $request->consultor_id
            ]);

            DB::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('produto.index', ['consultor' => $request->consultor_id])
                ->with('success', 'Produto alocado para : ' . $request->consultor);
        } catch (Exception $e) {
            //Transaçõ não concluida com exito
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Produto não foi alocado! Tente novamente.' . $e->getMessage());
        }
    }
}
