@extends('layout.app')

@section('content')

<div class="container">

  <div class="row text-center">
    <div class="col-12">
      <h6>Bem vindo @if(Auth::user() != null) {{Auth::user()->dados?Auth::user()->dados->nome:'' }}! @endif</h6>
    </div>
</div>

<div class="row mt-4">
  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-chalkboard-teacher"></i> Gestão dos Professores
      </div>
      <div class="card-body">
        <p class="card-text">Gerencie o cadastro dos professores dos cursos no sistema.</p>
        <a href="{{ route('listar.professores') }}" class="btn btn-primary">Gerir</a>
      </div>
    </div>
  </div>
  
  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-exclamation"></i> Gestão da Situação dos Cursos
      </div>
      <div class="card-body">
        <p class="card-text">Gerencie as informações das situações dos cursos cadastrados no sistema.</p>
        <a href="#" class="btn btn-primary">Gerir</a>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-check-circle"></i> Gestão de Assinaturas
      </div>
      <div class="card-body">
        <p class="card-text">Gerencie as informações de assinaturas que irão aparecer nos certificados.</p>
        <a href="#" class="btn btn-primary">Gerir</a>
      </div>
    </div>
  </div>
  <i class="fas fa-lock-alt"></i>
  <div class="col-12 col-md-4 mt-2">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-graduation-cap"></i> Gestão de Cursos e Turmas
      </div>
      <div class="card-body">
        <p class="card-text">Gerencie as informações de cadastro dos cursos e suas turmas.</p>
        <a href="{{ route('listar.cursos') }}" class="btn btn-primary">Gerir</a>
      </div>
    </div>
  </div>
  @can('isMaster', Auth::user())
    <div class="col-12 col-md-4 mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-lock"></i> Gestão de Permissões
        </div>
        <div class="card-body">
          <p class="card-text">Atribua ou revogue as permissões dos administradores do sistema.</p>
          <a href="#" class="btn btn-primary">Gerir</a>
        </div>
      </div>
    </div>
  @endcan

</div>
</div>


@endsection