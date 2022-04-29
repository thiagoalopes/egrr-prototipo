@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-12">
        Servidor:  @if(Auth::user() != null) {{ Auth::user()->cpf }} - <a href="{{ route('logout') }}">Sair</a>  @else Não autenticado @endif 
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3">
        <a href="{{ route('certificados') }}">ver Certificados</a>        
    </div>
    <div class="col-12 col-md-3">
        <a href="">ver Cartoes</a>
    </div>
</div>

@endsection