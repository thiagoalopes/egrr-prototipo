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
      <h2>Cadastro de Turma</h2>
      <small>{{ $curso->nome }}</small>
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
    <div class="col-12 text-center">
      <div class="alert alert-danger">
          {{ Session::get('error') }}
      </div>
  </div>
  @endif
</div>
<form class="row g-3" action="{{ route('salvar.turmas') }}" method="POST">
    @csrf
    <input type="hidden" name="id_curso" value="{{ request()->get('idCurso') }}">
    <div class="col-md-9 col-lg-8">
      <label for="descricao_turma" class="form-label">Descrição da Turma<span class="text-danger">*</span></label>
      <input type="text" required placeholder="Turma A" value="{{ old('descricao_turma') }}" maxlength="128" class="form-control @error("descricao_turma") is-invalid @enderror" name="descricao_turma"  id="descricao_turma">
      @error('descricao_turma')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3 col-lg-4">
      <label for="total_vagas_turma" class="form-label">Total de Vagas<span class="text-danger">*</span> <i data-bs-toggle="tooltip" data-bs-placement="top" title="Atenção! a soma das vagas por turma não deve ultrapassar o limite do curso." class="fas fa-info"></i></label>
      <input type="number" required placeholder="1" min="1" max="9999" step="1" value="{{ old('total_vagas_turma') }}" class="form-control @error("total_vagas_turma") is-invalid @enderror" name="total_vagas_turma"  id="total_vagas_turma">
      @error('total_vagas_turma')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

      <div class="col-md-3">
        <label for="data_inicio" class="form-label">Data de Início<span class="text-danger">*</span></label>
        <input type="text"
        @if (strtotime(old('data_inicio')))
          value="{{ \Carbon\Carbon::parse(old('data_inicio'))->format('d/m/Y') }}"
        @else
          value="{{ old('data_inicio') }}"
        @endif
        required placeholder="00/00/0000" class="form-control date @error("data_inicio") is-invalid @enderror"  id="data_inicio" name="data_inicio">
        @error('data_inicio')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="col-md-3">
        <label for="data_termino" class="form-label">Data do Término<span class="text-danger">*</span></label>
        <input type="text"
        @if (strtotime(old('data_termino')))
          value="{{ \Carbon\Carbon::parse(old('data_termino'))->format('d/m/Y') }}"
        @else
          value="{{ old('data_termino') }}"
        @endif
        required placeholder="00/00/0000" class="form-control date @error("data_termino") is-invalid @enderror"  id="data_termino" name="data_termino">
        @error('data_termino')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="col-md-3">
        <label for="horario_inicio_aula" class="form-label">Início da Aula<span class="text-danger">*</span></label>
        <input type="text"
        @if (old('horario_inicio_aula') != null)
          @if (strtotime(old('horario_inicio_aula'))))
            value="{{ \Carbon\Carbon::parse(old('horario_inicio_aula'))->format('H:i') }}"
          @else
            value="{{ old('horario_inicio_aula') }}"
          @endif
        @endif
        required placeholder="00:00" class="form-control time @error("horario_inicio_aula") is-invalid @enderror" placeholder="08:00:00"  id="horario_inicio_aula" name="horario_inicio_aula">
        @error('horario_inicio_aula')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-3">
        <label for="horario_termino_aula" class="form-label">Término da Aula<span class="text-danger">*</span></label>
        <input type="text"
        @if (old('horario_termino_aula') != null)
          @if (strtotime(old('horario_termino_aula'))))
            value="{{ \Carbon\Carbon::parse(old('horario_termino_aula'))->format('H:i') }}"
          @else
            value="{{ old('horario_termino_aula') }}"
          @endif
        @endif
        required placeholder="00:00" class="form-control time @error("horario_termino_aula") is-invalid @enderror" placeholder="12:00:00"  id="horario_termino_aula" name="horario_termino_aula">
        @error('horario_termino_aula')
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