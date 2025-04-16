@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Categoria de produtos</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Início</a></li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
        </div>

        <x-alert />   

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('categoria.create') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                            <tr>
                                <th scope="row">{{ $categoria->id }}</th>
                                <td>{{ $categoria->nome }}</td>
                                <td class="d-md-flex justify-content-center">

                                    <a href="{{ route('categoria.edit', ['categoria' => $categoria->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i>Editar</a>

                                    <form id="formDelete{{ $categoria->id }}" method="POST"
                                        action="{{ route('categoria.destroy', ['categoria' => $categoria->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $categoria->id }}"><i class="fa-regular fa-trash-can"></i>
                                            Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma categoria encontrada!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $categorias->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection
