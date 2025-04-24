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

                <form class="row g-3" action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <input type="hidden" name="consultor_id" id="consultor_id" value="{{ $produto->consultor_id }}">
                        
                        <label for="name" class="form-label">Nome do produto:</label>
                        <input type="text" class="form-control" name="nome" id="nome"
                            value="{{ old('nome', $produto->nome) }}" placeholder="Nome do produto">
                    </div>
                    <div class="col-6">
                        <label for="preco_fornecedor">Preço do Fornecedor:</label>
                        <input type="text" class="form-control" name="preco_fornecedor" id="preco_fornecedor"
                            value="{{ old('preco_fornecedor', number_format($produto->preco_fornecedor, 2, ',', '.')) }}"
                            placeholder="R$">
                    </div>
                    <div class="col-6">
                        <label for="preco_final">Preço Final:</label>
                        <input type="text" class="form-control" name="preco_final" id="preco_final"
                            value="{{ old('preco_final', number_format($produto->preco_final, 2, ',', '.')) }}"
                            placeholder="R$">
                    </div>
                    <div class="col-6">
                        <label for="comissao_consultor">Comissão do consultor (%)</label>
                        <input type="number" class="form-control" name="comissao_consultor" id="comissao_consultor"
                            value="{{ old('comissao_consultor', $produto->comissao_consultor) }}"
                            placeholder="Comissão do consultor (%)">
                    </div>
                    <div class="col-6">
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
                    <div class="col-md-6">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-select" name="situacao">
                            <option selected>{{ $produto->situacao }}</option>
                            <option value="Em estoque">Em estoque</option>
                            <option value="Vendido">Vendido</option>
                            <option value="Pago">Pago</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="categoria" class="form-label">Categoria do produto</label>
                        <select class="form-select" name="categoria">
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" 
                                {{ old('categoria_id', $produto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                             </option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="descricao_curta" class="form-label">Descrição curta</label>
                        <textarea class="form-control" id="descricao_curta" name="descricao_curta" rows="3">{{ old('descricao_curta') }}</textarea>
                    </div>
                    <div class="col-6">
                        <label for="images" class="form-label">Imagens:</label>
                        <input type="file" class="form-control" name="images[]" multiple id="images" placeholder="Imagens">
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
