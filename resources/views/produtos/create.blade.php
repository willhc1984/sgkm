@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Alocar produto</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consultor.index') }}">Consultores</a></li>
                <li class="breadcrumb-item active">Alocar produto</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Alocar produto - <b> {{ $consultor->nome }} </b></span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('produto.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="consultor_id" id="consultor_id" value="{{ $consultor->id }}">
                    <input type="hidden" name="consultor" id="consultor" value="{{ $consultor->nome }}">
                    <div class="col-12">
                        <label for="name" class="form-label">Nome do produto:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}"
                            placeholder="Nome do produto">
                    </div>
                    <div class="col-12">
                        <label for="preco_fornecedor">Preço do Fornecedor:</label>
                        <input type="text" class="form-control" name="preco_fornecedor" id="preco_fornecedor"
                            value="{{ old('preco_fornecedor') }}" placeholder="R$">
                    </div>
                    <div class="col-12">
                        <label for="preco_final">Preço Final:</label>
                        <input type="text" class="form-control" name="preco_final" id="preco_final"
                            value="{{ old('preco_final') }}" placeholder="R$">
                    </div>
                    <div class="col-12">
                        <label for="comissao_consultor">Comissão do consultor (%)</label>
                        <input type="number" class="form-control" name="comissao_consultor" id="comissao_consultor"
                            value="{{ old('comissao_consultor') }}" placeholder="Comissão do consultor (%)">
                    </div>
                    <div class="col-12">
                        <label for="data_venda">Data da venda</label>
                        <input type="date" class="form-control" name="data_venda" id="data_venda"
                            value="{{ old('data_venda') }}" placeholder="Data">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-select" name="situacao">
                            <option selected></option>
                            <option value="Em estoque">Em estoque</option>
                            <option value="Em estoque">Vendido</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm">Alocar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
@endsection
