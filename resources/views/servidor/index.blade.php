@extends('layout.app')

@section('content')

<div class="row text-center">
    <div class="col-12">
      <h6>Bem vindo, @if(Auth::user() != null) {{ Auth::user()->dados->nome }}! @endif</h6>
    </div>
</div>

<div class="row mt-4">
  <div class="col-12 col-md-3 mt-2">
    <div class="card">
      <div class="card-header">
        Cadastro
      </div>
      <div class="card-body">
        <p class="card-text">Verifique as informações do seu cadastro e mantenha os dados sempre atualizados.</p>
        <a href="{{ route('cadastro.servidor') }}" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>
  
  <div class="col-12 col-md-3 mt-2">
    <div class="card">
      <div class="card-header">
        Certificados
      </div>
      <div class="card-body">
        <p class="card-text">Visualize e baixe os certificados dos cursos que você realizou na Escola de Governo.</p>
        <a href="{{ route('certificados') }}" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-3 mt-2">
    <div class="card">
      <div class="card-header">
        Cartão de Desconto
      </div>
      <div class="card-body">
        <p class="card-text">Solicite e emita o cartão de descontros do servidor e seus dependente.</p>
        <a href="#" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>

</div>

@endsection