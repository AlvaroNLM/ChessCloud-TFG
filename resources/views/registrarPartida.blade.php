@extends('layouts.master')
@section('content')

<script src="{{ asset('js/partida.js') }}"></script>

<div class="container">
    <div class="form-group">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h1 style="background-color: #007bff; border-color: #007bff; color: white;" class="card-heading">Registrar partida</h1>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ action('GameController@crearPartida') }}">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col">
                                    <input id="nombre_blancas" type="text" class="form-control" name="nombre_blancas" placeholder="nombre jugador blancas" required autofocus>
                                </div>
                                <div class="col">
                                    <input id="apellido_blancas" type="text" class="form-control" name="apellido_blancas" placeholder="apellido jugador blancas" required autofocus>
                                </div>
                            </div>
                            <br></br>
                            <div class="row">
                                <div class="col">
                                    <input id="pais_blancas" type="text" class="form-control" name="pais_blancas" placeholder="País jugador blancas" required autofocus>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label>Título blancas</label>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="titulo_blancas" id="titulo_blancas">
                                                <option value="None">None</option>
                                                <option value="CM">CM</option>
                                                <option value="WCM">WCM</option>
                                                <option value="CM">FM</option>
                                                <option value="WCM">WFM</option>
                                                <option value="CM">IM</option>
                                                <option value="WCM">WIM</option>
                                                <option value="CM">GM</option>
                                                <option value="WCM">WGM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br></br>
                            <div class="row">
                                <div class="col">
                                    <input id="nombre_negras" type="text" class="form-control" name="nombre_negras" placeholder="nombre jugador negras" required autofocus>
                                </div>
                                <div class="col">
                                    <input id="apellido_negras" type="text" class="form-control" name="apellido_negras" placeholder="apellido jugador negras" required autofocus>
                                </div>
                            </div>
                            <br></br>
                            <div class="row">
                                <div class="col">
                                    <input id="pais_negras" type="text" class="form-control" name="pais_negras" placeholder="País jugador negras" required autofocus>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label>Título negras</label>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="titulo_negras" id="titulo_negras">
                                                <option value="None">None</option>
                                                <option value="CM">CM</option>
                                                <option value="WCM">WCM</option>
                                                <option value="CM">FM</option>
                                                <option value="WCM">WFM</option>
                                                <option value="CM">IM</option>
                                                <option value="WCM">WIM</option>
                                                <option value="CM">GM</option>
                                                <option value="WCM">WGM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br></br>
                            <div class="row">
                                <div class="col">
                                    <input id="Elo_blancas" type="text" class="form-control" name="Elo_blancas" placeholder="Elo jugador blancas" required autofocus>
                                </div>
                                <div class="col">
                                    <input id="Elo_negras" type="text" class="form-control" name="Elo_negras" placeholder="Elo jugador negras" required autofocus>
                                </div>
                            </div>
                            <br></br>
                            <div class="row">
                                <div class="col">
                                    <input id="torneo" type="text" class="form-control" name="torneo" placeholder="torneo" required autofocus>
                                </div>
                                <div class="col">
                                    <div>
                                        <select class="form-control" name="resultado" id="resultado">
                                            <option value="blancas">1 - 0</option>
                                            <option value="tablas">1/2 - 1/2</option>
                                            <option value="negras">0 - 1</option>
                                        </select>
                                    </div>                          
                                </div>
                            </div>
                            <br></br>

                            <div class="row">
                                <div class="col">
                                    <label>Movimientos:</label>
                                </div>
                                <div id="pgn" class="col">
                                    <input id="mov" name="mov" type="text" class="form-control" style="height: 40px; width:100%;" required readonly></input>
                                </div>
                            </div>

                            <div class="row">
                            <button id="submit" type="submit" class="btn btn-primary">
                                    Registrar partida
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        
            <div class="col">
                <div class="card">
                    <div class="card-header" >Tablero</div>
                </div>
                <div class="card-body">
                    <div id="myBoard"></div>
                    <button type="button" id="deshacer" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">Deshacer última jugada</button>

                    <button type="button" id="reiniciar" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">Reiniciar</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
