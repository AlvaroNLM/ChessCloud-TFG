@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<script src="{{ asset('js/admin.js') }}"></script>
@if (count($errors) > 0)              
<div class="alert alert-info alert-dismissable">
    <a class="panel-close close" data-dismiss="alert">×</a> 
    <i class="fa fa-coffee"></i>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
@endif
<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu">
    <!-- Main Menu -->
        <div class="side-menu-container">
            <ul class="nav navbar-nav">
                <!--<li><a onclick="cambiarPagina()"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>-->
                <li><a class="activo" algo="1" onclick="cambiarPagina(this)" href="/admin/usuarios" ruta="{{action('UserController@adminUser')}}"><span class="glyphicon glyphicon-user"></span>Usuarios</a></li>   
                <li><a class="activo" algo="2" onclick="cambiarPagina(this)" href="/admin/partidas" ruta="{{action('GameController@adminGame')}}"><span class="glyphicon glyphicon-user"></span>Partidas</a></li>         

            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
            <div id="pagina"></div>
        </div>
    </div>
</div>
@endsection