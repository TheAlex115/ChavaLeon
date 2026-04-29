<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Token CSRF para seguridad en formularios -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título de la aplicación -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Archivos compilados con Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Barra de navegación superior -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <!-- Logo o título del sistema -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Menú
                </a>

                <!-- Botón para colapsar menú en pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del menú -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Lado izquierdo del menú -->
                    <ul class="navbar-nav me-auto">
                        <!-- Menú desplegable de gestión -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuGestion" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Gestión
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menuGestion">
                                <!-- Opción Productos -->
                                <li><a class="dropdown-item" href="{{ route('producto.index') }}">Productos</a></li>
                                <!-- Opción Empleados -->
                                <li><a class="dropdown-item" href="{{ route('empleado.index') }}">Empleados</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Lado derecho del menú (autenticación) -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Links de login/register si el usuario no está autenticado -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Dropdown con el nombre del usuario autenticado -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Opción de logout -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <!-- Formulario oculto para logout -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Aquí se inyecta el contenido de cada vista -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
