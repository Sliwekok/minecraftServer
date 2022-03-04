@extends('layouts.dashboard')

@section('content')

    <div class="row">

        menagment

        <p>
            <form method="post" action="/settings/deleteServer">
                @csrf
                <input type="submit" value="Delete Server">    
            </form>
        </p>

    </div>

@endsection
