<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> McSerwer @if(isset($pageName)) {{ $pageName }} @endif </title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous" defer></script>
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

    {{-- nav --}}
    <nav id="dashboard" class="container col-3">
        <div class="row">
            <div class="col-12">
                <div id="logo" class="col-12"><a href="{{ url('/settings/')}}"><h1>McSerwer</h1></a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="menu">
                <div class="menuItem col-9 redirect" data-page-redirect="/settings/menagment"><span class="col-12">Zarządzanie</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/settings/files"><span class="col-12">Pliki</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/settings/logs"><span class="col-12">Dziennik</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/settings/console"><span class="col-12">Konsola</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/settings/players"><span class="col-12">Gracze</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/account"><span class="col-12">Konto</span><span class="arrowRedirect"><i class="icon-right-open"></i></div>
                <div class="menuItem col-9 redirect" data-page-redirect="/logout"><span class="col-12">Wyloguj się</span></div>
            </div>
        </div>

    </nav>

    {{-- content  --}}
    <main id="settings" class="container col-9">
        <div class="row">

            {{-- error message div --}}
            @if (Session::has('error'))
            <div class="alert alert-danger col-6 offset-3 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Nastąpił błąd</h4>
                <p>{{ Session::get('error') }}</p>
                <p class="mb-0"></p>
            </div>
            @endif

            @yield('content')
        </div>
    </main>    

</div>
</div>

</body>
</html>
