@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Editar produto</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li class="breadcrumb-item active">Editar produto</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Editar produto - <b> {{ $produto->consultor->nome }} </b></span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Nome do produto:</label>
                        <input type="text" class="form-control" name="nome" id="nome"
                            value="{{ old('nome', $produto->nome) }}" placeholder="Nome do produto">
                    </div>
                    <div class="col-12">
                        <label for="preco_fornecedor">Preço do Fornecedor:</label>
                        <input type="text" class="form-control" name="preco_fornecedor" id="preco_fornecedor"
                            value="{{ old('preco_fornecedor', number_format($produto->preco_fornecedor, 2, ',', '.')) }}"
                            placeholder="R$">
                    </div>
                    <div class="col-12">
                        <label for="preco_final">Preço Final:</label>
                        <input type="text" class="form-control" name="preco_final" id="preco_final"
                            value="{{ old('preco_final', number_format($produto->preco_final, 2, ',', '.')) }}"
                            placeholder="R$">
                    </div>
                    <div class="col-12">
                        <label for="comissao_consultor">Comissão do consultor (%)</label>
                        <input type="number" class="form-control" name="comissao_consultor" id="comissao_consultor"
                            value="{{ old('comissao_consultor', $produto->comissao_consultor) }}"
                            placeholder="Comissão do consultor (%)">
                    </div>
                    <div class="col-12">
                        <label for="data_venda">Data da venda</label>
                        @if ($produto->data_venda == null)
                            <input type="date" class="form-control" name="data_venda" id="data_venda" value=""
                                placeholder="Data">
                        @else
                            <input type="date" class="form-control" name="data_venda" id="data_venda"
                                value="{{ \Carbon\Carbon::parse($produto->data_venda)->format('Y-m-d') }}"
                                placeholder="Data">
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-select" name="situacao">
                            <option selected>{{ $produto->situacao }}</option>
                            <option value="Em estoque">Em estoque</option>
                            <option value="Vendido">Vendido</option>
                            <option value="Pago">Pago</option>
                        </select>
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
