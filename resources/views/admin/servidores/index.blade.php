@extends('layout.app')
@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('home.administrador') }}" class><i class="fas fa-link"></i> Painel Administrativo</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (Session::has('success'))
            <div class="col-12 text-center">
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
            <h2>Gestão dos Cadastros</h2>
        </div>
    </div>
        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('listar.cadastros') }}" method="get">
            <div class="col-md-6">
                <input type="text" name="cpf" maxlength="128" placeholder="filtrar por cpf" class="form-control" id="nome">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                <a href="{{ route('listar.cadastros') }}" class="btn btn-secondary"><i class="fas fa-eraser"></i> Cancelar</a>

            </div>
        </form>

    <div class="row mt-4">

        <div class="col-12">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th class="text-center">Dados Confirmados</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($servidores->count() != 0)
                        @foreach ($servidores as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>{{ formatCpfCnpj($item->cpf) }}</td>
                                <td class="text-center" style="font-weight: 700;">
                                    @switch($item->servidor_confirmado)
                                        @case(true)
                                            <span class="text-success" >SIM</span>
                                            @break
                                        @case(false)
                                            <span class="text-warning" >NÃO</span>
                                            @break
                                        @default
                                            <span class="text-warning" >NÃO</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a class="m-1 btn  btn-outline-success btn-sm" title="Detalhes do cadastro" href="{{ route('detalhes.cadastros',['idServidor'=>$item->id]) }}"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detalhes</span></a>
                                    <a class="m-1 btn  btn-outline-success btn-sm" title="Detalhes do cadastro" href="{{ route('show.cadastros',['idServidor'=>$item->id]) }}"><i class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span></a>
                                    @if(!$item->servidor_confirmado)
                                        <form style="display: inline-block;" action="{{ route('confirmar.cadastros',['idServidor'=>$item->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-success btn-sm" title="Validar Cadastro do servidor"><i class="fas fa-check-double" ></i> Validar Cadastro</button>
                                        </form>
                                    @endif
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
        {!! $servidores->onEachSide(5)->links() !!}
    </div>

</div>


@endsection