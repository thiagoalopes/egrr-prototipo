@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
              <a href="{{ route('listar.turmas', ['idCurso'=>$turma->curso->id]) }}" class="mb-4"><i class="fas fa-chalkboard"></i> Voltar para turmas</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <h2>Frequência da Turma</h2>
                <p class="m-0"><small>{{ $turma->curso->nome }}</small></p>
                <small class="mt-2"><span style="font-weight: 600;" >Turma:</span> {{ $turma->descricao_turma }}</small>
            </div>
          </div>
        <div class="row mt-3">
            @if (isset($datas))
                <div class="col-12">

                    <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="get">
                        <div class="col-md-6">
                            <select name="data_aula" id="data_aula" class="form-select">
                                <option value="">Selecione a data</option>
                                @foreach ($datas as $item)
                                    <option {{ \Carbon\Carbon::parse($item)->format('d/m/Y')== \Carbon\Carbon::parse(request()->data_aula)->format('d/m/Y')?'selected':'' }} value="{{ \Carbon\Carbon::parse($item)->format('d/m/Y') }}">{{ \Carbon\Carbon::parse($item)->format('d/m/Y') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Visualizar</button>
                            <a href="{{ route('frequencia.turmas',['idTurma'=>$turma->id]) }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Orgão</th>
                            <th class="text-center">
                                Presença
                                <i data-bs-toggle="tooltip" data-bs-placement="top" title="Marque o campo para registrar a presença do aluno" class="fas fa-info text-primary"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @if (isset($frequencias) && $frequencias->count() > 0)
                                @foreach ($frequencias as $item)
                                    <tr>
                                            <th>
                                                {{ $item->nome_servidor }}
                                            </th>
                                            <th>
                                                <span>{{ $item->sigla_secretaria }}</span>
                                            </th>
                                            <th class="text-center">
                                                    <input type="checkbox"
                                                    {{ $item->ispresente?'checked':'' }}
                                                    data-id-frequencia="{{ $item->id }}"
                                                    >
                                                
                                            </th>
                                        </tr>
                                @endforeach
                            @else
                                        <tr>
                                            <td class="text-center" colspan="3">Selecione o dia da aula</td>
                                        </tr>
                            @endif
                    </tbody>
                </table>
            </div>
        </div>


        

    </div>

    
@endsection
@section('scripts')
    <script>

        let idsFrequencias = document.querySelectorAll('[data-id-frequencia]');

        let myHeaders = new Headers();
        myHeaders.append('Content-type', 'application/x-www-form-urlencoded')

        let myInit = { method: 'POST',
                    headers: myHeaders,
                    mode: 'cors',
                    cache: 'default',
                };
                        
        idsFrequencias.forEach(element => {
            
            element.addEventListener('change', (e)=>{
                
                let formBody = [];
                formBody.push('id_frequencia' + "=" + element.dataset.idFrequencia);

                if(e.target.checked){
                    formBody.push('ispresente' + "=" + 1);
                } else {
                    formBody.push('ispresente' + "=" + 0);
                }

                formBody = formBody.join("&");
                myInit.body =  formBody;

                fetch("{{ route('atualizar.frequecia.turmas',['idTurma'=>$turma->id]) }}", myInit)
                    .then(response=>{
                        response.json().then(json=>{
                            console.log(json);
                        });
                    });
            });

        });


    </script>
@endsection





        

