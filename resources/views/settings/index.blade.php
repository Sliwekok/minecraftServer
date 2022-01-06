@extends('layouts.dashboard')

@section('content')

    @if($server == null)

        <div id="noServersFound" class="col-12">
            <div id="messageNoServers" class="col-12">
                <h3>Wygląda na to, że jeszcze nie masz założonego żadnego serwera</h3>
            </div>

            <div id="add" class="col-4 offset-4 current redirect" data-page-redirect="/settings/create">
                <p>Stwórz go</p>
                <i class="icon-plus"></i>
            </div>
        </div>

    @else

        <div id="serverFound" class="col-12">

            <div class="row">
                <div data-server-status="{{$server[0]->status}}" class="col-6 {{$server[0]->status}} offset-3" id="generalData">
                    <div id="ip">
                        <p id="copy" data-toggle="tooltip" data-placement="top" title="Kliknij aby skopiować!">
                            {{$server[0]->ip}}:{{$server[0]->port}}
                        </p>                          
                    </div>
                    <div id="onlineStatus">
                        <p>Serwer {{$server[0]->name}} jest obecnie: {{$server[0]->status}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2 offset-5" id="serverAction">
                    <p id="caption">Uruchom <i class="icon-off"></i></p>
                    <span id="return"></span>
                </div>
            </div>

        </div>

    @endif


@endsection