@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Permissões</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Permissões</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    @can('create-permission')
                        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-list"></i> Cadastrar permissão</a>
                    @endcan
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Nome (rota)</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $permission->id }}</th>
                                <td>{{ $permission->title }}</td>
                                <td> {{ $permission->name }}</td>
                                <td class="d-md-flex justify-content-center">
                                    <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-primary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    @can('destroy-permission')
                                        <form method="POST"
                                            action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm me-1 mb-1 align-center" type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir este registro?')">
                                                <i class="fa-solid fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma permissão encontrada!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $permissions->links() }}
            </div>
        </div>

    </div>
@endsection
