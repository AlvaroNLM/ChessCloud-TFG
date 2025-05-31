@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/adminGame.js') }}"></script>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre y apellido blancas</th>
            <th>Ranking, país y título blancas</th>
            <th>Nombre, apellido negras</th>
            <th>Ranking, país y título negras</th>
            <th>Torneo</th>
            <th>Resultado</th>
            <th>Movimientos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <style>
                input
                {
                    background-color: transparent;
                    border: 0px;
                    
                }
            </style>
            <tr>
                    <td><input value="{{$game->id}}" style="width: 25px;" readonly></td>                          
                    <td>
                        <input value="{{$game->name_white}}" style="width: 100%;">
                        <input value="{{$game->surname_white}}" style="width: 100%;">
                    </td>
                    <td>
                        <input value="{{$game->ranking_white}}" style="width: 100%;">
                        <input value="{{$game->country_white}}" style="width: 100%;">
                        <select class="form-control" name="title_white">
                            <option value="None">None</option>
                            <option value="CM" @if ($game->title_white == 'CM') selected @endif>CM</option>
                            <option value="WCM" @if ($game->title_white == 'WCM') selected @endif>WCM</option>
                            <option value="FM" @if ($game->title_white == 'FM') selected @endif>FM</option>
                            <option value="WFM" @if ($game->title_white == 'WFM') selected @endif>WFM</option>
                            <option value="IM" @if ($game->title_white == 'IM') selected @endif>IM</option>
                            <option value="WIM" @if ($game->title_white == 'WIM') selected @endif>WIM</option>
                            <option value="GM" @if ($game->title_white == 'GM') selected @endif>GM</option>
                            <option value="WGM" @if ($game->title_white == 'WGM') selected @endif>WGM</option>
                        </select>
                    </td>
                    <td>
                        <input value="{{$game->name_black}}" style="width: 100%;">
                        <input value="{{$game->surname_black}}" style="width: 100%;">
                    </td>
                    <td>
                        <input value="{{$game->ranking_black}}" style="width: 100%;">
                        <input value="{{$game->country_black}}" style="width: 100%;">
                        <select class="form-control" name="title_black">
                            <option value="None">None</option>
                            <option value="CM" @if ($game->title_black == 'CM') selected @endif>CM</option>
                            <option value="WCM" @if ($game->title_black == 'WCM') selected @endif>WCM</option>
                            <option value="FM" @if ($game->title_black == 'FM') selected @endif>FM</option>
                            <option value="WFM" @if ($game->title_black == 'WFM') selected @endif>WFM</option>
                            <option value="IM" @if ($game->title_black == 'IM') selected @endif>IM</option>
                            <option value="WIM" @if ($game->title_black == 'WIM') selected @endif>WIM</option>
                            <option value="GM" @if ($game->title_black == 'GM') selected @endif>GM</option>
                            <option value="WGM" @if ($game->title_black == 'WGM') selected @endif>WGM</option>
                        </select>
                    </td>
                    <td><input value="{{$game->tournament}}" style="width: 100%;"></td>
                    <td>
                        <select class="form-control" name="resultado">
                            <option value="0" @if ($game->result == 0) selected @endif>1 - 0</option>
                            <option value="1" @if ($game->result == 1) selected @endif>1/2 - 1/2</option>
                            <option value="2" @if ($game->result == 2) selected @endif>0 - 1</option>
                        </select>
                    </td>
                    <td><input value="{{$game->movements}}" readonly></input></td>  
                    <td>
                        <a onclick="edit(this)" id="edit" name="edit" value="{{$game->id}}" class="btn btn-link"> &#x270e; </a>
                        <a onclick="borrar(this)" id="delete" name="delete" value="{{$game->id}}" class="btn btn-danger"> x </a>
                    </td>
                    

            </tr>
        @endforeach

        <tr>        
                <td></td>
                <td>
                    <input placeholder="nombre blancas" required>
                    <input placeholder="apellido blancas" required>
                </td>
                <td>
                    <input placeholder="ranking blancas" style="width: 100%;" required>
                    <input placeholder="país blancas" required>
                    <select class="form-control" name="titulo_blancas">
                        <option value="None">None</option>
                        <option value="CM">CM</option>
                        <option value="WCM">WCM</option>
                        <option value="FM">FM</option>
                        <option value="WFM">WFM</option>
                        <option value="IM">IM</option>
                        <option value="WIM">WIM</option>
                        <option value="GM">GM</option>
                        <option value="WGM">WGM</option>
                    </select>
                </td>
                <td>
                    <input placeholder="nombre negras" required>
                    <input placeholder="apellido negras" required>
                </td>
                <td>
                    <input placeholder="ranking blancas" style="width: 100%;" required>
                    <input placeholder="país negras" required>
                    <select class="form-control" name="titulo_negras">
                        <option value="None">None</option>
                        <option value="CM">CM</option>
                        <option value="WCM">WCM</option>
                        <option value="FM">FM</option>
                        <option value="WFM">WFM</option>
                        <option value="IM">IM</option>
                        <option value="WIM">WIM</option>
                        <option value="GM">GM</option>
                        <option value="WGM">WGM</option>
                    </select>
                </td>
                <td><input placeholder="torneo" required></td>
                <td>
                    <select class="form-control" name="resultado">
                        <option value="0">1 - 0</option>
                        <option value="1">1/2 - 1/2</option>
                        <option value="2">0 - 1</option>
                    </select>
                </td>
                <td>
                    <input id="movimientos" placeholder="movimientos" required></input>
                    <label>Ejemplo: 1.e4 e5 2.Nf3</label>
                </td>  
                <td>
                    <button onclick="insert(this)" type="submit" id="add" class="btn btn-success"> + </button>
                </td>
        </tr>

    </tbody>
</table>

<form id="form" class="form-horizontal invisible" role="form" action="{{ action('GameController@execAdmin') }}" method="POST">

        <input id="id" name="id" type="text"></input>
        <input id="name_white" name="name_white" type="text"></input>
        <input id="surname_white" name="surname_white" type="text"></input>
        <input id="ranking_white" name="ranking_white" type="text"></input>
        <input id="country_white" name="country_white" type="text"></input>
        <input id="name_black" name="name_black" type="text"></input>
        <input id="surname_black" name="surname_black" type="text"></input>
        <input id="ranking_black" name="ranking_black" type="text"></input>
        <input id="country_black" name="country_black" type="text"></input>
        <input id="tournament" name="tournament" type="text"></input>
        <input id="movements" name="movements" type="text"></input>
        <input id="result" name="result" type="text"></input>
        <input id="title_white" name="title_white" type="text"></input>
        <input id="title_black" name="title_black" type="text"></input>
        <input id="type"  name="type"></input>
        {{ csrf_field() }}
</form>

{{ $games->links() }}
@endsection