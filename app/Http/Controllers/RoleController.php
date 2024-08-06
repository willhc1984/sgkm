<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //Executar o construct quando instanciar a classe - verifica permissão de quem esta logado
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-role', ['only' => ['index']]);
        $this->middleware('permission:create-role', ['only' => ['create']]);
        $this->middleware('permission:store-role', ['only' => ['store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit']]);
        $this->middleware('permission:destroy-role', ['only' => ['destroy']]);
        $this->middleware('permission:index-permission', ['only' => ['index']]);
    }

    //Listar papéis
    public function index()
    {
        $roles = Role::orderByDesc('name')->paginate(40);
        return view('roles.index', [
            'menu' => 'papeis',
            'roles' => $roles
        ]);
    }

    //Formulario para criar role
    public function create()
    {
        return view('roles.create', ['menu' => 'papeis']);
    }

    //Salva role no banco de dados
    public function store(RoleRequest $request)
    {
        //Validação dos campos do formulario
        $request->validated();
        //Inicio da transação
        DB::beginTransaction();

        try {
            //Cadastrar no banco de dados
            $role = Role::create([
                'name' => $request->name,
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redireciona com mensagem de sucesso
            return redirect()->route('role.index')->with('success', 'Papel cadastrado!');
        } catch (Exception $e) {
            //Operação não concluida com exito
            DB::rollBack();

            //Redireciona usuario e envia mensagem de erro
            return back()->withInput()->with('error', 'Papel não cadastrado. Tente novamente.');
        }
    }

    //Abrir formulario de editar
    public function edit(Role $role)
    {
        //Carrega a view
        return view('roles.edit', ['menu' => 'roles', 'role' => $role]);
    }

    //Atualiza papel no bancode dados
    public function update(RoleRequest $request, Role $role)
    {
        //Validação do formulario
        $request->validated();
        //Marca inicio da transação
        DB::beginTransaction();

        try {
            $role->update([
                'name' => $request->name,
            ]);

            //Operação concluida com exito
            DB::commit();
            //Redireciona com mensagme de sucesso
            return redirect()->route('role.index', ['menu' => 'roles', 'role' => $request->role])
                ->with('success', 'Papel editado!');
        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Redireciona com mensagem de erro
            return back()->withInput()->with('error', 'Papel não editado! Tente novamente.');
        }
    }

     //Exclui papel no banco de dados
     public function destroy(Role $role){
        //Não permitir excluir super admin
        if($role->name == "Super Admin"){
            return redirect()->route('role.index')->with('error','Papel Super Admin não pode ser excluido!');
        }
        //Não permitir excluir papel com usuario associado
        if($role->users->isNotEmpty()){
            //Redireciona usuario com msg de successo
            return redirect()->route('role.index')->with('error','Papel não pode ser excluido pois possui usuários associados.');
        }
        //Exluir registro
        try{
            $role->delete();
            //Redireciona usuario com msg de successo
            return redirect()->route('role.index')->with('success','Papel deletado!');
        }catch(Exception $e){
             //Redireciona com mensagemde erro
             return redirect()->route('role.index')->with('erro', 'Papel não excluido. Tente novamente.');
        }
    }

}
