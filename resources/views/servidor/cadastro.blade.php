@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('home.servidor') }}" class="btn btn-secondary mb-4"><i class="fas fa-undo-alt"></i> Voltar ao Painel</a>
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
<form class="row g-3" action="{{ route('update.servidor') }}" method="POST">
    @csrf
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" maxlength="128" class="form-control" disabled value="{{ $servidor->nome }}" id="nome">
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" maxlength="11" class="form-control" disabled id="cpf" value="{{ $servidor->cpf }}">
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo<span class="text-danger">*</span></label>
        <select name="sexo"class="form-select @error("sexo") is-invalid @enderror" id="sexo">
            <option value="">Selecione</option>
            <option {{ $servidor->sexo == 'f' || old('f') == 'f'?'selected':'' }} value="f">Feminino</option>
            <option {{ $servidor->sexo == 'm'|| old('m') == 'm'?'selected':'' }} value="m">Masculino</option>
            <option {{ $servidor->sexo == 'o'|| old('o') == 'o'?'selected':'' }} value="o">Outro</option>
        </select>
        @error('sexo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <div class="col-md-3 col-lg-2">
      <label for="matricula" class="form-label">Matrícula<span class="text-danger">*</span></label>
      <input type="text" maxlength="32" class="form-control @error("matricula") is-invalid @enderror" id="matricula" name="matricula" value="{{ $servidor->matricula }}" placeholder="1234 Main St">
      @error('matricula')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-3 col-lg-2">
        <label for="tipo_vinculo" class="form-label">Tipo de Vínculo<span class="text-danger">*</span></label>
        <select name="tipo_vinculo"class="form-select @error("tipo_vinculo") is-invalid @enderror" id="tipo_vinculo">
            <option value="">Selecione</option>
            <option {{ $servidor->tipo_vinculo === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
            <option {{ $servidor->tipo_vinculo === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
            <option {{ $servidor->tipo_vinculo === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
            <option {{ $servidor->tipo_vinculo === 'outro'?'selected':'' }} value="outro">Outro</option>
        </select>
        @error('tipo_vinculo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror      
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="cargo" class="form-label">Cargo<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("cargo") is-invalid @enderror" id="cargo" name="cargo" value="{{ $servidor->cargo }}">
      @error('cargo')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="secretaria" class="form-label">Secretaria<span class="text-danger">*</span></label>
      <select name="secretaria"class="form-select @error("secretaria") is-invalid @enderror" id="secretaria">
        <option value="">Selecione</option>
        @foreach ($secretarias as $item)
            <option {{ $item->id === $servidor->id_secretaria_servidores?'selected':'' }} value="{{ $item->id }}">{{ $item->secretaria }}</option>
        @endforeach
    </select>
      @error('secretaria')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
      <input type="text" maxlength="64" class="form-control @error("email") is-invalid @enderror" id="email" name="email" value="{{ $servidor->email }}">
      @error('email')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error("celular") is-invalid @enderror" id="celular" name="celular" value="{{ $servidor->celular }}">
        @error('celular')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control @error("telefone") is-invalid @enderror" id="telefone" name="telefone" value="{{ $servidor->telefone }}">
        @error('telefone')
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