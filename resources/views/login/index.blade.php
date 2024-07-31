@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Área Restrita</h3>
                                </div>
                                <div class="card-body">
                                    <x-alert-login />
                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email"
                                                value="{{ old('email') }}" placeholder="Seu e-mail" />
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password"
                                                    value="{{ old('password') }}" placeholder="Sua senha" />
                                                <label for="password">Senha</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                    value="" />
                                                <label class="form-check-label"
                                                    for="inputRememberPassword">Lembrar-me</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small text-decoration-none"
                                                    href="#">Esqueceu a Senha?</a>
                                                <button type="submit" class="btn btn-primary" href="#">Acessar</a>
                                            </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">Precisa de uma conta? <a class="text-decoration-none"
                                            href="#">Inscreva-se!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
