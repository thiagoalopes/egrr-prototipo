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
            <h2>Gestão de Assinaturas</h2>
        </div>
    </div>

    <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
        <div class="col-md-12">
            <a href="{{ route('cadastro.assinaturas') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nova Assinatura</a>
        </div>
    </div>

    <div class="row">
        <div>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th class="text-center">Assinatura</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($gestores != null)
                            <tr>
                                <td>{{ $gestores->nome_secretario }}</td>
                                <td>Secretário de Administração</td>
                                <td class="text-center"><a class="btn btn-primary btn-sm" href="{{ asset($gestores->imagem_assinatura_secretario) }}" target="_blank">Visualizar</a></td>
                                
                            </tr>
                            <tr>
                                <td>{{ $gestores->nome_diretor_egrr }}</td>
                                <td>Diretor da EGRR</td>
                                <td class="text-center"><a class="btn btn-primary btn-sm" href="{{ asset($gestores->imagem_assinatura_diretor) }}" target="_blank">Visualizar</a></td>

                            </tr>
                    @else
                            <tr>
                                <td colspan="4" class="text-center">Nenhuma assinatura encontrada!</td>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</div>


@endsection