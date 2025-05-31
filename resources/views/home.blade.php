@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<div class="container-fluid">
		<!-- Carousel -->
    	<div id="carousel_home" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  	<li data-target="#carousel_home" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel_home" data-slide-to="1"></li>
			    <li data-target="#carousel_home" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
                @for($i = 1; $i <= 3; $i ++)
                <div class="carousel-item @if($i == 1)active @endif">
                    <img class="img-fluid" src="images/chess{{$i}}.jpg" alt="Slide {{$i}}">
                    <!-- Static Header -->
                    <div class="carousel-caption">
                        <h2>
                            <span>Bienvenido a <strong>ChessCloud</strong></span>
                        </h2>
                        <br>
                        <h3>
                            <span>Sitio web diseñado y creado por Serverslayer</span>
                        </h3>
                        <br>
                        
                        @if(Auth::check())
                            <a class="btn btn-theme btn-sm btn-min-block" href="/home">Home</a>
                            <a class="btn btn-theme btn-sm btn-min-block" href="/salir">Salir</a>
                        @else
                            <a class="btn btn-theme btn-sm btn-min-block" href="/entrar">Entrar</a>
                            <a class="btn btn-theme btn-sm btn-min-block" href="/registrar">Registrarse</a>
                        @endif
                    </div>
                </div>
                @endfor
			    
			</div>
			<!-- Controls -->
			<a class="carousel-control-prev" href="#carousel_home" data-slide="prev">
		    	<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#carousel_home" data-slide="next">
		    	<span class="carousel-control-next-icon"></span>
			</a>
		</div><!-- /carousel -->
</div>
@endsection