@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Exportar produtos</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="/dashboard">Início</a></li>
                <li class="breadcrumb-item active">Exportar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Exportar produtos </b></span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('produto.csv') }}" method="POST">
                    @csrf
                    @method('POST')
                   
                    <div class="col-6">
                        <label for="inicio" class="form-label">Código inicial:</label>
                        <input type="number" class="form-control" name="inicio" id="inicio" value="{{ old('inicio') }}"
                            placeholder="Código inicial">
                    </div>
                    <div class="col-6">
                        <label for="fim">Código final:</label>
                        <input type="number" class="form-control" name="fim" id="fim"
                            value="{{ old('fim') }}" placeholder="Código final">
                    </div>                   
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm">Exportar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
@endsection
