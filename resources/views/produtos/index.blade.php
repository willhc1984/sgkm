@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Produtos - {{ $consultor->nome }}</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('consultor.index')}}">Consultores</a></li>
                <li class="breadcrumb-item active">Produtos</li>
            </ol>
        </div>

        <x-alert />

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Pesquisar</span>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="name">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value=""
                                placeholder="Nome do produto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-2 pt-2">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass">
                                </i> Pesquisar</button>
                            <a href="{{ route('produto.index', ['consultor' => $consultor->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-trash"></i>Limpar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('produto.create') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-square-plus"></i> Alocar produto</a>
                </span>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço-Fornecedor</th>
                            <th scope="col">Preço-Loja</th>
                            <th scope="col">Preço-Consultor</th>
                            <th scope="col">Data da venda</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                <th scope="row">{{ $produto->id }}</th>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->preco_fornecedor }}</td>
                                <td>{{ $produto->preco_loja }}</td>
                                <td>{{ $produto->preco_consultor }}</td>
                                <td>{{ $produto->data_venda }}</td>
                                <td>{{ $produto->situacao }}</td>
                                <td>{{ $produto->qtde }}</td>
                                <td class="d-md-flex justify-content-center">

                                    <a href="{{ route('produto.edit', ['produto' => $produto->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i>Editar</a>

                                    <form id="formDelete{{ $produto->id }}" method="POST"
                                        action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $produto->id }}"><i class="fa-regular fa-trash-can"></i>
                                            Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum produto alocado para {{ $consultor->nome }}!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $produtos->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection
