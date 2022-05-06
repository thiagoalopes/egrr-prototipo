@extends('layout.app')
@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('listar.cursos') }}"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Voltar para cursos</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h2>Gestão de Turmas</h2>
            <small>{{ $curso->nome }}</small>
        </div>
    </div>

    <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
        <div class="col-md-12">
            <a href="{{ route('cadastro.turmas', ['idCurso'=>request()->get('idCurso')]) }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nova Turma</a>
        </div>
    </div>
        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.turmas') }}" method="get">
            <div class="col-md-6">
                <input type="hidden" name="idCurso" value="{{ request()->get('idCurso') }}">
                <input type="text" name="descricao" maxlength="128" placeholder="filtrar por descrição" class="form-control" id="nome">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                <a href="{{ route('listar.turmas',['idCurso'=>request()->get('idCurso')]) }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

            </div>
        </form>

    <div class="row">

        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descrição da Turma</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($turmas->count() != 0)
                        @foreach ($turmas as $item)
                            <tr>
                                <td>{{ $item->descricao_turma }}</td>
                                <td>
                                    <a href="{{ route('detalhes.turmas', ['idCurso'=>request()->get('idCurso'), 'idTurma'=>$item->id]) }}"><i class="fas fa-eye" title="ver detalhes"></i></a>
                                    <a href="{{ route('editar.turmas', ['idCurso'=>request()->get('idCurso'), 'idTurma'=>$item->id]) }}"><i title="editar" class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                    @else
                            <tr>
                                <td colspan="2">Nenhum registro encontrado!</td>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>

    <div class="d-flex justify-content-center">
        {!! $turmas->onEachSide(5)->links() !!}
    </div>

</div>


@endsection