@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('welcome') }}"><i class="fas fa-home"></i> Início</a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <h2>Inscrição</h2>
                <small>{{ $curso->nome }}</small>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-12">
                <h4>Turmas</h4>
            </div>
        </div>

        <div class="row">
            @if ($turmas->count() > 0)
                @foreach ($turmas as $item)
                    <div class="col-md-4">
                            
                        <div class="card mb-3" >
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $item->descricao_turma }}</b></h5>
                                <p><b>Horário:</b> das {{ $item->horario_inicio_aula }} às {{ $item->horario_termino_aula }}</p>
                                <p><b>Situação:</b> {{ $item->situacao->situacao }}</p>
                                <p>
                                    <a href="{{ route('pre.inscricao', ['idCurso'=>request()->idCurso,'idTurma'=>$item->id]) }}">Inscrição</a>
                                </p>
                            </div>
                        </div>

                    </div>
                @endforeach
            
            @else
                <h5>Não há turmas disponíveis <a href="{{ route('welcome') }}"> <i class="fas fa-home"></i> Início</a></h5>
            @endif
        </div>
 
    </div>

@endsection