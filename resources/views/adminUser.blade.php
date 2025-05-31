@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/adminUser.js') }}"></script>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Password</th>
            <th>Rol</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <style>
                input
                {
                    background-color: transparent;
                    border: 0px;
                    
                }
            </style>
            <tr>
                    <td><input value="{{$usuario->id}}" style="width: 25px;" readonly></input></td>                                
                    <td><input value="{{$usuario->email}}" name="email{{$usuario->id}}" style="width: 100%;"></td>
                    <td><input value="{{$usuario->name}}" name="name{{$usuario->id}}" style="width: 100%;"></td>
                    <td><input value="{{$usuario->password}}" name="password{{$usuario->id}}" readonly style="width: 100%;"></td>
                    <td>
                        <select class="form-control" name="rol{{$usuario->id}}">
                            <option value="0" @if ($usuario->rol_id == 0) selected @endif>Usuario</option>
                            <option value="1" @if ($usuario->rol_id == 1) selected @endif>Editor</option>
                            <option value="2" @if ($usuario->rol_id == 0) selected @endif>Administrador</option>
                        </select>
                    </td>
                    <td><a onclick="edit(this)" id="edit" name="edit" value="{{$usuario->id}}" class="btn btn-link"> &#x270e; </a></td>
                    <td><a onclick="borrar(this)" id="delete" name="delete" value="{{$usuario->id}}" class="btn btn-danger"> x </a></td>

            </tr>
        @endforeach

        <tr>        
                    <td></td>
                    <td><input placeholder="Nombre" name="email" id="correo_electronico" required></td>
                    <td><input placeholder="Apellido" name="name" required></td>    
                    <td><input placeholder="Contraseña" name="password" required></td>
                    <td>
                        <select class="form-control" name="rol_add">
                            <option value="0">Usuario</option>
                            <option value="1">Editor</option>
                            <option value="2">Administrador</option>
                        </select>
                    </td>                        
                    <td><button onclick="insert(this)" id="add" class="btn btn-success"> + </button></td>
        </tr>
    </tbody>
</table>

<form id="form" class="form-horizontal invisible" role="form" action="{{ action('UserController@execAdmin') }}" method="POST">

        <input id="id" name="id" type="text"></input>
        <input id="email" name="email" type="text"></input>
        <input id="name" name="name" type="text"></input>
        <input id="pass" name="pass" type="text"></input>
        <input id="rol" name="rol" type="text"></input>
        <input id="type"  name="type"></input>
        {{ csrf_field() }}
</form>

{{ $usuarios->links() }}
@endsection