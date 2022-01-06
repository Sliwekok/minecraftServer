@extends('layouts.app')

@section('content')

    <div class="container">
    
        <div class="row" id="welcome">
            Witaj mcserwer bla bla bla
            @auth

            hej

            @endauth
        </div>

    </div>

@endsection

@section('backgroundVideo')
<div id="video-container">
    <video id="mainBackgroundVideo" src="/storage/img/main.webp" autoplay loop playsinline muted></video>
</div>
@endsection
