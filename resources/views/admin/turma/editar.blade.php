@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('listar.turmas') }}" class="btn btn-secondary mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para Cursos</a>
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
<form class="row g-3" action="{{ route('atualizar.turmas') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="idCurso" value="{{ $curso->id }}">
    <div class="col-12">
      <label for="imagem" class="form-label">Foto</label>
      <input type="file" class="form-control @error("nome") is-invalid @enderror" name="imagem"  id="imagem">
      @error('imagem')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="id_situacao_curso" class="form-label">Situação do Curso<span class="text-danger">*</span></label>
      <select name="id_situacao_curso"class="form-select @error("id_situacao_curso") is-invalid @enderror" id="id_situacao_curso">
        <option value="">Selecione</option>
        @foreach ($situacoes as $item)
            <option {{ $item->id === $curso->id_situacao_curso?'selected':'' }} value="{{ $item->id }}">{{ $item->situacao }}</option>
        @endforeach
    </select>      
    @error('id_situacao_curso')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-8">
      <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("nome") is-invalid @enderror" value="{{ $curso->nome }}" name="nome"  id="nome">
      @error('nome')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12">
      <label for="descricao" class="form-label">Descrição<span class="text-danger">*</span></label>
      <textarea style="resize: none" type="text" name="descricao" maxlength="500" id="descricao" rows="5" class="form-control @error("descricao") is-invalid @enderror">{{ $curso->descricao }}</textarea>
      @error('descricao')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

      <div class="col-md-3">
        <label for="total_vagas" class="form-label">Total de Vagas</label>
        <input type="text" maxlength="4" value="{{ $curso->total_vagas }}" class="form-control @error("total_vagas") is-invalid @enderror"  id="total_vagas" name="total_vagas">
        @error('total_vagas')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-md-9">
        <label for="id_professor" class="form-label">Professor</label>
        <select name="id_professor"class="form-select @error("id_professor") is-invalid @enderror" id="id_professor">
            <option value="">Selecione</option>
            @foreach ($professores as $item)
                <option {{ $curso->id_professor === $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->nome }}</option>
            @endforeach
        </select>
        @error('id_professor')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="carga_horaria" class="form-label">Carga Horária (h)</label>
        <input type="text" maxlength="4" value="{{ $curso->carga_horaria }}" class="form-control @error("carga_horaria") is-invalid @enderror"  id="carga_horaria" name="carga_horaria">
        @error('carga_horaria')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-md-4">
        <label for="data_inicio" class="form-label">Data Início</label>
        <input type="text" value="{{ \Carbon\Carbon::parse($curso->data_inicio)->format('d/m/Y') }}" class="form-control @error("data_inicio") is-invalid @enderror"  id="data_inicio" name="data_inicio">
        @error('data_inicio')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="data_termino" class="form-label">Data Término</label>
        <input type="text" value="{{ \Carbon\Carbon::parse($curso->data_termino)->format('d/m/Y') }}" class="form-control @error("data_termino") is-invalid @enderror"  id="data_termino" name="data_termino">
        @error('data_termino')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12">
        <label for="endereco_curso" class="form-label">Endereço</label>
        <textarea style="resize: none" type="text" name="endereco_curso" maxlength="500" id="endereco_curso" rows="3" class="form-control @error("endereco_curso") is-invalid @enderror">{{ $curso->endereco_curso }}</textarea>
        @error('endereco_curso')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Atualizar</button>
    </div>
  </form>
</div>

@endsection