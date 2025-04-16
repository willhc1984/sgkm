<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-categoria', ['only' => ['index']]);
        $this->middleware('permission:show-categoria', ['only' => ['show']]);
        $this->middleware('permission:create-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-categoria', ['only' => ['destroy']]);
    }

    public function index()
    {
        //Recupera categorias no bd
        $categorias = Categoria::orderBy('nome')->paginate(10);
        return view('categorias.index', [
            'categorias' => $categorias,
            'menu' => 'categorias'
        ]);
    }

    //Formulário para categorias
    public function create()
    {
        return view('categorias.create');
    }

    //Cadastrar categorias no banco de dados
    public function store(CategoriaRequest $request)
    {
        //Valida formulario de cadastro
        $request->validated();

        //Inicio da transação
        DB::beginTransaction();

        try {
            $categoria = Categoria::create([
                'nome' => $request->nome
            ]);
            //Operação concluida com exito
            Db::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('categoria.index')->with('success', 'Categoria de produto cadastrada!');
        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return back()->withInput()->with('error', 'Categoria de produto não cadastrada! Tente novamente.' . $e->getMessage());
        }
    }

    //Editar consultor
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', ['categoria' => $categoria]);
    }

    //Atualizar consultor no banco de dados
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        //Validação dos campos do formulario.
        $request->validated();
        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Atualiza no banco de dados
            $categoria->update([
                'nome' => $request->nome,
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redirecionar usuario
            return redirect()->route('categoria.index')->with('success', 'Categoria de produto atualizada!');
        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Retorno com mensagem de erro
            return back()->withInput()->with('error', 'Categoria de produto não atualizado! Tente novamente');
        }
    }

    //Excluir consultores
    public function destroy(Categoria $categoria)
    {
        //Exclui regitro
        try {
            $categoria->delete();
            //Redireciona usuario com msg de successo
            return redirect()->route('categoria.index')->with('success', 'Categoria de produto excluída!');
        } catch (Exception $e) {
            //Redireciona usuario com mensagem de erro
            return redirect()->route('categoria.index')->with('error', 'Categoria de produto não excluída! Talvez haja produtos relacionados.');
        }
    }
}
