<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
    public function show(User $user){
        //Carregar view
        return view('users.show', ['menu' => 'usuarios', 'user' => $user]);
    }

    //Carregar formulario para cadastrar
    public function create(){
        return view('users.create', ['menu' => 'usuarios']);
    }

    //Salvar usuario no banco de dados
    public function store(UserRequest $request)
    {
        //Validar formulario
        $request->validated();

        //Marca ponto iniical da transação
        DB::beginTransaction();

        try{
            //Cadastrar no banco de dados
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            //Atribuir papel ao usuário
            //$user->assignRole($request->roles);

            //Operação concluida com exito
            DB::commit();

            //Redireciona usuario e envia mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuario cadastrado!');

        }catch(Exception $e){
            //Operação nao concluida com exito
            DB::rollBack();

            //Redireciona usuario e envia mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado! Tente novamente.');
        }

    }
}
