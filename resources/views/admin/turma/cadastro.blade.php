@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('listar.turmas', ['idCurso'=>request()->get('idCurso')]) }}" class="btn btn-secondary mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para turmas</a>
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
<form class="row g-3" action="{{ route('salvar.turmas') }}" method="POST">
    @csrf
    <input type="hidden" name="id_curso" value="{{ request()->get('idCurso') }}">
    <div class="col-md-3 col-lg-2">
      <label for="id_situacao_turma" class="form-label">Situação da Turma<span class="text-danger">*</span></label>
      <select name="id_situacao_turma"class="form-select @error("id_situacao_turma") is-invalid @enderror" id="id_situacao_turma">
          <option value="">Selecione</option>
          @foreach ($situacoesTurmas as $item)
              <option value="{{ $item->id }}">{{ $item->situacao }}</option>
          @endforeach
      </select>
      @error('id_situacao_turma')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
  </div>
    <div class="col-md-6 col-lg-8">
      <label for="descricao_turma" class="form-label">Descrição da Turma<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("descricao_turma") is-invalid @enderror" name="descricao_turma"  id="descricao_turma">
      @error('descricao_turma')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3 col-lg-2">
      <label for="total_vagas_turma" class="form-label">Total de Vagas<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("total_vagas_turma") is-invalid @enderror" name="total_vagas_turma"  id="total_vagas_turma">
      @error('total_vagas_turma')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

      <div class="col-md-3">
        <label for="data_inicio" class="form-label">Data de Início</label>
        <input type="text" maxlength="4" class="form-control date @error("data_inicio") is-invalid @enderror"  id="data_inicio" name="data_inicio">
        @error('data_inicio')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="col-md-3">
        <label for="data_termino" class="form-label">Data do Término</label>
        <input type="text" maxlength="4" class="form-control date @error("data_termino") is-invalid @enderror"  id="data_termino" name="data_termino">
        @error('data_termino')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="col-md-3">
        <label for="horario_inicio_aula" class="form-label">Início da Aula</label>
        <input type="text" maxlength="4" class="form-control time @error("horario_inicio_aula") is-invalid @enderror" placeholder="08:00:00"  id="horario_inicio_aula" name="horario_inicio_aula">
        @error('horario_inicio_aula')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-3">
        <label for="horario_termino_aula" class="form-label">Início da Aula</label>
        <input type="text" maxlength="4" class="form-control time @error("horario_termino_aula") is-invalid @enderror" placeholder="12:00:00"  id="horario_termino_aula" name="horario_termino_aula">
        @error('horario_termino_aula')
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