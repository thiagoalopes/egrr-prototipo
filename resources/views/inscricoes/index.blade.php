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
        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="col-12 text-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
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
                                <p><b>Período:</b> das {{ \Carbon\Carbon::parse($item->data_inicio)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($item->data_termino)->format('d/m/Y') }}</p>
                                <p><b>Horário:</b> das {{ \Carbon\Carbon::parse($item->horario_inicio_aula)->format('H:i') }} às {{ \Carbon\Carbon::parse($item->horario_termino_aula)->format('H:i') }}</p>
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