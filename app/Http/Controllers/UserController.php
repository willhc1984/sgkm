<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-user', ['only' => ['index']]);
        $this->middleware('permission:show-user', ['only' => ['show']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-user', ['only' => ['destroy']]);
    }

    //Listar usuários
    public function index()
    {
        //Recuperar registros do banco de dados
        $users = User::orderByDesc('created_at')->paginate(10);
        //Carrega view
        return view('users.index', [
            'menu' => 'usuarios',
            'users' => $users
        ]);
    }

    //Detalhes do usuario
    public function show(User $user)
    {
        //Carregar view
        return view('users.show', ['menu' => 'usuarios', 'user' => $user]);
    }

    //Carregar formulario para cadastrar
    public function create()
    {
        //Recuperar os papeis
        $roles = Role::pluck('name')->all();
        //Retorna a view de cadastro
        return view('users.create', [
            'menu' => 'usuarios',
            'roles' => $roles
        ]);
    }

    //Salvar usuario no banco de dados
    public function store(UserRequest $request)
    {
        //Validar formulario
        $request->validated();

        //Marca ponto iniical da transação
        DB::beginTransaction();

        try {
            //Cadastrar no banco de dados
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            //Atribuir papel ao usuário
            $user->assignRole($request->roles);

            //Operação concluida com exito
            DB::commit();

            //Redireciona usuario e envia mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuario cadastrado!');
        } catch (Exception $e) {
            //Operação nao concluida com exito
            DB::rollBack();

            //Redireciona usuario e envia mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado! Tente novamente.');
        }
    }

    //Carregar formulario editar usuario 
    public function edit(User $user)
    {
        //Recuperar os papeis do banco de daods
        $roles = Role::pluck('name')->all();

        //Recuperar papel do usuario
        $userRoles = $user->roles->pluck('name')->first();

        //Carrega a view
        return view('users.edit', [
            'menu' => 'usuarios',
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    //Editar usuario no banco de dados
    public function update(UserRequest $request, User $user)
    {
        //Validar formulario
        $request->validated();

        //Ponto inicial da transação
        DB::beginTransaction();

        try {
            //Editar as informação no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            //Editar o papel do usuario
            $user->syncRoles($request->roles);

            DB::commit();

            //Redirecionar usuario e enviar mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado!');
        } catch (Exception $e) {
            //Operação nao concluida
            DB::rollBack();
            //Redireciona com mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado.');
        }
    }

    //Carregar formulario de editar senha
    public function editPassword(User $user)
    {
        //Carregar view
        return view('users.editPassword', ['menu' => 'usuarios', 'user' => $user]);
    }

    //Salva senha do usuario
    public function updatePassword(Request $request, User $user)
    {
        //Validar o formulario
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve conter no minimo :min caracteres.'
        ]);

        //Inicio da transação
        DB::beginTransaction();

        try {
            //Edita as informações no banco de dados
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            //Operação é concluida
            DB::commit();

            //Redireciona ususairo com mensagem de exito
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Senha editada!');
        } catch (Exception $e) {
            //Operação não é concluida
            DB::rollBack();
            //Redireciona usuario com mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada! Tente novamente.');
        }
    }

    //Excluir usuario no banco de dados
    public function destroy(User $user)
    {
        if (Auth::id() == $user->id) {
            //Redireciona com mensagem de erro
            return redirect()->route('user.index')->with('error', 'Usuário logado não pode excluído!');
        };

        try {
            //Excluir usuario
            $user->delete();
            //Remove todos os papeis atribuidos ao usuario
            $user->syncRoles([]);
            //Redireciona e envia mesnagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído!');
        } catch (Exception $e) {
            //Redireciona com mensagem de erro
            return redirect()->route('user.index')->with('error', 'Usuário não excluído! Tente novamente.');
        }
    }
}
