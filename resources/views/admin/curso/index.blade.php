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

        <div class="col-12 col-md-4 col-lg-3 mb-4 mt-4 d-sm-block d-lg-none">

            @if ($cursos->count() != 0)
                @foreach ($cursos as $item)

                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $item->nome }}</b></h5>
                            <div class="card-text">
                                <ul style="list-style-type: none;">
                                    <li>
                                        <i class="fas fa-eye" title="ver detalhes do curso"></i> <a href="{{ route('detalhes.cursos', ['idCurso'=>$item->id]) }}">Detalhes</a>

                                    </li>
                                    <li>
                                        <i title="editar curso" class="fas fa-edit"></i> <a href="{{ route('editar.cursos', ['idCurso'=>$item->id]) }}"> Editar</a>

                                    </li>
                                    <li>
                                        <i title="turmas do curso" class="fas fa-chalkboard"></i> <a href="{{ route('listar.turmas', ['idCurso'=>$item->id]) }}">Turmas</a>

                                    </li>
                                    <li>
                                        <i class="fas fa-book-open"></i> <a href="{{ route('listar.conteudos', ['idCurso'=>$item->id]) }}">Conteúdos</a>

                                    </li>
                                    <li>
                                        <i class="fas fa-list-ol"></i> <a href="#"></i>Incrições</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif

        </div>

        <div class="col-12 d-none d-lg-block">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th colspan="6" >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cursos->count() != 0)
                        @foreach ($cursos as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>
                                    <ul style="list-style-type: none;">
                                        <li>
                                            <i class="fas fa-eye" title="ver detalhes do curso"></i> <a href="{{ route('detalhes.cursos', ['idCurso'=>$item->id]) }}">Detalhes</a>
    
                                        </li>
                                        <li>
                                            <i title="editar curso" class="fas fa-edit"></i> <a href="{{ route('editar.cursos', ['idCurso'=>$item->id]) }}"> Editar</a>
    
                                        </li>
                                        <li>
                                            <i title="turmas do curso" class="fas fa-chalkboard"></i> <a href="{{ route('listar.turmas', ['idCurso'=>$item->id]) }}">Turmas</a>
    
                                        </li>
                                        <li>
                                            <i class="fas fa-book-open"></i> <a href="{{ route('listar.conteudos', ['idCurso'=>$item->id]) }}">Conteúdos</a>
    
                                        </li>
                                        <li>
                                            <i class="fas fa-list-ol"></i> <a href="#"></i>Incrições</a>
                                        </li>
                                    </ul>
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