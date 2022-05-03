@extends('layout.app')
@section('content')

<div class="container">
  {{ $errors }}
<div class="row">
    <div class="col-12">
        <a href="{{ route('home.servidor') }}" class="btn btn-secondary mb-4">Voltar ao Painel</a>
    </div>
</div>
<form class="row g-3" action="{{ route('update.servidor') }}" method="POST">
    @csrf
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ $servidor->nome }}" id="nome">
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" class="form-control" id="cpf" value="{{ $servidor->cpf }}" name="cpf">
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select name="sexo"class="form-select" id="sexo">
            <option value="">Selecione</option>
            <option {{ $servidor->sexo === 'f'?'selected':'' }} value="f">Feminino</option>
            <option {{ $servidor->sexo === 'm'?'selected':'' }} value="m">Masculino</option>
            <option {{ $servidor->sexo === 'o'?'selected':'' }} value="o">Outro</option>
        </select>
    </div>
    <div class="col-md-2">
      <label for="matricula" class="form-label">Matrícula</label>
      <input type="text" class="form-control" id="matricula" name="matricula" value="{{ $servidor->matricula }}" placeholder="1234 Main St">
    </div>
    <div class="col-md-2">
        <label for="vinculo" class="form-label">Tipo de Vínculo</label>
        <select name="vinculo"class="form-select" id="vinculo">
            <option value="">Selecione</option>
            <option {{ $servidor->tipo_vinculo === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
            <option {{ $servidor->tipo_vinculo === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
            <option {{ $servidor->tipo_vinculo === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
            <option {{ $servidor->tipo_vinculo === 'outro'?'selected':'' }} value="ourto">Outro</option>
        </select>      </div>
    <div class="col-md-4">
      <label for="cargo" class="form-label">Cargo</label>
      <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $servidor->cargo }}">
    </div>
    <div class="col-md-4">
      <label for="secretaria" class="form-label">Secretaria</label>
      <select name="secretaria"class="form-select" id="secretaria">
        <option value="">Selecione</option>
        @foreach ($secretarias as $item)
            <option {{ $item->id === $servidor->id_secretaria_servidores?'selected':'' }} value="{{ $item->id }}">{{ $item->secretaria }}</option>
        @endforeach
    </select>
    </div>
    <div class="col-md-4">
      <label for="email" class="form-label">E-mail</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ $servidor->email }}">
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="celular" name="celular" value="{{ $servidor->celular }}">
      </div>
      <div class="col-md-4">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $servidor->telefone }}">
      </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
  </form>
</div>

@endsection