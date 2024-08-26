@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Alterar consultor</h2>
        <ol class="breadcrumb mb-3 mt-3">
            <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produto.index') }}">Produtos</a></li>
            <li class="breadcrumb-item active">Alterar consultor do produto</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Alterar consultor - <b> {{ $produto->nome }} - COD.: {{ $produto->id }} </b></span>
        </div>

        <div class="card-body">

            <x-alert />

            <form class="row g-3" action="{{ route('produto.updateConsultor', ['produto' => $produto->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="name">Consultor:</label>
                    <select class="form-select" name="consultor" id="consultor" aria-label="Default select example">
                        <option selected></option>
                        @forelse($consultores as $consultor)
                        <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary bt-sm">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
@endsection