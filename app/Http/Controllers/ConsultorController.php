<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultorRequest;
use App\Models\Consultor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorController extends Controller
{
    //Listar consultores
    public function index(){
        //Recuperar registros de consultores
        $consultores = Consultor::orderBy('nome')->paginate(5);
        return view('consultores.index', ['consultores' => $consultores]);
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

}
