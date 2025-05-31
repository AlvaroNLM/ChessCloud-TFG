@extends('layouts.master')
@section('content')


<!--Buscador-->    
<div class="container">
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <div class="card">
                <h4 style="background-color: #007bff; border-color: #007bff; color: white;" class="card-heading">Buscador</h4>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ action('GameController@buscar') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <div>
                                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="nombre o apellidos" value="{{ Request::get('nombre') }}" />
                                </div>
                                <br></br>
                                <div>
                                    <input id="torneo" name="torneo" type="text" class="form-control" placeholder="torneo" value="{{ Request::get('torneo') }}"/>
                                </div>
                                <br></br>
                            </div>
                            <div class="col">
                                <div>
                                    <div>
                                        <input id="ranking" name="ranking" type="text" class="form-control" placeholder="ranking" value="{{ Request::get('ranking') }}" />
                                    </div>
                                    <br></br> 
                                    <div>
                                        <select class="form-control" name="jugador_buscar" id="jugador_buscar">
                                            <option value="Ambos">ambos</option>
                                            <option value="Jugador blancas">jugador blancas</option>
                                            <option value="Jugador negras">jugador negras</option>
                                        </select>
                                    </div>
                                    <br></br>
                                </div> 
                            </div>         
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Buscador-->


<div class="container">
    <div class="row">
        <div class="card" style="background-color: #F6E3DF; border: none;">
            <h1>Lista de partidas</h1>
        </div>
    </div>

    <br></br>

    <div>
        {!! $games->render() !!}
    </div>
    
    <br></br>
    @if(!empty($games) && count($games) > 0) 
        
        @foreach ($games as $g)
        <div class="row">
            <div class="card" style="width: 100%;">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$g->id}}</div>
                <div class="card-body">
                    <h4 class="card-title"> {{$g->surname_white}},{{$g->name_white}} vs {{$g->surname_black}},{{$g->name_black}} in {{$g->tournament}}</h4>            
                    <p class="card-text">{{$g->movements}}</p>
                    <a href="/partida/{{$g->id}}" class="btn btn-primary">Ver Partida</a>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No hay partidas del jugador</p>
    @endif
</div>




@endsection