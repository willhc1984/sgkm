<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Executar o construct quando instanciar a classe
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-permission', ['only' => ['index']]);
        $this->middleware('permission:show-permission', ['only' => ['show']]);
        $this->middleware('permission:create-permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-permission', ['only' => ['destroy']]);
    }

    //Listar permissõs do sistema (rotas)
    public function index()
    {
        $permissions = Permission::orderBy('id')->paginate(30);
        //Carrega a view
        return view('permissions.index', [
            'permissions' => $permissions,
            'menu' => 'permissoes'
        ]);
    }

    //Formulario para cadastrar permissões do sistema (rotas)
    public function create()
    {
        return view('permissions.create');
    }

    //Cadastrar a permissão no banco de dados
    public function store(PermissionRequest $request)
    {
        //Valida dado do formulario
        $request->validated();
        //Inicia a transação
        DB::beginTransaction();

        try {
            $permission = Permission::create([
                'title' => $request->title,
                'name' => $request->name,
            ]);

            //Operação concluida com exito
            DB::commit();
            //Redireciona com mensagem de sucesso
            return redirect()->route('permissions.index')->with('success', 'Permissão cadastrada com sucesso!');

        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Redireciona com mensagem de erro
            return back()->withInput()->with('error', 'Permissão não cadastrada! Tente novamente.');
        }
    }

    //Formulário para editar permissão
    public function edit(Permission $permission){
        return view('permissions.edit', ['permission' => $permission]);
    }

    //Salva alterações de permissão no banco de dados
    public function update(PermissionRequest $request, Permission $permission){
        //Validação dos campos do formulario.
        $request->validated();

        //Marca ponto inicial da transação
        DB::beginTransaction();

        try{
            //Atualiza no banco de dados
            $permission->update([
                'name' => $request->name, 
                'title' => $request->title
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redirecionar usuario
            return redirect()->route('permissions.index', ['menu' => 'permission'])
                ->with('success', 'Permissão atualizada!');

        }catch(Exception $e){
            //Operação não concluida
            DB::rollBack();
            //Retorno com mensagem de erro
            return back()->withInput()->with('error','Permissão não atualizada! Tente novamente.' . $e->getMessage());
        }
    }

    public function destroy(Permission $permission){
        //Não permite excluir permissões com usuarios.
        if($permission->users->isNotEmpty()){
             //Redireciona usuario com msg de erro
             return redirect()->route('permissions.index')->with('error','Permissão não pode ser excluída pois possui usuários associados.');
        }
        //Exclui regitro
        try {       
            $permission->delete();
            //Redireciona usuario com msg de successo
            return redirect()->route('permissions.index')->with('success','Permissão deletada!');
        }catch(Exception $e){
            //Redireciona usuario com mensagem de erro
            return redirect()->route('permissions.index')->with('error','Permissão não excluida! Possui usuários 
                associados.' . $e->getMessage());
        }
    }
}
