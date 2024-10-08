@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Consultores</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
                <li class="breadcrumb-item active">Consultores</li>
            </ol>
        </div>

        <x-alert />   

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('consultor.create') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultores as $consultor)
                            <tr>
                                <th scope="row">{{ $consultor->id }}</th>
                                <td>{{ $consultor->nome }}</td>
                                <td>{{ $consultor->contato }}</td>
                                <td class="d-md-flex justify-content-center">

                                    <a href="{{ route('produto.create', ['consultor' => $consultor->id]) }}"
                                        class="btn btn-info btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-list-check"></i> Alocar produto </a>

                                    <a href="{{ route('consultor.edit', ['consultor' => $consultor->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i>Editar</a>

                                    <form id="formDelete{{ $consultor->id }}" method="POST"
                                        action="{{ route('consultor.destroy', ['consultor' => $consultor->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $consultor->id }}"><i class="fa-regular fa-trash-can"></i>
                                            Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum consultor encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $consultores->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection
