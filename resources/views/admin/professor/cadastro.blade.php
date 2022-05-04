@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('listar.professores') }}" class="btn btn-secondary mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para Professores</a>
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
<form class="row g-3" action="{{ route('salvar.professores') }}" method="POST">
    @csrf
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("nome") is-invalid @enderror" name="nome"  id="nome">
      @error('nome')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" maxlength="11" class="form-control @error("cpf") is-invalid @enderror"  id="cpf" name="cpf">
      @error('ncpfome')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select name="sexo"class="form-select @error("sexo") is-invalid @enderror" id="sexo">
            <option value="">Selecione</option>
            <option value="f">Feminino</option>
            <option value="m">Masculino</option>
            <option value="o">Outro</option>
        </select>
        @error('sexo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="email" class="form-label">E-mail</label>
      <input type="text" maxlength="64" class="form-control @error("email") is-invalid @enderror" id="email" name="email">
      @error('email')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control @error("celular") is-invalid @enderror" id="celular" name="celular">
        @error('celular')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><i class="fas fa-database"></i> Cadastrar</button>
    </div>
  </form>
</div>

@endsection