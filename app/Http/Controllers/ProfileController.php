<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Detalhes do perfil
    public function show()
    {
        //Recuperar informações do usuario logado 
        $user = User::where('id', Auth::id())->first();

        //Carrega view
        return view('profile.show', ['user' => $user]);
    }

    //Carregar formulario editar perfil
    public function edit()
    {
        //Recuperar as informações do ussuario logado
        $user = User::where('id', Auth::id())->first();
        //Carrega view
        return view('profile.edit', ['user' => $user]);
    }

    //Editar perfil no banco de dados
    public function update(ProfileRequest $request)
    {
        //Valida o formulario
        $request->validated();

        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Recupera informações do ususairo logado
            $user = User::where('id', Auth::id())->first();
            //Editar informações recuperadas
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redireciona usuario com mensagem de sucesso
            return redirect()->route('profile.show')->with('success', 'Perfil editado com sucesso!');
        } catch (Exception $e) {
            //Operação não concluida com exit
            DB::rollBack();

            //Redireciona usuario com messagem de erro
            return redirect()->withInput()->with('error', 'Perfil não editado!');
        }
    }

    //Carregar formulario para editar senha do usuario
    public function editPassword()
    {
        //Recuperar usuario logado
        $user = User::where('id', Auth::id())->first();
        //Carregar view
        return view('profile.edit-password', ['user' => $user]);
    }

    //Salvar senha do usuario
    public function updatePassword(Request $request)
    {
        //Valida o formulario da senha
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.min' => 'A senha deve ter pelo menos :min caracteres',
        ]);

        //Marca inicio da transação
        DB::beginTransaction();

        try {
            //Recuperar dados do usuario logado
            $user = User::where('id', Auth::id())->first();
            //Editar as informações do usuario logado
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            //Redireciona usuario com mensagem de exito
            return redirect()->route('profile.show')->with('success', 'Senha do perfil editada!');
        } catch (Exception $e) {
            //Operação não concluida com exito
            DB::rollBack();
            //Redireciona usuario com messagem de erro
            return redirect()->withInput()->with('error', 'Senha do perfil não editada!');
        }
    }
}
