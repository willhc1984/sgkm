@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb1 space-between-elements">
            <h2 class="mt-3">Produtos</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Início</a></li>
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
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="name">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value=""
                                placeholder="Nome do produto">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="name">Consultor:</label>
                            <select class="form-select" name="consultor" id="consultor" aria-label="Default select example">
                                <option selected></option>
                                @forelse($consultores as $consultor)
                                    <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="name">Situação:</label>
                            <select class="form-select" name="situacao" id="situacao" aria-label="Default select example">
                                <option selected></option>
                                <option value="Em estoque">Em estoque</option>
                                <option value="Vendido">Vendido</option>
                                <option value="Pago">Pago</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_inicio">Data início:</label>
                            <input type="date" name="data_inicio" id="data_inicio"
                                class="form-control" value="" placeholder="Data final">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_fim">Data final:</label>
                            <input type="date" name="data_fim" id="data_fim"
                                class="form-control" value="" placeholder="Data final">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-2 pt-2">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass">
                                </i> Pesquisar</button>
                            <a href="{{ route('produto.index') }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-trash"></i>Limpar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
            </div>

            <div class="card-body">
                <table class="table table-hover table-sm" style="font-size: 13px;">
                    <thead>
                        <tr class="text-center">
                            {{-- <th scope="col">#ID</th> --}}
                            <th scope="col">Nome</th>
                            @can('create-produtos')
                                <th scope="col">Preço-Fornecedor</th>
                            @endcan
                            <th scope="col">Preço-Final</th>
                            <th scope="col">Comissão em (%)</th>
                            <th scope="col">Lucro Consultor</th>
                            @can('create-produtos')
                            <th scope="col">Lucro Loja</th>
                            @endcan
                            <th scope="col">Data da venda</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                {{-- <th class="text-center" scope="row">{{ $produto->id }}</th> --}}
                                <td class="text-center">{{ $produto->nome }}</td>
                                @can('create-produtos')
                                    <td class="text-center">{{ 'R$ ' . number_format($produto->preco_fornecedor, 2, ',', '.') }}
                                    @endcan
                                </td>
                                <td class="text-center">{{ 'R$ ' . number_format($produto->preco_final, 2, ',', '.') }}</td>
                                <td class="text-center">{{ $produto->comissao_consultor }} %</td>
                                <td class="text-center">{{ 'R$ ' . number_format($produto->lucro_consultor, 2, ',', '.') }}
                                </td>
                                @can('create-produtos')
                                <td class="text-center">{{ 'R$ ' . number_format($produto->lucro_loja, 2, ',', '.') }}</td>
                                @endcan
                                @if (empty($produto->data_venda))
                                    <td class="text-center" style="color: red;">Não informado</td>
                                @else
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($produto->data_venda)->format('d/m/Y') }}</td>
                                @endif
                                <td class="text-center">
                                    @if ($produto->situacao == 'Vendido')
                                        <a href="{{ route('produto.index') }}">
                                            <span class="badge bg-success">Vendido</span>
                                        </a>
                                    @else
                                        <a href="{{ route('produto.index') }}">
                                            <span class="badge bg-danger">Em estoque</span>
                                        </a>
                                    @endif

                                <td class="d-md-flex justify-content-center">

                                    <a href="{{ route('produto.edit', ['produto' => $produto->id]) }}"
                                        class="btn btn-secondary btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i></a>

                                    <form id="formDelete{{ $produto->id }}" method="POST"
                                        action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete"
                                            data-delete-id="{{ $produto->id }}"><i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum produto encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{ $produtos->onEachSide(2)->links() }}

                {{-- <p> Lucro total do consultor: <b> R$ {{ number_format($total_lucro_consultor, 2, ',', '.') }} </b>
                <p> Lucro total da loja: <b> R$ {{ number_format($total_lucro_loja, 2, ',', '.') }} </b> --}}

            </div>
        </div>
    </div>
@endsection
