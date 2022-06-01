@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12 mb-4">
        <a href="{{ route('listar.cadastros') }}"><i class="fas fa-undo-alt"></i> Voltar aos Cadastros</a>
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
</div>
@if(!$servidor->servidor_confirmado)
<div class="row mt-3">
  <div class="col-12">
    <form action="{{ route('confirmar.cadastros',['idServidor'=>$servidor->id]) }}" method="POST">
      @csrf
      <button class="btn btn-outline-success" ><i class="fas fa-check-double" ></i> Validar Cadastro</button>
    </form>

  </div>
</div>
@endif
  <div class="row mt-3 g-3">
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" maxlength="128" class="form-control" disabled value="{{ $servidor->nome }}" id="nome">
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" maxlength="11" class="form-control cpf" disabled id="cpf" value="{{ $servidor->cpf }}">
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select class="form-select" disabled id="sexo">
            <option value="">Selecione</option>
            <option {{ $servidor->sexo == 'f' || old('f') == 'f'?'selected':'' }} value="f">Feminino</option>
            <option {{ $servidor->sexo == 'm'|| old('m') == 'm'?'selected':'' }} value="m">Masculino</option>
            <option {{ $servidor->sexo == 'o'|| old('o') == 'o'?'selected':'' }} value="o">Outro</option>
            <option {{ $servidor->sexo == 'n'|| old('n') == 'n'?'selected':'' }} value="n">Não Informar</option>
        </select>
    </div>
    <div class="col-md-3 col-lg-2">
      <label for="matricula" class="form-label">Matrícula</label>
      <input type="text" maxlength="32" disabled class="form-control" id="matricula" value="{{ $servidor->matricula }}">
    </div>
    <div class="col-md-3 col-lg-2">
        <label for="tipo_vinculo" class="form-label">Tipo de Vínculo</label>
        <select class="form-select" disabled id="tipo_vinculo">
            <option value="">Selecione</option>
            <option {{ $servidor->tipo_vinculo === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
            <option {{ $servidor->tipo_vinculo === 'efetcomis'?'selected':'' }} value="efetcomis">Efetivo/Comissionado</option>
            <option {{ $servidor->tipo_vinculo === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
            <option {{ $servidor->tipo_vinculo === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
            <option {{ $servidor->tipo_vinculo === 'federal'?'selected':'' }} value="federal">Federal</option>
        </select>
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="cargo" class="form-label">Cargo</label>
      <input type="text" maxlength="128" class="form-control" disabled id="cargo" value="{{ $servidor->cargo }}">
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="funcao" class="form-label">Função</label>
      <input type="text" maxlength="128" disabled value="{{ $servidor->funcao }}" class="form-control" id="funcao">
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="secretaria" class="form-label">Secretaria</label>
      <select disabled class="form-select" id="secretaria">
        <option value="">Selecione</option>
        @foreach ($secretarias as $item)
            <option {{ $item->id === $servidor->id_secretaria_servidores?'selected':'' }} value="{{ $item->id }}">{{ $item->secretaria }}</option>
        @endforeach
    </select>
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="email" class="form-label">E-mail</label>
      <input type="text" maxlength="64" class="form-control" id="email" disabled value="{{ $servidor->email }}">
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control cell_with_ddd" id="celular" disabled value="{{ $servidor->celular }}">
      </div>
      <div class="col-md-4">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control phone_with_ddd" id="telefone" disabled value="{{ $servidor->telefone }}">
      </div>
</div>

@endsection