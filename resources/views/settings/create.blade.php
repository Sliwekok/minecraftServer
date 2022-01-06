@extends('layouts.dashboard')

@section('content')

    <div class="row" id="create">

        <form method="post" action="/settings/create" class="col-12 hidden" id="dataAboutServer">
            
            @csrf
            
            <div id="generalData" class="col-12">

                <h2>Stwórz serwer</h2>

                <div class="form-group">
                    <label for="serverName"><p>Nazwa serwera <span class="required">*</span></p></label><br>
                    <input type="text" value="{{ old('serverName') }}" maxlength="64" name="serverName" placeholder="Wpisz nazwę serwera*" id="serverName" class="insertData">
                    <small id="maxNameLength" class="form-text text-muted check-length">Maksymalna ilość znaków: <span class="currentAmount">0</span>/64</small>
                    <span class="error" id="errorServerName">@if(isset($errorMessage)) {{$errorMessage}} @endif</span>
                </div>

                <div class="form-group">
                    <label for="serverDescription"><p>Opis serwera</p></label><br>
                    <input value="{{ old('serverDescription') }}" maxlength="128" type="text" name="serverDescription" placeholder="Opisz swój serwer krótką notką" id="serverDescription" class="insertData">
                    <small id="maxDescriptionLength" class="form-text text-muted check-length">Maksymalna ilość znaków: <span class="currentAmount">0</span>/128</small>
                    <span class="error" id="errorServerDescription"> @if(isset($errorMessage)) {{$errorMessage}} @endif </span>
                </div>

                <div class="form-group">
                    <label for="motdMessage"><p>Wiadomość powitalna serwera</p></label><br>
                    <input type="text" value="{{ old('motdMessage') }}" maxlength="256" name="motdMessage" placeholder="Wiadomość powitalna" id="motdMessage" class="insertData">
                    <small class="form-text text-muted">Wyświetli się ona przy zalogowaniu na serwer</small>
                </div>

                <div class="form-group">
                    <label for="serverPlayersNumber"><p>Podaj ilość graczy <span class="required">*</span></p></label>
                    <select id="serverPlayersNumber" name="maxPlayers">
                        <option value="4">4</option>
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="32">32</option>
                        <option value="64">64</option>
                        <option value="128">128</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="version"><p>Wybierz wersję serwera <span class="required">*</span></p></label>
                    <input id="version" name="version" list="serverVersion" value="{{ old('version') }}">
                    <datalist id="serverVersion">
                        <option value="1.0.0">1.0.0</option>
                        <option value="1.0.1">1.0.1</option>
                        <option value="1.1.1">1.1.1</option>
                        <option value="1.2.1">1.2.1</option>
                        <option value="1.2.2">1.2.2</option>
                        <option value="1.2.3">1.2.3</option>
                        <option value="1.2.4">1.2.4</option>
                        <option value="1.2.5">1.2.5</option>
                        <option value="1.3.1">1.3.1</option>
                        <option value="1.3.2">1.3.2</option>
                        <option value="1.4.2">1.4.2</option>
                        <option value="1.4.4">1.4.4</option>
                        <option value="1.4.5">1.4.5</option>
                        <option value="1.4.6">1.4.6</option>
                        <option value="1.4.7">1.4.7</option>
                        <option value="1.5">1.5</option>
                        <option value="1.5.1">1.5.1</option>
                        <option value="1.5.2">1.5.2</option>
                        <option value="1.6.1">1.6.1</option>
                        <option value="1.6.1">1.6.1</option>
                        <option value="1.6.2">1.6.2</option>
                        <option value="1.6.4">1.6.4</option>
                        <option value="1.7.2">1.7.2</option>
                        <option value="1.7.5">1.7.5</option>
                        <option value="1.7.6">1.7.6</option>
                        <option value="1.7.7">1.7.7</option>
                        <option value="1.7.8">1.7.8</option>
                        <option value="1.7.9">1.7.9</option>
                        <option value="1.7.10">1.7.10</option>
                        <option value="1.8">1.8</option>
                        <option value="1.8.1">1.8.1</option>
                        <option value="1.8.2">1.8.2</option>
                        <option value="1.8.3">1.8.3</option>
                        <option value="1.8.4">1.8.4</option>
                        <option value="1.8.5">1.8.5</option>
                        <option value="1.8.6">1.8.6</option>
                        <option value="1.8.7">1.8.7</option>
                        <option value="1.8.8">1.8.8</option>
                        <option value="1.8.9">1.8.9</option>
                        <option value="1.9">1.9</option>
                        <option value="1.9.1">1.9.1</option>
                        <option value="1.9.2">1.9.2</option>
                        <option value="1.9.3">1.9.3</option>
                        <option value="1.9.4">1.9.4</option>
                        <option value="1.10">1.10</option>
                        <option value="1.10.1">1.10.1</option>
                        <option value="1.10.2">1.10.2</option>
                        <option value="1.11">1.11</option>
                        <option value="1.11.1">1.11.1</option>
                        <option value="1.11.2">1.11.2</option>
                        <option value="1.12">1.12</option>
                        <option value="1.12.1">1.12.1</option>
                        <option value="1.12.2">1.12.2</option>
                        <option value="1.13">1.13</option>
                        <option value="1.13.1">1.13.1</option>
                        <option value="1.13.2">1.13.2</option>
                        <option value="1.14">1.14</option>
                        <option value="1.14.1">1.14.1</option>
                        <option value="1.14.2">1.14.2</option>
                        <option value="1.14.3">1.14.3</option>
                        <option value="1.14.4">1.14.4</option>
                        <option value="1.15">1.15</option>
                        <option value="1.15.1">1.15.1</option>
                        <option value="1.15.2">1.15.2</option>
                        <option value="1.16">1.16</option>
                        <option value="1.16.1">1.16.1</option>
                        <option value="1.16.2">1.16.2</option>
                        <option value="1.16.3">1.16.3</option>
                        <option value="1.16.4">1.16.4</option>
                        <option value="1.16.5">1.16.5</option>
                        <option value="1.17">1.17</option>
                        <option value="1.17.1">1.17.1</option>
                        <option value="1.18">1.18</option>
                        <option value="1.18.1">1.18.1</option>
                    </datalist>
                    <small class="form-text text-muted">Wybierz jedną z dostępnych wersji serwera</small>
                    <span class="error" id="errorVersion"> @if(isset($errorMessage)) {{$errorMessage}} @endif </span>
                </div>

                <div class="form-group">
                    <label for="difficulty"><p>Wskaż poziom trudności<span class="required">*</span></p></label>
                    <select id="difficulty" name="difficulty">
                        <option value="peaceful">Peaceful</option>
                        <option value="easy">Easy</option>
                        <option value="normal" selected>Normal</option>
                        <option value="hard">Hard</option>
                    </select>
                    <small class="form-text text-muted">Wskaż poziom trudności obowiązujący na serwerze. Domyślny: normalny</small>
                </div>

                <button type="button" class="btn btn-primary next">Dalej</button>

            </div>

            <div id="serverSettings" class="col-12">

                <h2>Zaawansowane ustawienia serwera</h2>

                <div class="form-group">
                    <label for="serverSeed"><p>Seed serwera</p></label>
                    <input type="text" name="serverSeed" placeholder="Wklej seed tutaj!" id="serverSeed" class="insertData">
                    <small class="form-text text-muted">Jeżeli masz wybrany już seed, wklej go tutaj.</small>
                </div>

                <div class="form-group">
                    <p>Aktywować nether?<span class="required">*</span></p>
                    <label>Tak <input type="radio" value="true" name="isNether" checked="checked"></label>
                    <label>Nie <input type="radio" value="false" name="isNether"></label>
                    <small class="form-text text-muted">Zaznacz, jeżeli chcesz zabronić wstępu do netheru</small>
                </div>

                <div class="form-group">
                    <p>Serwer Hardcore?<span class="required">*</span></p>
                    <label>Tak <input type="radio" value="true" name="isHardcore"></label>
                    <label>Nie <input type="radio" value="false" name="isHardcore" checked="checked"></label>
                    <small class="form-text text-muted">Wskaż, czy serwer ma być serwerem Hardcore (po śmierci traci się wszystko)</small>
                </div>

                <div class="form-group">
                    <p>Włączyć PVP?<span class="required">*</span></p>
                    <label>Tak <input type="radio" value="true" name="pvpOn" checked="checked"></label>
                    <label>Nie <input type="radio" value="false" name="pvpOn"></label>
                    <small class="form-text text-muted">Wskaż, czy serwer ma być serwerem Hardcore (po śmierci traci się wszystko)</small>
                </div>

                <div class="form-group">
                    <p>Tylko gracze premium?<span class="required">*</span></p>
                    <label>Tak <input type="radio" value="true" name="isPremium"></label>
                    <label>Nie <input type="radio" value="false" name="isPremium" checked="checked"></label>
                    <small class="form-text text-muted">Zaznacz, jeżeli gracze będą musieli mieć potwierdzone konto w usłudze Xbox Live</small>
                </div>

                <div class="form-group">
                    <p>Autokick<span class="required">*</span></p>
                    <select name="autokick" id="autokick">
                        <option value="0">0</option>
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                    </select>
                    <small class="form-text text-muted">Wskaż po jakim czasie nieaktywności gracz zostanie wyrzucony (w minutach). 0 - nie zostanie wyrzucony</small>
                </div>
                

                <button type="button" class="btn btn-danger previous">Wróć</button>
                
                <input type="submit" class="btn btn-primary" value="Gotowe" id="submit">

            </div>

        </form>

    </div>

@endsection
