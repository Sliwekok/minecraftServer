<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> McSerwer @if(isset($pageName)) {{ $pageName }} @endif </title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container-fluid" style="padding:0px; position: relative;">
<div class="row" style="padding:0px; position: relative;">

    {{-- background video container, image is given in end blade file as new section --}}
    @yield('backgroundVideo')

    {{-- nav --}}
    <div class="container-fluid">
        <div class="row">
            <nav id="home" class="navbar col-12">
                <div id="logo" class="col-3"><a href="/"><h1>McSerwer</h1></a></div>
                <div class="navItems col-5 offset-1">
                    @auth
                        <div class="navItem offset-6 col-3"><a href="/settings"><div class="col-10 offset-1">Zarządzaj</div></a></div>
                        <div class="navItem col-3"><a href="/logout"><div class="col-10 offset-1">Wyloguj</div></a></div>
                    
                    @else
                        <div class="navItem col-3"><a href="#"><div class="col-10 offset-1">Oferta</div></a></div>
                        <div class="navItem col-3"><a href="#"><div class="col-10 offset-1">Usługi</div></a></div>
                        <div class="navItem col-3"><a href="#"><div class="col-10 offset-1">Kontakt</div></a></div>
                        <div class="navItem col-3"><a href="/register"><div class="col-10 offset-1">Dołącz</div></a></div>
                    
                    @endauth
                </div>
            </nav>
        </div>
    </div>

    {{-- content --}}
    <main class="container">
        <div class="row">
            @yield('content')
        </div>
    </main>

</div>
</div>

</body>
</html>