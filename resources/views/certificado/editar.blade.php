@extends('layout.app')
@section('content')

<div class="container mb-5">
  {{ $errors }}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('certificados',['idCurso'=>$certificado->id_curso]) }}"><i class="fas fa-certificate" aria-hidden="true"></i> Voltar para certificados</a>
        </div>
    </div>
<div class="row justify-content-center">
  @if (Session::has('success'))
      <div class="col-12 text-center">
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
<form class="row g-3" action="{{ route('update.certificados',['idInscricao'=>$certificado->id_inscricao]) }}" method="POST">
    @csrf
    <div class="col-md-12">
      <label for="nome_servidor" class="form-label">Nome</label>
      <input type="text" maxlength="128" class="form-control @error("nome_servidor") is-invalid @enderror" name="nome_servidor" value="{{ $certificado->nome_servidor }}" id="nome_servidor">
      @error('nome_servidor')
      <span style="display: block;" class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
    </div>
    <div class="col-md-4">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" maxlength="128" class="form-control cpf @error("cpf") is-invalid @enderror" name="cpf" value="{{ $certificado->cpf }}" id="cpf">
        @error('cpf')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
      </div>
      <div class="col-md-4">
        <label for="matricula" class="form-label">Matrícula</label>
        <input type="text" maxlength="128" class="form-control @error("matricula") is-invalid @enderror" name="matricula" value="{{ $certificado->matricula }}" id="matricula">
        @error('matricula')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
      </div>
    <div class="col-md-4">
        <label for="tipo_vinculo" class="form-label">Tipo de Vínculo<span class="text-danger">*</span></label>
        <select name="tipo_vinculo"class="form-select @error("tipo_vinculo") is-invalid @enderror" id="tipo_vinculo">
            <option value="">Selecione</option>
            <option {{ $certificado->tipo_vinculo === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
            <option {{ $certificado->tipo_vinculo === 'efetcomis'?'selected':'' }} value="efetcomis">Efetivo/Comissionado</option>
            <option {{ $certificado->tipo_vinculo === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
            <option {{ $certificado->tipo_vinculo === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
            <option {{ $certificado->tipo_vinculo === 'outro'?'selected':'' }} value="outro">Outro</option>
        </select>
        @error('tipo_vinculo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror      
    </div>
    <div class="col-md-3">
      <label for="carga_horaria" class="form-label">Carga Horária (h)<span class="text-danger">*</span></label>
      <input type="number" 
      @if (old('carga_horaria') != null)
          value="{{ old('carga_horaria') }}"
      @else
          value="{{ $certificado->carga_horaria }}"
      @endif
      required placeholder="0" min="1" max="9999" class="form-control @error("carga_horaria") is-invalid @enderror"  id="carga_horaria" name="carga_horaria">
      @error('carga_horaria')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  <div class="col-md-3">
      <label for="data_inicio" class="form-label">Data Início<span class="text-danger">*</span></label>
      <input type="text" 
      @if (old('data_inicio') != null)
        @if (strtotime(old('data_inicio')))
          value="{{ \Carbon\Carbon::parse(old('data_inicio'))->format('d/m/Y') }}"
        @else
          value="{{ old('data_inicio') }}"
        @endif
      @else
        value="{{ \Carbon\Carbon::parse($certificado->data_inicio)->format('d/m/Y') }}"
      @endif
      required placeholder="00/00/0000" class="form-control date @error("data_inicio") is-invalid @enderror"  id="data_inicio" name="data_inicio">
      @error('data_inicio')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3">
      <label for="data_termino" class="form-label">Data Término<span class="text-danger">*</span></label>
      <input type="text" 
      @if (old('data_termino') != null)
        @if (strtotime(old('data_termino')))
          value="{{ \Carbon\Carbon::parse(old('data_termino'))->format('d/m/Y') }}"
        @else
          value="{{ old('data_termino') }}"
        @endif
      @else
        value="{{ \Carbon\Carbon::parse($certificado->data_termino)->format('d/m/Y') }}"
      @endif
      required placeholder="00/00/0000" class="form-control date @error("data_termino") is-invalid @enderror"  id="data_termino" name="data_termino">
      @error('data_termino')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3">
      <label for="aproveitamento" class="form-label">Aproveitamento (%)<span class="text-danger">*</span></label>
      <input type="number" 
      @if (old('aproveitamento') != null)
          value="{{ old('aproveitamento') }}"
      @else
          value="{{ $certificado->aproveitamento }}"
      @endif
      required placeholder="0" min="1" max="9999" class="form-control @error("aproveitamento") is-invalid @enderror"  id="aproveitamento" name="aproveitamento">
      @error('aproveitamento')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-12">
      <label for="id_assinatura_gestor" class="form-label">Assinatura<span class="text-danger">*</span></label>
      <select name="id_assinatura_gestor" required class="form-select @error("id_assinatura_gestor") is-invalid @enderror" id="id_assinatura_gestor">
          <option value="">Selecione</option>
          @foreach ($assinaturas as $item)
              <option 
              @if(old('id_assinatura_gestor') != null 
                              && old('id_assinatura_gestor') == $item->id )
                  selected
              @elseif($item->id == $certificado->id_assinatura_gestor)
                selected
              @endif
              value="{{ $item->id }}">(Secretário/Diretor)-{{ $item->nome_secretario }}/{{ $item->nome_diretor_egrr }}</option>
          @endforeach
      </select>
      @error('id_assinatura_gestor')
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