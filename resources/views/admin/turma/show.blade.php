@extends('layout.app')
@section('content')

<div class="container mb-5">

  <div class="row">
    <div class="col-12 mb-3">
      <a href="{{ route('listar.turmas', ['idCurso'=>request()->get('idCurso')]) }}" class="mb-4"><i class="fas fa-chalkboard"></i> Voltar para turmas</a>
    </div>
</div>
<div class="row mb-3">
  <div class="col-12">
      <h2>Detalhes da Turma</h2>
      <small>{{ $curso->nome }}</small>
  </div>
</div>
<div class="row g-3">
    <div class="col-md-3 col-lg-2">
      <label for="id_situacao_turma" class="form-label">Situação da Turma</label>
      <select disabled class="form-select" id="id_situacao_turma">
          <option value="">Selecione</option>
          @foreach ($situacoesTurmas as $item)
              <option {{ $turma->id_situacao_turma == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->situacao }}</option>
          @endforeach
      </select>
  </div>
    <div class="col-md-6 col-lg-8">
      <label for="descricao_turma" class="form-label">Descrição da Turma</label>
      <input type="text" disabled value="{{ $turma->descricao_turma }}" class="form-control" id="descricao_turma">
    </div>
    <div class="col-md-3 col-lg-2">
      <label for="total_vagas_turma" class="form-label">Total de Vagas</label>
      <input type="number" disabled value="{{ $turma->total_vagas_turma }}" class="form-control" id="total_vagas_turma">
    </div>

      <div class="col-md-3">
        <label for="data_inicio" class="form-label">Data de Início</label>
        <input type="text"
        @if (strtotime($turma->data_inicio))
          value="{{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}"
        @else
          value="{{ $turma->data_inicio }}"
        @endif
         class="form-control date" disabled id="data_inicio">
      </div>

      <div class="col-md-3">
        <label for="data_termino" class="form-label">Data do Término</label>
        <input type="text"
        @if (strtotime($turma->data_termino))
          value="{{ \Carbon\Carbon::parse($turma->data_termino)->format('d/m/Y') }}"
        @else
          value="{{ $turma->data_termino }}"
        @endif
         class="form-control date"  id="data_termino" disabled>
      </div>

      <div class="col-md-3">
        <label for="horario_inicio_aula" class="form-label">Início da Aula</label>
        <input type="text" disabled class="form-control time" id="horario_inicio_aula" value="{{ $turma->horario_inicio_aula }}">
      </div>
      <div class="col-md-3">
        <label for="horario_termino_aula" class="form-label">Início da Aula</label>
        <input type="text" disabled class="form-control time" id="horario_termino_aula" value="{{ $turma->horario_termino_aula }}">
      </div>

  </div>
</div>

@endsection