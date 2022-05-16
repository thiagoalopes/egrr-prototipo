@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('home.servidor') }}"><i class="fas fa-undo-alt"></i> Voltar ao Painel</a>
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
<form class="row g-3" action="{{ route('salvar.servidor') }}" method="POST">
    @csrf
    <div class="col-12">
      <h5>Informações Pessoais</h5>
    </div>
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("nome") is-invalid @enderror" value="{{ old('nome') }}" name="nome" id="nome">
      @error('nome')
      <span style="display: block;" class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF<span class="text-danger">*</span></label>
      <input type="text" maxlength="11" class="form-control cpf @error("cpf") is-invalid @enderror" value="{{ old('cpf') }}" name="cpf" id="cpf">
      @error('cpf')
      <span style="display: block;" class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo<span class="text-danger">*</span></label>
        <select name="sexo"class="form-select @error("sexo") is-invalid @enderror" id="sexo">
            <option value="">Selecione</option>
            <option {{ old('sexo') === 'f'?'selected':'' }} value="f">Feminino</option>
            <option {{ old('sexo') === 'm'?'selected':'' }} value="m">Masculino</option>
            <option {{ old('sexo') === 'o'?'selected':'' }} value="o">Outro</option>
            <option {{ old('sexo') === 'n'?'selected':'' }} value="n">Não Informar</option>
        </select>
        @error('sexo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <div class="col-md-3 col-lg-2">
      <label for="matricula" class="form-label">Matrícula<span class="text-danger">*</span></label>
      <input type="text" maxlength="32" class="form-control @error("matricula") is-invalid @enderror" value="{{ old('matricula') }}" id="matricula" name="matricula">
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
            <option {{ old('tipo_vinculo') === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
            <option {{ old('tipo_vinculo') === 'efetcomis'?'selected':'' }} value="efetcomis">Efetivo/Comissionado</option>
            <option {{ old('tipo_vinculo') === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
            <option {{ old('tipo_vinculo') === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
            <option {{ old('tipo_vinculo') === 'outro'?'selected':'' }} value="outro">Outro</option>
        </select>
        @error('tipo_vinculo')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror      
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="cargo" class="form-label">Cargo<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("cargo") is-invalid @enderror" id="cargo" value="{{ old('cargo') }}" name="cargo">
      @error('cargo')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="funcao" class="form-label">Função<span class="text-danger">*</span></label>
      <input type="text" maxlength="128" class="form-control @error("funcao") is-invalid @enderror" id="funcao" value="{{ old('funcao') }}" name="funcao">
      @error('funcao')
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
            <option {{ $item->id == old('secretaria')?'selected':'' }} value="{{ $item->id }}">{{ $item->secretaria }}</option>
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
      <input type="text" maxlength="64" class="form-control @error("email") is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
      @error('email')
        <span style="display: block;" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular<span class="text-danger">*</span></label>
        <input type="text" class="form-control cell_with_ddd @error("celular") is-invalid @enderror" value="{{ old('celular') }}" id="celular" name="celular">
        @error('celular')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control phone_with_ddd @error("telefone") is-invalid @enderror" value="{{ old('telefone') }}" id="telefone" name="telefone">
        @error('telefone')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-12">
        <h5>Senha de Acesso</h5>
      </div>
      <div class="col-md-3">
        <label for="senha" class="form-label">Senha<span class="text-danger">*</span></label>
        <input type="password" class="form-control @error("senha") is-invalid @enderror" id="senha" name="senha">
        @error('senha')
          <span style="display: block;" class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="col-md-3">
        <label for="senha_confirmation" class="form-label">Confirmação da Senha<span class="text-danger">*</span></label>
        <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation">
      </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><i class="fas fa-database"></i> Cadastrar</button>
    </div>
    <div class="col-12 mb-0">
      <span><span class="text-danger">*</span>Campos obrigatórios</span>
    </div>
  </form>
</div>

@endsection