<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprovante de Inscrição</title>
    <style>

        table{
            border: 1px solid rgba(0, 0, 0, 0.2);
            width: 100%;
            border-collapse: collapse;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;

        }
        div{
            margin-bottom: 5px;
        }

        table td, table th{
            border: 1px solid rgba(0, 0, 0, 0.2);
            text-align: left;
            padding: 6px 5px;
            font-size: 0.7rem !important;
            
        }

        .col-relacao {
            padding: 2px 0 2px 5px;
        }

        .secao {
            background-color: #c1c1c1;
            font-weight: bold;
            padding: 10px;
        }

        .brasao{
            text-align: center;
            width: 70px;
        }

        .cabecalho{
            text-align: center;
            padding: 10px;
        }
        .cabecalho div{
            margin: 2px 0;
        }

    </style>
</head>
<body>
    <section class="cabecalho">

        <table width="100%">
            <thead>
                <tr>
                    <th class="cabecalho" colspan="4">
                        <img class="brasao" src="assets/img/b_gov.png" alt="Brasão do Estado de Roraima">
                        <div>
                            Estado de Roraima
                        </div>
                        <div>
                            Secretaria de Estado de Gestão Estratégica e Administração
                        </div>
                        <div>
                            Escola de Governo de Roraima
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="secao" style="text-align: center;font-size:1.1rem; padding: 10px;" colspan="4">
                        <strong>FREQUÊNCIA DO CURSO</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 20px;">
                        <p>
                            <b>Curso:</b> {{ $turma->curso->nome }}
                        </p>
                        <p>
                            <b>Carga Horária:</b> {{ $turma->curso->carga_horaria }}
                        </p>
                        <p>
                            <b>Turma:</b> {{ $turma->descricao_turma }}
                        </p>
                        <p>
                            <b>Período:</b> {{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}
                            a {{ \Carbon\Carbon::parse($turma->data_termino)->format('d/m/Y') }}
                            <b style="margin-left: 10px;">Horário:</b> {{ \Carbon\Carbon::parse($turma->horario_inicio_aula)->format('H:i') }}
                            a {{ \Carbon\Carbon::parse($turma->horario_termino_aula)->format('H:i') }} 
                        </p>
                        <p>
                            <b>Professor(a):</b> {{ $turma->curso->professor->nome }}
                        </p>
                        <p>
                            <b>Dia da Aula:</b> {{ \Carbon\Carbon::parse($dataAula)->format('d/m/Y') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%;text-align: center; font-weight: 700;background-color: #c1c1c1;">Nº</td>
                    <td style="width: 50%; font-weight: 700;background-color: #c1c1c1;">NOME</td>
                    <td style="width: 20%; font-weight: 700;background-color: #c1c1c1;">ORGÃO DE ORIGEM</td>
                    <td style="width: 25%;text-align: center;font-weight: 700;background-color: #c1c1c1;">ASSINATURA</td>
                </tr>
                @foreach ($frequencias as $item)
                    <tr>
                        <td style="text-align: center;">{{ $loop->index+1  }}</td>
                        <td class="col-relacao">{{ $item->nome_servidor }}</td>
                        <td class="col-relacao">{{ $item->sigla_secretaria }}</td>
                        <td class="col-relacao"></td>
                    </tr>

                @endforeach
                <tr>
                    <td colspan="4" style="padding: 15px"><b>Data e Hora da Emissão:</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }} <b>às</b> {{ \Carbon\Carbon::now()->format('H:i') }}h</td>
                </tr>
            </tbody>
        </table>

    </section>
    
</body>
</html>