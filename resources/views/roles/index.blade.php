@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Papéis</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Papéis</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td class="d-md-flex justify-content-center">


                                    <a href="{{ route('role-permission.index', ['role' => $role->id]) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-list-check"></i> Permissões</a>



                                    <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar</a>



                                    <form method="POST" action="{{ route('role.destroy', ['role' => $role->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm me-1 mb-1" type="submit"
                                            onclick="return confirm('Tem certeza que desja excluir este registro?')">
                                            <i class="fa-solid fa-trash-can"></i> Apagar</button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum papel encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $roles->onEachSide(0)->links() }}

            </div>
        </div>

    </div>
@endsection
