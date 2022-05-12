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
                    <th class="cabecalho" colspan="3">
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
                    <td class="secao" style="text-align: center;font-size:1.1rem; padding: 10px;" colspan="3">
                        <strong>INSCRIÇÃO Nº.: {{ $inscricao->codigo_inscricao }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 20px;">
                        <h2>Dados do Inscrito</h2>
                        <p>
                            <b>Nome:</b> {{ $inscricao->servidor->nome }} <b style="margin-left: 10px;">CPF:</b> {{ formatCpfCnpj($inscricao->servidor->cpf) }}
                        </p>
                        <p>
                            <b>E-mail:</b> {{ $inscricao->servidor->email }}
                        </p>
                        <p>
                            <b>Cargo:</b> {{ $inscricao->servidor->cargo }} <b style="margin-left: 10px;">Matrícula:</b> {{ $inscricao->servidor->matricula }}
                        </p>
                        <p>
                            <b>Secretaria:</b> {{ $inscricao->servidor->secretaria->secretaria }}
                        </p>
                        <p style="text-align: center; margin-top: 40px; font-size: 14px;"><b>Curso:</b> {{ $inscricao->turma->curso->nome }}</p>
                        <p style="text-align: center; font-size: 14px;"><b>Turma:</b> {{ $inscricao->turma->descricao_turma }} 
                            <b style="margin-left: 10px;">Período:</b> {{ \Carbon\Carbon::parse($inscricao->turma->data_inicio)->format('d/m/Y') }}
                            a {{ \Carbon\Carbon::parse($inscricao->turma->data_termino)->format('d/m/Y') }}
                            <b style="margin-left: 10px;">Horário:</b> {{ \Carbon\Carbon::parse($inscricao->turma->horario_inicio_aula)->format('H:i') }}
                            a {{ \Carbon\Carbon::parse($inscricao->turma->horario_termino_aula)->format('H:i') }} 
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: justify; padding: 20px;">
                        <h2 style="margin-bottom: 20px;">Observações</h2>
                        <ul>
                            <li>
                                O Servidor ao se inscrever no curso supracitado, leu e aceitou os termos no ato da inscrição.
                            </li>
                            <li>
                                A Escola de Governo, por meio de sua equipe de coordenação, realizará análise dos dados e poderá ou não aprovar a inscrição.
                            </li>
                            <li>
                                O Servidor será notificado por mensagem automática de e-mail ou poderá
                                acompanhar a situação da inscrição na seção de minhas inscrições.
                            </li>
                            <li>
                                O Servidor que tiver sua inscrição reprovada não poderá mais se inscrever no mesmo curso.
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><b>Data e Hora Local da Inscrição:</b> {{ \Carbon\Carbon::parse($inscricao->created_at)->format('d/m/Y') }} <b>às</b> {{ \Carbon\Carbon::parse($inscricao->created_at)->format('H:i') }}h</td>
                </tr>
            </tbody>
        </table>

    </section>
    
</body>
</html>