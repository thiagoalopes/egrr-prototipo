@extends('layout.app')
@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('listar.cursos') }}"><i class="fas fa-school" aria-hidden="true"></i> Voltar para cursos</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h2>Gestão de Conteúdos</h2>
            <small>{{ $curso->nome }}</small>
        </div>
    </div>

    <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
        <div class="col-md-12">
            <a href="{{ route('cadastro.conteudos', ['idCurso'=>request()->get('idCurso')]) }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Novo Conteúdo</a>
        </div>
    </div>
        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.conteudos') }}" method="get">
            <div class="col-md-6">
                <input type="hidden" name="idCurso" value="{{ request()->get('idCurso') }}">
                <input type="text" name="conteudo" maxlength="128" placeholder="filtrar por conteúdo" class="form-control" id="nome">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                <a href="{{ route('listar.conteudos',['idCurso'=>request()->get('idCurso')]) }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

            </div>
        </form>

    <div class="row">

        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ordem</th>
                        <th>Descrição</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($conteudos->count() != 0)
                        @foreach ($conteudos as $item)
                            <tr>
                                <td style="width: 2%;">{{ $item->sequencial_ordenacao }}</td>
                                <td>{{ $item->conteudo }}</td>
                                <td class="text-center">
                                    <a class="btn btn-link text-success" href="{{ route('detalhes.conteudos', ['idCurso'=>request()->get('idCurso'), 'idConteudo'=>$item->id]) }}"><i class="fas fa-eye" title="ver detalhes"></i></a>
                                    <a class="btn btn-link text-primary" href="{{ route('editar.conteudos', ['idCurso'=>request()->get('idCurso'), 'idConteudo'=>$item->id]) }}"><i title="editar" class="fas fa-edit"></i></a>
                                    <form style="display: inline-block" method="POST" action="{{ route('remover.conteudos') }}">
                                        @csrf
                                        <input type="hidden" value="{{ request()->get('idCurso') }}" name="idCurso">
                                        <input type="hidden" value="{{ $item->id }}" name="idConteudo">
                                        <button type="submit" class="btn btn-link text-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                        
                    @else
                            <tr>
                                <td colspan="3" class="text-center">Nenhum registro encontrado!</td>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>

    <div class="d-flex justify-content-center">
        {!! $conteudos->onEachSide(5)->links() !!}
    </div>

</div>


@endsection