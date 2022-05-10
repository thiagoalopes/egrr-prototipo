@extends('layout.app')
@section('content')

<div class="container mb-5">

  <div class="row">
    <div class="col-12 mb-3">
      <a href="{{ route('listar.cursos') }}" class="mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para Cursos</a>
    </div>
</div>
<div class="row mb-3">
  <div class="col-12">
      <h2>Editar  Curso</h2>
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
<form class="row g-3" action="{{ route('atualizar.cursos') }}" method="POST" enctype="multipart/form-data">
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
    <div class="col-12">
      <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
      <input type="text" 
        @if (old('nome') != null)
            value="{{ old('nome') }}"
        @else
            value="{{ $curso->nome }}"
        @endif
        required placeholder="Carlos da Silva" maxlength="128" class="form-control @error("nome") is-invalid @enderror" name="nome"  id="nome">
      @error('nome')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12">
      <label for="descricao" class="form-label">Descrição<span class="text-danger">*</span></label>
      <textarea style="resize: none" placeholder="Decreva o curso em até 500 caracteres" required type="text" name="descricao" maxlength="500" id="descricao" rows="5" class="form-control @error("descricao") is-invalid @enderror">@if (old('descricao') != null){{ old('descricao') }}@else{{ $curso->descricao }}@endif</textarea>
      @error('descricao')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

      <div class="col-md-3">
        <label for="total_vagas" class="form-label">Total de Vagas<span class="text-danger">*</span></label>
        <input type="number" 
        @if (old('total_vagas') != null)
            value="{{ old('total_vagas') }}"
        @else
            value="{{ $curso->total_vagas }}"
        @endif
        placeholder="0" min="1" max="9999" class="form-control @error("total_vagas") is-invalid @enderror"  id="total_vagas" name="total_vagas">
        @error('total_vagas')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-md-9">
        <label for="id_professor" class="form-label">Professor<span class="text-danger">*</span></label>
        <select name="id_professor" required class="form-select @error("id_professor") is-invalid @enderror" id="id_professor">
            <option value="">Selecione</option>
            @foreach ($professores as $item)
                <option 
                @if(old('id_professor') != null 
                                && old('id_professor') == $item->id )
                    selected
                @elseif($item->id == $curso->id_professor)
                    selected
                @endif
                value="{{ $item->id }}">{{ $item->nome }}</option>
            @endforeach
        </select>
        @error('id_professor')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="carga_horaria" class="form-label">Carga Horária (h)<span class="text-danger">*</span></label>
        <input type="number" 
        @if (old('carga_horaria') != null)
            value="{{ old('carga_horaria') }}"
        @else
            value="{{ $curso->carga_horaria }}"
        @endif
        required placeholder="0" min="1" max="9999" class="form-control @error("carga_horaria") is-invalid @enderror"  id="carga_horaria" name="carga_horaria">
        @error('carga_horaria')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-md-4">
        <label for="data_inicio" class="form-label">Data Início<span class="text-danger">*</span></label>
        <input type="text" 
        @if (old('data_inicio') != null)
          @if (strtotime(old('data_inicio')))
            value="{{ \Carbon\Carbon::parse(old('data_inicio'))->format('d/m/Y') }}"
          @else
            value="{{ old('data_inicio') }}"
          @endif
        @else
          value="{{ \Carbon\Carbon::parse($curso->data_inicio)->format('d/m/Y') }}"
        @endif
        required placeholder="00/00/0000" class="form-control date @error("data_inicio") is-invalid @enderror"  id="data_inicio" name="data_inicio">
        @error('data_inicio')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="data_termino" class="form-label">Data Término<span class="text-danger">*</span></label>
        <input type="text" 
        @if (old('data_termino') != null)
          @if (strtotime(old('data_termino')))
            value="{{ \Carbon\Carbon::parse(old('data_termino'))->format('d/m/Y') }}"
          @else
            value="{{ old('data_termino') }}"
          @endif
        @else
          value="{{ \Carbon\Carbon::parse($curso->data_termino)->format('d/m/Y') }}"
        @endif
        required placeholder="00/00/0000" class="form-control date @error("data_termino") is-invalid @enderror"  id="data_termino" name="data_termino">
        @error('data_termino')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12">
        <label for="endereco_curso" class="form-label">Endereço<span class="text-danger">*</span></label>
        <textarea style="resize: none" placeholder="Descreva o local onde irá ocorrer o curso em até 500 caracteres" required type="text" name="endereco_curso" maxlength="500" id="endereco_curso" rows="3" class="form-control @error("endereco_curso") is-invalid @enderror">@if (old('endereco_curso') != null){{ old('endereco_curso') }}@else{{ $curso->endereco_curso }}@endif</textarea>
        @error('endereco_curso')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Atualizar</button>
    </div>
    <div class="col-12">
      <span><span class="text-danger">*</span>Campos obrigatórios</span>
    </div>
  </form>
</div>

@endsection