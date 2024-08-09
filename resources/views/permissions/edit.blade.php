@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Permissões</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="title" class="form-label">Título da permissão (rota):</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $permission->title) }}"
                            placeholder="Título da permissão (rota)">
                    </div>
                    <div class="col-12">
                        <label for="name">Rota da permissão:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $permission->name) }}"
                            placeholder="Nome da rota">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
