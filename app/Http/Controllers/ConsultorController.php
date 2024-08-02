<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultorRequest;
use App\Models\Consultor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-consultores', ['only' => ['index']]);
        $this->middleware('permission:show-consultores', ['only' => ['show']]);
        $this->middleware('permission:create-consultores', ['only' => ['create']]);
        $this->middleware('permission:edit-consultores', ['only' => ['edit']]);
        $this->middleware('permission:destroy-consultores', ['only' => ['destroy']]);
    }

    //Listar consultores
    public function index(){
        //Recuperar registros de consultores
        $consultores = Consultor::orderBy('nome')->paginate(5);
        return view('consultores.index', [
            'consultores' => $consultores,
            'menu' => 'consultores'
        ]);
    }

    //Formulário para consultor
    public function create(){
        return view('consultores.create');
    }

    //Cadastrar consultor no banco de dados
    public function store(ConsultorRequest $request){
        //Valida formulario de cadastro
        $request->validated();

        //Inicio da transação
        DB::beginTransaction();

        try{    
            $consultor = Consultor::create([
                'nome' => $request->nome,
                'contato' => $request->contato
            ]);
            //Operação concluida com exito
            Db::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('consultor.index')->with('success', 'Consultor(a) cadastrado!');
        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return back()->withInput()->with('error','Consultor(a) não cadastrado! Tente novamente.' . $e->getMessage());
        }
    }

    //Editar consultor
    public function edit(Consultor $consultor){
        return view('consultores.edit', ['consultor' => $consultor]);
    }

    //Atualizar consultor no banco de dados
    public function update(ConsultorRequest $request, Consultor $consultor){
        //Validação dos campos do formulario.
        $request->validated();

        //Marca ponto inicial da transação
        DB::beginTransaction();

        try{
            //Atualiza no banco de dados
            $consultor->update([
                'nome' => $request->nome, 
                'contato' => $request->contato
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redirecionar usuario
            return redirect()->route('consultor.index')->with('success', 'Consultor(a) atualizado!');

        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            //Retorno com mensagem de erro
            return back()->withInput()->with('error','Consultor(a) não atualizado! Tente novamente');
        }
    }

    //Excluir consultores
    public function destroy(Consultor $consultor){
         //Exclui regitro
         try {       
            $consultor->delete();
            //Salvando log de sucesso
            //Redireciona usuario com msg de successo
            return redirect()->route('consultor.index')->with('success','Consultor excluído!');
        }catch(Exception $e){
            //Redireciona usuario com mensagem de erro
            return redirect()->route('consultor.index')->with('error','Consultor não excluído!');
        }
    }
}
