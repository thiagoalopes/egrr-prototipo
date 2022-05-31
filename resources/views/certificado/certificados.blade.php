@extends('layout.app')
@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('listar.cursos') }}"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Voltar para cursos</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (Session::has('success'))
            <div class="col-12 col-md-4 text-center">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
          @elseif(Session::has('error'))
          <div class="col-12 text-center">
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        </div>
        @endif
      </div>
    <div class="row mb-4">
        <div class="col-12">
            <h2>Gestão dos Certificados</h2>
            <small>{{ $curso->nome }}</small>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Carga Horária Cumprida</th>
                        <th>Aproveitamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr> 
                </thead>
                <tbody>
    
                    @if (isset($situacoesAlunos) && count($situacoesAlunos) > 0)
                        @foreach ($situacoesAlunos as $item)
                            <tr>
                                <td>{{ $item['nome'] }}</td>
                                <td>{{ $item['carga_horaria_cumprida'] }}h</td>
                                <td>{{ $item['aproveitamento'] }}</td>
                                <td>
                                    @switch($item['situacao'])
                                        @case('A')
                                            <span class="text-success">Aprovado</span>
                                            @break
                                        @case('R')
                                            <span class="text-danger">Reprovado</span>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </td>
                                <td>
                                    @if ($item['situacao'] == 'A' && !$item['hascertificado'])
                                        <a class="btn btn-outline-success btn-sm" title="Liberar certificado" href="{{ route('librerar.certificados',['idInscricao'=>$item['id_inscricao']]) }}">
                                            <i class="fas fa-certificate"></i> <span class="d-none d-md-inline">Liberar Certificado</span>
                                        </a>
                                    @elseif($item['hascertificado'])
                                        <a class="btn btn-outline-secondary btn-sm" title="O certificado já foi liberado" href="#">
                                            <i class="fas fa-certificate"></i> <span class="d-none d-md-inline">Liberado</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <td colspan="5" class="text-center">Nenhuma informação a ser exibida</td>
                            </tr>
                    @endif
                   
                </tbody>
            </table>
    
        </div>
    </div>

</div>



@endsection