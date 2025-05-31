@extends('layouts.master')
@section('content')

<script src="{{ asset('js/jugar.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Juega y práctica vs nuestra IA!</div>
                <div class="card-body">
                    <div class="info">
                        Search depth:
                        <select id="search-depth">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3" selected>3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <p>Positions evaluated: <span id="position-count"></span></p>
                        <p>Time: <span id="time"></span></p>
                        <p>Positions/s: <span id="positions-per-s"></span> </p>
                        <div id="move-history" class="move-history">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card">
                <div class="card-header">Tablero</div>
                <div id="board" class="board"></div>
            </div>
        </div>
    </div>
</div>

@endsection