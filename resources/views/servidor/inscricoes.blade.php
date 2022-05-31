@extends('layout.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{ route('home.servidor') }}"><i class="fas fa-undo-alt"></i> Voltar ao Painel</a>
            </div>
        </div>
        @if (isset($inscricoes) && $inscricoes->count() > 0)
        <div class="row">
            @foreach ($inscricoes as $item)
            <div class="col-md-4">
                <div class="card mb-3" >
                    <div class="card-header">
                        <b>Inscrição Nº.: </b> {{ $item->codigo_inscricao }} <br>
                        <b>Situação: </b> 
                        @switch($item->situacao_inscricao)
                            @case('pendente')
                                <span class="text-secondary">Pendente</span>
                                @break
                            @case('confirmada')
                                <span class="text-success">Confirmada</span>
                                @break
                            @case('confirmada')
                                <span class="text-danger">Cancelada</span>
                                @break
                            @default
                            @case('confirmada')
                                <span class="text-warning">Desconhecida</span>
                        @endswitch
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><b>{{ $item->turma->curso->nome }}</b></h5>
                        <p><b>{{ $item->turma->descricao_turma }}</b></p>
                        <p><b>Período:</b> das {{ \Carbon\Carbon::parse($item->turma->data_inicio)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($item->turma->data_termino)->format('d/m/Y') }}</p>
                        <p><b>Horário:</b> das {{ \Carbon\Carbon::parse($item->turma->horario_inicio_aula)->format('H:i') }} às {{ \Carbon\Carbon::parse($item->turma->horario_termino_aula)->format('H:i') }}</p>
                        <p>
                            <b>Comprovante:</b>
                            @if ($item->situacao_inscricao == 'confirmada')
                                <a id="comprovante" href="{{ route('comprovante.inscricao',['idCurso'=>$item->turma->curso->id,'codigoInscricao'=>$item->codigo_inscricao]) }}">baixar</a>
                            @else
                                <span class="text-danger">Após confirmação</span>
                            @endif 
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div class="row">
                <div class="col-12">
                    <h5>Você ainda não se inscreveu em nenhum curso...</h5>
                </div>
            </div>
        @endif
    </div>

@endsection