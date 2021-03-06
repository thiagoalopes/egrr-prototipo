@extends('layout.app')

@section('content')

<div class="container mb-4">

  <div class="row text-center">
    <div class="col-12">
      <h6>Bem vindo @if(Auth::user() != null) {{Auth::user()->nome }}! @endif</h6>
      <small><a href="{{ route('alterar.senha.form') }}">Alterar Senha</a></small>

    </div>
</div>

<div class="row justify-content-center">
  @if (Session::has('success'))
      <div class="col-12 text-center">
          <div class="alert alert-success">
              {{ Session::get('success') }}
          </div>
      </div>
    @elseif(Session::has('error'))
    <div class="col-12 text-center">
      <div class="alert alert-danger">
          {{ Session::get('error') }}
      </div>
  </div>
  @endif
</div>

<div class="row mt-4">
  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-clipboard-list"></i> Dados Cadastrais
      </div>
      <div class="card-body">
        <p class="card-text">Verifique as informações do seu cadastro e mantenha os dados sempre atualizados.</p>
        <a href="{{ route('show.servidor') }}" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-certificate"></i> Inscrições e Certificados
      </div>
      <div class="card-body">
        <p class="card-text">As informações dos cursos em que você se inscreveu estão aqui.</p>
        <a href="{{ route('inscricao.servidor') }}" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-tags"></i> Cartão de Desconto
      </div>
      <div class="card-body">
        <p class="card-text">Solicite e emita o cartão de descontros do servidor e seus dependente.</p>
        <a href="#" class="btn btn-primary">Visualizar</a>
      </div>
    </div>
  </div>

</div>


</div>


@endsection