@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('welcome') }}"><- Voltar</a>
        </div>
        <div class="col-12">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>data emissão</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Informatica Basica</td>
                        <td>01/01/2022</td>
                        <td><a href="{{ route('download.certificado') }}" target="_blank">X</a></td>
                    </tr>
                    <tr>
                        <td>Informatica Avancada</td>
                        <td>01/05/2022</td>
                        <td><a href="{{ route('download.certificado') }}" target="_blank">X</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>


@endsection