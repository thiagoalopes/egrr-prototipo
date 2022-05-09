@extends('layout.app')
@section('content')

<div class="container mb-5">

  <div class="row">
    <div class="col-12 mb-3">
      <a href="{{ route('listar.conteudos', ['idCurso'=>request()->get('idCurso')]) }}" class="mb-4"><i class="fas fa-chalkboard"></i> Voltar para conteúdos</a>
    </div>
</div>
<div class="row mb-3">
  <div class="col-12">
      <h2>Cadastro de Conteúdo</h2>
      <small>{{ $curso->nome }}</small>
  </div>
</div>

<div class="row">
    <div class="col-12">
    </div>
</div>
<div class="row justify-content-center">
  @if (Session::has('success'))
      <div class="col-12 col-md-4 text-center">
          <div class="alert alert-success">
              {{ Session::get('success') }}
          </div>
      </div>
    @elseif(Session::has('error'))
    <div class="col-12 col-md-4 text-center">
      <div class="alert alert-danger">
          {{ Session::get('error') }}
      </div>
  </div>
  @endif
</div>
<form class="row g-3" action="{{ route('salvar.conteudos') }}" method="POST">
    @csrf
    <input type="hidden" name="id_curso" value="{{ request()->get('idCurso') }}">
    <div class="col-md-3">
      <label for="sequencial_ordenacao" class="form-label">Sequencial de Ordenação<span class="text-danger">*</span> <i data-bs-toggle="tooltip" data-bs-placement="top" title="Utilizado para ordenar o conteúdo no certificado." class="fas fa-info"></i></label>
      <input type="number" placeholder="1-99" min="1" max="99" step="1" class="form-control @error("sequencial_ordenacao") is-invalid @enderror"  id="sequencial_ordenacao" name="sequencial_ordenacao">
      @error('sequencial_ordenacao')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12">
      <label for="conteudo" class="form-label">Descrição do Conteúdo<span class="text-danger">*</span></label>
      <textarea style="resize: none" required placeholder="Decreva o curso em até 500 caracteres" type="text" name="conteudo" maxlength="500" id="conteudo" rows="5" class="form-control @error("conteudo") is-invalid @enderror">{{ old('conteudo') }}</textarea>
      @error('conteudo')
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