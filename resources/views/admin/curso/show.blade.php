@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('listar.cursos') }}" class="btn btn-secondary mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para Cursos</a>
    </div>
</div>

<div class="row g-3">
  <div class="col-md-4">
    <label for="id_situacao_curso" class="form-label">Situação do Curso</label>
    <select class="form-select" disabled id="id_situacao_curso">
      <option value="">Selecione</option>
      @foreach ($situacoes as $item)
          <option {{ $item->id === $curso->id_situacao_curso?'selected':'' }} value="{{ $item->id }}">{{ $item->situacao }}</option>
      @endforeach
  </select>      
  </div>
    <div class="col-md-8">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" disabled value="{{ $curso->nome }}" class="form-control" id="nome">
    </div>
    <div class="col-12">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea disabled style="resize: none" maxlength="500" id="descricao" rows="5" class="form-control">{{ $curso->descricao }}</textarea>
    </div>

      <div class="col-md-3">
        <label for="total_vagas" class="form-label">Total de Vagas</label>
        <input type="text" disabled class="form-control" value="{{ $curso->total_vagas }}"  id="total_vagas">
      </div>
    <div class="col-md-9">
        <label for="id_professor" class="form-label">Professor</label>
        <select class="form-select" disabled id="id_professor">
            <option value="">Selecione</option>
            @foreach ($professores as $item)
                <option {{ $item->id === $curso->id_professor?'selected':'' }} value="{{ $item->id }}">{{ $item->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="carga_horaria" class="form-label">Carga Horária (h)</label>
        <input type="text" disabled class="form-control" value="{{ $curso->carga_horaria }}"  id="carga_horaria">
      </div>
    <div class="col-md-4">
        <label for="data_inicio" class="form-label">Data Início</label>
        <input type="text" class="form-control" disabled id="data_inicio" value="{{ \Carbon\Carbon::parse($curso->data_inicio)->format('d/m/Y') }}">
      </div>
      <div class="col-md-4">
        <label for="data_termino" class="form-label">Data Término</label>
        <input type="text" class="form-control" disabled id="data_termino" value="{{ \Carbon\Carbon::parse($curso->data_termino)->format('d/m/Y') }}">
      </div>
    <div class="col-12">
        <label for="endereco_curso" class="form-label">Endereço</label>
        <textarea style="resize: none" type="text" maxlength="500" id="endereco_curso" disabled rows="3" class="form-control">{{ $curso->endereco_curso }}</textarea>
      </div>
  </div>
</div>

@endsection