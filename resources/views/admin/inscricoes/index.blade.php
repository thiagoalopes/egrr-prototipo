@extends('layout.app')
@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('listar.cursos') }}"><i class="fas fa-school" aria-hidden="true"></i> Voltar para cursos</a>
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
    <div class="row mb-4">
        <div class="col-12">
            <h2>Gestão das Inscrições</h2>
            <small>{{ $curso->nome }}</small>
        </div>
    </div>

        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('index.admin.inscricao',['idCurso'=>$curso->id]) }}" method="get">
            <div class="col-md-6">
                <input type="hidden" name="idCurso" value="{{ $curso->id }}">
                <input type="text" name="cpf" maxlength="128" placeholder="filtrar por cpf" class="form-control" id="cpf">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                <a href="{{ route('listar.turmas',['idCurso'=>$curso->id]) }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

            </div>
        </form>

    <div class="row mt-4">

        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Situação</th>
                        <th>CPF</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($inscricoes->count() != 0)
                        @foreach ($inscricoes as $item)
                            <tr>
                                <td>{{ $item->nome_servidor }}</td>
                                <td style="font-weight: 700;">
                                    @switch($item->situacao_inscricao)
                                        @case('pendente')
                                            <span class="text-warning">Pendente</span>
                                            @break
                                        @case('confirmada')
                                            <span class="text-success">Confirmada</span>
                                            @break
                                        @case('cancelada')
                                            <span class="text-danger">Cancelada</span>
                                            @break

                                        @default
                                        <span class="text-danger">Não Informado</span>
                                    @endswitch
                                </td>
                                <td>{{ formatCpfCnpj($item->cpf_servidor) }}</td>
                                <td class="text-center">
                                    <!--
                                    <a class="m-1 btn  btn-outline-secondary btn-sm" href=""><i class="fas fa-eye" title="Detalhes da Turma"></i> <span class="d-none d-md-inline">Detalhes</span></a>
                                    <a class="m-1 btn btn-outline-secondary btn-sm" href=""><i title="Editar Turma" class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span></a>
                                    -->
                                    @if($item->situacao_inscricao == 'pendente')
                                        <form style="display: inline-block;" action="{{ route('aprovar.admin.inscricao',['idCurso'=>$curso->id,'idInscricao'=>$item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="m-1 btn btn-outline-success btn-sm">
                                                <i title="Aprovar inscrição" class="fas fa-check"></i>
                                                <span class="d-none d-md-inline">Aprovar</span>
                                            </button>
                                        </form>
                                        <form style="display: inline-block;" action="{{ route('cancelar.admin.inscricao',['idCurso'=>$curso->id,'idInscricao'=>$item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="m-1 btn btn-outline-danger btn-sm">
                                                <i title="Cancelar inscrição" class="fas fa-ban"></i>
                                                <span class="d-none d-md-inline">Cancelar</span>
                                            </button>
                                        </form>
                                    @elseif($item->situacao_inscricao == 'cancelada')
                                        <form style="display: inline-block;" action="{{ route('aprovar.admin.inscricao',['idCurso'=>$curso->id,'idInscricao'=>$item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="m-1 btn btn-outline-success btn-sm">
                                                <i title="Aprovar inscrição" class="fas fa-check"></i>
                                                <span class="d-none d-md-inline">Aprovar</span>
                                            </button>
                                        </form>
                                    @elseif($item->situacao_inscricao == 'confirmada')
                                        <form style="display: inline-block;" action="{{ route('cancelar.admin.inscricao',['idCurso'=>$curso->id,'idInscricao'=>$item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="m-1 btn btn-outline-danger btn-sm">
                                                <i title="Cancelar inscrição" class="fas fa-ban"></i>
                                                <span class="d-none d-md-inline">Cancelar</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <td colspan="4" class="text-center">Nenhum registro encontrado!</td>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>

    <div class="d-flex justify-content-center">
        {!! $inscricoes->onEachSide(5)->links() !!}
    </div>

</div>


@endsection