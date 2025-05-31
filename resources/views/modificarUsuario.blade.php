@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<div class="container" style="padding-top: 60px;">
  <div class="form-group">
    <div class="row">
      <!-- left column -->
      <!--el avatar no está, mirarlo en uatube para incorporarlo-->
      <!-- edit form column -->
      <div class="col-md-10 col-sm-6 col-md-offset-2 col-xs-12 personal-info">
      <div class="card">
      <h1 style="background-color: #007bff; border-color: #007bff; color: white;" class="card-header">Editar Perfil</h1>
      <div class="card-body"> 
        @if (count($errors) > 0)              
          <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a> 
            <i class="fa fa-coffee"></i>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </div>
        @endif
          <form class="form-horizontal" role="form" action="{{ action('UserController@update') }}" method="POST">
          {{ csrf_field() }}
            <div class="form-group">
              <label class="col-lg-3 control-label">Nombre:</label>
              <div class="col-lg-8">
                <input class="form-control" name="name" value={{Auth::user()->name}} type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input class="form-control" name="email" value={{Auth::user()->email}} type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Contraseña:</label>
              <div class="col-md-8">
                <input class="form-control" name="password" placeholder="new password" type="password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Confirmar contraseña:</label>
              <div class="col-md-8">
                <input class="form-control" name="passwordConfirm" placeholder="repeat password" type="password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <input class="btn btn-primary" value="Guardar cambios" type="submit">
                <span></span>
                <input class="btn btn-default" value="Cancelar" type="reset">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection