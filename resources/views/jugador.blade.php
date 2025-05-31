@extends('layouts.master')
@section('content')
<div class="container">
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <div class="card">           
            <h1 style="background-color: #007bff; border-color: #007bff; color: white;" class="card-heading">Datos del jugador</h1>
                <div class="card-body" >
                    <label for="name" class="col-md-4 control-label"> Apellidos, nombre: {{$jugador->surname}}, {{$jugador->name}}</label>
                    <label for="ranking" class="col-md-4 control-label"> Ranking: {{$jugador->ranking}}</label>
                    <label for="title" class="col-md-4 control-label"> Título: {{$jugador->title}}</label>
                    <label for="country" class="col-md-4 control-label"> País: {{$jugador->country}}</label>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="card" style="background-color: #F6E3DF; border: none;">
            <h1>Lista de partidas</h1>
        </div>
    </div>
    <br></br>
    @if(!empty($games) && count($games) > 0) 
        <div class="row">
            @foreach ($games as $g)
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida</div>
                <div class="card-body">
                    <h4 class="card-title"> {{$g->surname_white}},{{$g->name_white}} vs {{$g->surname_black}},{{$g->name_black}} in {{$g->tournament}}</h4>            
                    <p class="card-text">{{$g->movements}}</p>
                    <a href="/partida/{{$g->id}}" class="btn btn-primary">Ver Partida</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p>No hay partidas del jugador</p>
    @endif
</div>

@endsection