@extends('layout.app')
@section('content')

<div class="container mb-5">
<div class="row">
    <div class="col-12">
        <a href="{{ route('listar.professores') }}" class="btn btn-secondary mb-4"><i class="fas fa-chalkboard-teacher"></i> Voltar para Professores</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" disabled value="{{ $professor->nome }}" id="nome">
    </div>
    <div class="col-md-3">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" class="form-control" disabled value="{{ $professor->cpf }}"  id="cpf">
    </div>
    <div class="col-md-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select class="form-select" disabled id="sexo">
            <option value="">Selecione</option>
            <option {{ $professor->sexo === 'f'?'selected':'' }} value="f">Feminino</option>
            <option {{ $professor->sexo === 'm'?'selected':'' }} value="m">Masculino</option>
            <option {{ $professor->sexo === 'o'?'selected':'' }} value="o">Outro</option>
        </select>
    </div>
    <div class="col-md-6 col-lg-4">
      <label for="email" class="form-label">E-mail</label>
      <input type="text" class="form-control" disabled value="{{ $professor->email }}" id="email">
    </div>
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" disabled value="{{ $professor->celular }}" id="celular">
      </div>
  </div>
</div>

@endsection