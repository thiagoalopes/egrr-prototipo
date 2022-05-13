@extends('layout.app')
@section('content')

    <div class="container">
        <div class="row">
            @foreach ($inscricoes as $item)
            <div class="col-md-4">
                <div class="card mb-3" >
                    <div class="card-header">
                        <b>Inscrição Nº.: </b> {{ $item->codigo_inscricao }}
                        <b style="flo">Situação: </b> {{ $item->situacao_inscricao }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><b>{{ $item->turma->curso->nome }}</b></h5>
                        <p><b>{{ $item->turma->descricao_turma }}</b></p>
                        <p><b>Período:</b> das {{ \Carbon\Carbon::parse($item->turma->data_inicio)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($item->turma->data_termino)->format('d/m/Y') }}</p>
                        <p><b>Horário:</b> das {{ \Carbon\Carbon::parse($item->turma->horario_inicio_aula)->format('H:i') }} às {{ \Carbon\Carbon::parse($item->turma->horario_termino_aula)->format('H:i') }}</p>
                        <p><b>Comprovante:</b> <a id="comprovante" href="{{ route('comprovante.inscricao',['idCurso'=>$item->turma->curso->id,'codigoInscricao'=>$item->codigo_inscricao]) }}">baixar</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection