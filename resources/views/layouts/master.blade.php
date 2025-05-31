<html lang="es">
    <head>
    <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Icono de la web -->
        <link rel="icon" href="images/peon.jpg">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- mi css propio -->
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">
        <!-- libreria de chessboard -->
        <!-- css -->
        <link href="{{ asset('css/chessboard-1.0.0.min.css') }}" rel="stylesheet">
        <!-- js -->
        <script src="{{ asset('js/chessboard-1.0.0.js') }}"></script>
        <script src="{{ asset('js/chess.min.js') }}"></script>
    </head>

    <body>   
            <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
                    <img src="/images/peon2.png" class="navbar-brand"></img>
                    <a class="navbar-brand" href="/home">ChessCloud</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacion">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navegacion">
                        <ul class="navbar-nav">
                            @if(Auth::check())
                                <li class="nav-item"><span class="navbar-text">Bienvenido {{Auth::User()->name}}</span></li>
                                <li class="nav-item"><a class="nav-link" href="/modificarUsuario">Perfil</a></li>
                                <li class="nav-item"><a class="nav-link" href="/salir">Cerrar Sesión</a></li>
                                <li class="nav-item"><a class="nav-link" href="/partidas">Partidas</a></li>
                                <li class="nav-item"><a class="nav-link" href="/registrarPartida">Nueva partida</a></li>
                                <li class="nav-item"><a class="nav-link" href="/practicar">Practicar</a></li>
                                    @if(Auth::user()->rol_id == 2)
                                        <li class="nav-item"><a class="nav-link" href="/admin/usuarios">Admin usuarios</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/admin/partidas">Admin partidas</a></li>
                                    @endif
                            @else
                                <li class="nav-item"><a class="nav-link" href="/entrar">Entrar</a></li>
                                <li class="nav-item"><a class="nav-link" href="/registrar">Registrarse</a></li>
                                <li class="nav-item"><a class="nav-link" href="/partidas">Partidas</a></li>
                            @endif
                        </ul>
                    </div>
            </nav>

            @yield('content')
        <footer class="sticky-bottom">
            <a style="color: black;">Álvaro Navarro López-Menchero</a>
        </footer>
    </body>
</html>