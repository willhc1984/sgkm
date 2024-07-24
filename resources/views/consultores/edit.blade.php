@extends('layouts.admin')

@section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Cadastrar</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consultor.index') }}">Consultores</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>  

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span>
                    <a href="{{ route('consultor.index') }}" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-square-plus"></i> Listar</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />          

                <form class="row g-3" action="{{ route('consultor.update', ['consultor' => $consultor->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome', $consultor->nome) }}" 
                            placeholder="Nome do consultor(a)" >
                    </div>
                    <div class="col-12">
                        <label  for="price">Contato:</label>
                        <input type="text" class="form-control" name="contato" id="contato" value="{{ old('contato', $consultor->contato) }}"
                            placeholder="Contato" >
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