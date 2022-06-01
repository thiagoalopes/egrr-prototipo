@extends('layout.app')
@section('content')

<div class="container mb-5">

  <div class="row">
    <div class="col-12 mb-3">
      <a href="{{ route('listar.assinaturas') }}" class="mb-4"><i class="fas fa-pen-fancy"></i> Voltar para Assinaturas</a>
    </div>
</div>
<div class="row mb-3">
  <div class="col-12">
      <h2>Cadastro de Assinaturas</h2>
  </div>
</div>

<div class="row justify-content-center">
  @if (Session::has('success'))
      <div class="col-12 col-md-4 text-center">
          <div class="alert alert-success">
              {{ Session::get('success') }}
          </div>
      </div>
  @endif
</div>
<form class="row g-3" action="{{ route('salvar.assinaturas') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-12 col-md-6">
        <label for="nome_secretario" class="form-label">Nome do Secretário<span class="text-danger">*</span></label>
        <input type="text" required placeholder="Carlos da Silva" maxlength="128" value="{{ old('nome_secretario') }}" class="form-control @error("nome_secretario") is-invalid @enderror" name="nome_secretario"  id="nome_secretario">
        @error('nome_secretario')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12 col-md-6">
      <label for="imagem_assinatura_secretario" class="form-label">Assinatura do Secretário<span class="text-danger">*</span></label>
      <input type="file" class="form-control @error('imagem_assinatura_secretario') is-invalid @enderror" name="imagem_assinatura_secretario"  id="imagem_assinatura_secretario">
      @error('imagem_assinatura_secretario')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="nome_diretor_egrr" class="form-label">Nome do Diretor<span class="text-danger">*</span></label>
        <input type="text" required placeholder="Carlos da Silva" maxlength="128" value="{{ old('nome_diretor_egrr') }}" class="form-control @error("nome_diretor_egrr") is-invalid @enderror" name="nome_diretor_egrr"  id="nome_diretor_egrr">
        @error('nome_diretor_egrr')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12 col-md-6">
      <label for="imagem_assinatura_diretor" class="form-label">Assinatura do Diretor<span class="text-danger">*</span></label>
      <input type="file" class="form-control @error('imagem_assinatura_diretor') is-invalid @enderror" name="imagem_assinatura_diretor"  id="imagem_assinatura_diretor">
      @error('imagem_assinatura_diretor')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><i class="fas fa-database"></i> Cadastrar</button>
    </div>
    <div class="col-12">
      <span><span class="text-danger">*</span>Campos obrigatórios</span>
    </div>
  </form>
</div>

@endsection