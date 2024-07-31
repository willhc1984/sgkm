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
            <span>Editar senha</span>
            <span>
                <a href="{{ route('user.index') }}" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-square-plus"></i> Usuários</a>
            </span>
        </div>

        <div class="card-body">

            <x-alert />

            <form class="row g-3" action="{{ route('user.update-password', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ old('email', $user->email) }}" placeholder="Senha com no minimo 6 caracteres">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary bt-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>

@endsection