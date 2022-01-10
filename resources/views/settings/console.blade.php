@extends('layouts.dashboard')

@section('content')

    @if($server[0]->status == 'offline')

        <div class="col-8 offset-2">
            <h2>Wygląda na to, że serwer nie jest właczony ...</h2>
            <p>Przejdź <a class="link" href="/settings/">tutaj</a> aby go uruchomić</p>
        </div>

    @else

        <div class="col-10 offset-1" id="console">
            <div id="messages">
                {{-- @foreach($messages as $message)
                    <div class="row">
                        <div class="col-12 message"><span>{{ $message->owner }}</span></div>
                    </div>
                @endforeach --}}
                <div class="row" id="noCommandsFound">
                    <div class="col-12 message"><span>Tutaj pojawią się Twoje komendy</span></div>
                </div>

            </div>

            <form method="post" action="/settings/sendCommand" class="col-12" id="sendCommand">
                @csrf
                <div class="form-group">
                    <input autofocus="autofocus" required minlength="1" id="command" name="command" type="text" class="form-control" placeholder="Type /help to see avaible commands">
                    <input type="submit" class="form-control" value=">" id="sendSubmitWithFontello">
                    {{-- <span class="error" id="errorCommand">123</span> --}}
                </div>
            </form>
        </div>

    @endif

@endsection
