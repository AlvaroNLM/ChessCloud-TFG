@extends('layouts.master')
@section('content')


<script src="{{ asset('js/main.js') }}"></script>

<div class="container">
    <div class="row">
        <!-- parte 1 -->
        <div class="col" id="parte1">
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$game->id}}</div>
                <div class="card-body">
                    <p>
                        <a href="/jugador/{{$game->id_white}}">{{$game->surname_white}},{{$game->name_white}} </a><a>{{$Elo_blancas}}</a>
                        <span>vs</span>
                        <a href="/jugador/{{$game->id_black}}">{{$game->surname_black}},{{$game->name_black}} </a><a>{{$Elo_negras}}</a>
                        <span>in {{$game->tournament}}</span>
                    </p>
                    <p>Resultado: {{$result}}</p>
                    <p id="turno"></p>
                    <p id="movimientos">{{$game->movements}}</p>
                    <p style="visibility: hidden; display: none;" id="movimientos-procesados">{{$game->movements_processed}}</p>
                    <!-- jugadas con los listener -->
                    <div id="listeners"></div>
                    
                    <p> Para (des)activar el análisis de IA presionar el botón, ralentizará el proceso a cambio.</p>
                    <label class="switch">
                        <input id="IA" type="checkbox">
                        <span id="span" class="slider round"></span>
                    </label>
                    <p id="valoration">Desactivado</p>
                </div>
            </div>
        </div>
        <!-- parte 2 -->
        <div class="col" id="parte2">
            <div class="card">
                <div class="card-header">Tablero</div>
                <div id="myBoard"></div>
                <div class="row" id="div_botones" style="background-color: F6E3DF;"> 
                    <div class="col">
                        <button type="button" id="before" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">🢘 Anterior</button>
                    </div>
                    <div class="col">
                        <button type="button" id="next" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">Siguiente 🢚</button>
                    </div>
                </div>
                <div class="row" id="div_boton_volver" style="background-color: F6E3DF;align-items: center; justify-content: center;"> 
                    <button type="button" id="volver" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 95%; border-color: black;">Volver</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection