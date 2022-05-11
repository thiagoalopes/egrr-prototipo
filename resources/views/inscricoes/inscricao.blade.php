@extends('layout.app')
@section('content')
    

<div class="container mb-5">
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{ route('home.inscricao', ['idCurso'=>request()->idCurso]) }}"><i class="fas fa-undo-alt"></i> Voltar</a>
        </div>
    </div>
    <div class="bloco p-3" style="background-color: rgb(243, 243, 243); border-radius: 5px; border: 1px solid rgba(0,0,0,0.3);">

        <div class="row mt-3 mb-3">
            <div class="col-12">
                <h2>Inscrição</h2>
                <small><span class="text-danger">Atenção Servidor!</span><br> Verifique todas as informações antes de se inscrever. Se necessário atualize seus dados 
                    <a href="{{ route('cadastro.servidor') }}">aqui</a>
                </small>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="m-0">
                    <small><b>Curso:</b> {{ $curso->nome }}</small>
                </p>
                <p class="m-0">
                    <small><b>Professor(a):</b> {{ $curso->professor->nome }}</small>
                </p>
            </div>
        </div>
        <div class="row mt-3 mb-4">
            <div class="col-12">
                <p class="m-0">
                    <small><b>Turma:</b> {{ $turma->descricao_turma }}</small>
                </p>
                <p class="m-0">
                    <small><b>Período(a):</b> {{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($turma->data_termino)->format('d/m/Y') }}</small>
                </p>
                <p class="m-0">
                    <small><b>Horário:</b> {{ \Carbon\Carbon::parse($turma->horario_inicio_aula)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($turma->horario_termino_aula)->format('d/m/Y') }}</small>
                </p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <h5>Dados do Servidor</h5>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" disabled value="{{ $servidor->nome }}" id="nome">
            </div>
            <div class="col-md-3">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control cpf" disabled id="cpf" value="{{ $servidor->cpf }}">
            </div>
            <div class="col-md-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" disabled id="sexo">
                    <option value="">Selecione</option>
                    <option {{ $servidor->sexo === 'f'?'selected':'' }} value="f">Feminino</option>
                    <option {{ $servidor->sexo === 'm'?'selected':'' }} value="m">Masculino</option>
                    <option {{ $servidor->sexo === 'o'?'selected':'' }} value="o">Outro</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-2">
              <label for="matricula" class="form-label">Matrícula</label>
              <input type="text" class="form-control" disabled id="matricula" value="{{ $servidor->matricula }}">
            </div>
            <div class="col-md-3 col-lg-2">
                <label for="tipo_vinculo" class="form-label">Tipo de Vínculo</label>
                <select class="form-select" disabled id="tipo_vinculo">
                    <option value="">Selecione</option>
                    <option {{ $servidor->tipo_vinculo === 'efetivo'?'selected':'' }} value="efetivo">Efetivo</option>
                    <option {{ $servidor->tipo_vinculo === 'comissionado'?'selected':'' }} value="comissionado">Comissionado</option>
                    <option {{ $servidor->tipo_vinculo === 'temporario'?'selected':'' }} value="temporario">Temporário</option>
                    <option {{ $servidor->tipo_vinculo === 'outro'?'selected':'' }} value="outro">Outro</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-4">
              <label for="cargo" class="form-label">Cargo</label>
              <input type="text" class="form-control" disabled id="cargo" value="{{ $servidor->cargo }}">
            </div>
            <div class="col-md-6 col-lg-4">
              <label for="secretaria" class="form-label">Secretaria</label>
              <select class="form-select" disabled id="secretaria">
                <option value="">Selecione</option>
                @foreach ($secretarias as $item)
                    <option {{ $item->id === $servidor->id_secretaria_servidores?'selected':'' }} value="{{ $item->id }}">{{ $item->secretaria }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-md-6 col-lg-4">
              <label for="email" class="form-label">E-mail</label>
              <input type="text" disabled class="form-control" id="email" value="{{ $servidor->email }}">
            </div>
            <div class="col-md-4">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" disabled class="form-control cell_with_ddd" id="celular" value="{{ $servidor->celular }}">
              </div>
              <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control phone_with_ddd" id="telefone" disabled value="{{ $servidor->telefone }}">
              </div>
        </div>
        <form id="form" class="row g-3 ms-3 mt-4 mb-4" action="{{ route('salvar.inscricao') }}" method="POST">
            <div class="form-check">
                @csrf
                <input class="form-check-input" type="checkbox" value="1" name="termo_aceito" id="termo_aceito">
                <input type="hidden" name="id_curso" value="{{ request()->idCurso }}">
                <input type="hidden" name="id_turma" value="{{ request()->idTurma }}">
                <label class="form-check-label" for="termo_aceito">
                    Li e aceito os (<a href="">Termos de Inscrição</a>)
                </label>
              </div>
              <div class="col-md-6 col-lg-4">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btninscrever" disabled class="btn btn-primary btn-lg">Inscrever</button>
              </div>
        </form>

    </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmação da Inscrição</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Você irá se increver no <b>curso:</b> {{ $curso->nome }} <b>Turma:</b> {{ $turma->descricao_turma }} 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnconfirmar">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('scripts')

    <script>

        window.onload = (e)=>{

            let btnConfirmar = document.querySelector('#btnconfirmar');
            let checkTermoAceito = document.querySelector('#termo_aceito');
            let btnInscrever = document.querySelector('#btninscrever');

            checkTermoAceito.checked = false;
    
            checkTermoAceito.addEventListener('change', (e)=>{
                e.preventDefault();

                if(e.target.checked == true){

                    btnInscrever.disabled = false;
                } else {
                    btnInscrever.disabled = true;
                }
            });

            btnConfirmar.addEventListener('click', (e)=>{
                let form = document.querySelector('#form');
                form.submit();
            });
        }

    </script>

@endsection