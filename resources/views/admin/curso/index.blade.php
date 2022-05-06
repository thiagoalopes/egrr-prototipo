@extends('layout.app')
@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('home.administrador') }}" class><i class="fas fa-link"></i> Painel Administrativo</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h2>Gestão de Cursos</h2>
        </div>
    </div>

    <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
        <div class="col-md-12">
            <a href="{{ route('cadastro.cursos') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Novo Curso</a>
        </div>
    </div>
        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.cursos') }}" method="get">
            <div class="col-md-6">
                <input type="text" name="nome" maxlength="128" placeholder="filtrar por nome" class="form-control" id="nome">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                <a href="{{ route('listar.cursos') }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

            </div>
        </form>

    <div class="row">

        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cursos->count() != 0)
                        @foreach ($cursos as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>
                                    <a href="{{ route('detalhes.cursos', ['idCurso'=>$item->id]) }}"><i class="fas fa-eye" title="ver detalhes"></i></a>
                                    <a href="{{ route('editar.cursos', ['idCurso'=>$item->id]) }}"><i title="editar" class="fas fa-edit"></i></a>
                                    <a href="{{ route('listar.turmas', ['idCurso'=>$item->id]) }}"><i title="turmas" class="fas fa-chalkboard"></i></a>
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
        {!! $cursos->onEachSide(5)->links() !!}
    </div>

</div>


@endsection