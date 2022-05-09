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
      <h2>Detalhes do Conteúdo</h2>
      <small>{{ $curso->nome }}</small>
  </div>
</div>
<div class="row g-3">
    @csrf
    <input type="hidden" name="id_curso" value="{{ request()->get('idCurso') }}">
    <div class="col-md-3">
      <label for="sequencial_ordenacao" class="form-label">Sequencial de Ordenação</label>
      <input type="number" class="form-control" disabled value="{{ $conteudo->sequencial_ordenacao }}" id="sequencial_ordenacao">
    </div>
    <div class="col-12">
      <label for="conteudo" class="form-label">Descrição do Conteúdo</label>
      <textarea style="resize: none" disabled type="text" maxlength="500" id="conteudo" rows="5" class="form-control">{{ $conteudo->conteudo }}</textarea>
    </div>
  </div>
</div>

@endsection