@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
            <div class="col-md-12">
                <a href="{{ route('home.administrador') }}" class="btn btn-secondary"><i class="fas fa-link"></i> Painel</a>
                <a href="{{ route('cadastro.professores') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Cadastrar</a>
            </div>
        </div>
            <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.professores') }}" method="get">
                <div class="col-md-6">
                    <input type="text" name="nome" maxlength="128" placeholder="filtrar por nome" class="form-control" id="nome">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                    <a href="{{ route('listar.professores') }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

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
                        @if ($professores->count() != 0)
                            @foreach ($professores as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td>
                                        <a href="{{ route('detalhes.professores', ['idProfessor'=>$item->id]) }}"><i class="fas fa-eye" title="ver detalhes"></i></a>
                                        <a href="{{ route('editar.professores', ['idProfessor'=>$item->id]) }}"><i title="editar" class="fas fa-edit"></i></a>
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
            {!! $professores->onEachSide(5)->links() !!}
        </div>

    </div>



@endsection