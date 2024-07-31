@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Visualizar</span>
                <span class="d-flex">
                    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm me-1">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
                    <a href="{{ route('user.edit-password', ['user' => $user->id]) }}"
                        class="btn btn-warning btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i>Editar senha
                    </a>
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1"><i
                            class="fa-solid fa-pen-to-square"></i>Editar
                    </a>

                    <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1"
                            onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email: </dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
