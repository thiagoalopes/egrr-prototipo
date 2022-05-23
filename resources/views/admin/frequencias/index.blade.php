@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            @if (isset($datas))
                <div class="col-12">

                    <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="get">
                        <div class="col-md-6">
                            <select name="data_aula" id="data_aula" class="form-select">
                                @foreach ($datas as $item)
                                    <option value="{{ \Carbon\Carbon::parse($item)->format('d/m/Y') }}">{{ \Carbon\Carbon::parse($item)->format('d/m/Y') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Visualizar</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection



@if (isset($inscricoes))
    @if ($inscricoes->count() > 0)
        <ul>
            @foreach ($inscricoes as $item)
                <li>{{ $item->servidor->nome }} - {{ $item->servidor->secretaria->sigla }} - presente?
                    @if(isset($frequenciaServidor))
                        <input type="checkbox"
                         @if(isset($frequenciaServidor[$item->id_servidor]) && 
                                    $frequenciaServidor[$item->id_servidor]->ispresente) 
                                    checked
                         @endif
                         @if(isset($frequenciaServidor[$item->id_servidor]))
                            data-id-frequencia="{{ $frequenciaServidor[$item->id_servidor]->id }}"
                         @else
                            data-id-inscricao="{{ $item->id }}"
                         @endif
                        >
                    @else
                        <input type="checkbox" >
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        nenhum inscrito confirmado
    @endif
@endif

        <script>


                let idsIncricoes = document.querySelectorAll('[data-id-incricao]');
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
    
                        fetch("{{ route('atualizar.frequecia.turmas',['idTurma'=>request()->idTurma]) }}", myInit)
                            .then(response=>{
                                response.json().then(json=>{
                                    console.log(json);
                                });
                            });
                    });

                });

            
        </script>

