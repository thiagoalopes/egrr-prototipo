@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row mt-5 mb-5">
            <div class="col-12">
                <a href="{{ route('cadastro.tutores') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Cadastrar Novo</a>
            </div>
        </div>
            <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.tutores') }}" method="get">
                <div class="col-md-6">
                    <input type="text" name="nome" maxlength="128" placeholder="filtrar por nome" class="form-control" id="nome">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
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
                        @if ($tutores->count() != 0)
                            @foreach ($tutores as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td><a href=""><i class="fas fa-eye" title="ver detalhes"></i></a> <a href=""><i title="editar" class="fas fa-edit"></i></a></td>
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

    </div>



@endsection