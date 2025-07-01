@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Alocar</h2>
        <ol class="breadcrumb mb-3 mt-3">
            <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
            <li class="breadcrumb-item"><a href="{{ route('consultor.index') }}">Consultores</a></li>
            <li class="breadcrumb-item active">Alocar</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Alocar produtos</span>
        </div>

        <div class="card-body">

            <x-alert />

            <div class="card-body">
                <x-alert />
                <form class="row g-3" action="{{ route('consultor.alocarEmMassaUpdate') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="inicio" class="form-label">Digite os códigos dos produtos (separados por ponto e vírgula)</label>
                        <input type="text" class="form-control" name="codigos" id="codigos" value="{{ old('codigos') }}"
                            placeholder="Ex: 1;5;10;15">
                    </div>

                    <div class="mb-3">
                        <label for="novo_consultor" class="form-label">Novo Consultor</label>
                        <select class="form-select" name="novo_consultor" required>
                            @foreach($consultores as $consultor)
                                <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm">Alocar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>

@endsection