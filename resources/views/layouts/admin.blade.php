<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles_sbadmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>S.G.K.M - Sistema de Gestão KMartins</title>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: black;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html"><b>S.G.K.M</b></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
            <li class="d-flex flex-column justify-content-center align-items-center me-2" style="color: white;">
                <b>@if (auth()->check())
                    {{ auth()->user()->name }}
                @endif</b>
            </li>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Sair</a></li>
            </ul>

            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'dashboard']) class="nav-link" href="{{ route('dashboard.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Início
                        </a>

                        <a @class([
                            'nav-link',
                            'active' => isset($menu) && $menu == 'consultores',
                        ]) class="nav-link" href="{{ route('consultor.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-handshake"></i></div>
                            Consultores
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'produtos']) class="nav-link" href="{{ route('produto.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gem"></i></i></div>
                            Produtos
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'usuarios']) class="nav-link" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></i></div>
                            Usuários
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'papeis']) class="nav-link" href="{{ route('role.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-scroll"></i></div>
                            Papéis
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'permissoes']) class="nav-link" href="{{ route('permissions.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-eye"></i></div>
                            Permissões
                        </a>

                        <a class="nav-link" href="{{ route('login.destroy') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                            Sair
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Usuário: <b>
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </b>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                @yield('content')
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; S.G.K.M. {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts_sbadmin.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>


</body>

</html>
