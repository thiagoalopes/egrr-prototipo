@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('home.administrador') }}"><i class="fas fa-link"></i> Painel Administrativo</a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h2>Gestão de Professores</h2>
            </div>
        </div>

        <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
            <div class="col-md-12">
                <a href="{{ route('cadastro.professores') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Novo Professor</a>
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
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($professores->count() != 0)
                            @foreach ($professores as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-success" title="Detalhes do professor" href="{{ route('detalhes.professores', ['idProfessor'=>$item->id]) }}"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detalhes</span></a>
                                        <a class="btn btn-outline-success" title="Editar dados do professor" href="{{ route('editar.professores', ['idProfessor'=>$item->id]) }}"><i title="editar" class="fas fa-edit"></i><span class="d-none d-md-inline">Editar</span></a>
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