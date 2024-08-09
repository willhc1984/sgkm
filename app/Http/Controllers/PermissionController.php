<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
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
}
