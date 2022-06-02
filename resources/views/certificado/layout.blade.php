<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprovante</title>
    <style>


        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .box-certificado {
            width: 99%;
            height: 98%;
            margin: auto;
            border: 5px outset black;
            border-radius: 15px;
            position: relative;
            top: 0;
            left: 0;
        }

        .brasao {
            width: 100px;
            position: absolute;
            top: 30px;
            left: 450px;
            box-shadow: 5px 5px 14px -6px #000000;

        }

        .cabecalho {
            text-align: center;
            position: absolute;
            top: 150px;
            left: 275px;
            font-weight: bold;
            font-size: 0.6rem;

        }

        .marca-dagua {
            width: 55%;
            position: absolute;
            top: 5%;
            left: 21%;
            opacity: 0.05;
        }

        .cabecalho p {
            margin: 0;
        }

        .texto {

            width: 80%;
            text-align: justify;
            position: absolute;
            left: 50%;
            top: 38%;
            margin-left: -40%;
            line-height: 30px;

        }
        
        .data {
            position: absolute;
            right: 20%;
            top: 63%;
        }

        .assinatura-secretario {
            position: absolute;
            bottom: 10%;
            right: 15%;
            font-size: 0.8rem;
            text-align: center;
            line-height: 15px;

        }
        .assinatura-diretor {
            position: absolute;
            bottom: 10%;
            left: 15%;
            font-size: 0.8rem;
            text-align: center;
            line-height: 15px;
        }
        
    </style>
</head>
<body>

    <div class="box-certificado">
        <img class="brasao" src="assets/img/brasao.png" alt="">
        <img class="marca-dagua" src="assets/img/brasao.png">
        <div class="cabecalho">
            <p>ESTADO DE RORAIMA</p>
            <p>SECRETARIA DE ESTADO DA GESTÃO ESTRATÉGICA E ADMINISTRAÇÃO DE RORAIMA - SEGAD</p>
            <p>ESCOLA DE GOVER NO DE RORAIMA</p>
            <p>DECRETO Nº 13.393-E DE 27 DE OUTUBRO DE 2011</p>
        </div>
        <div class="texto">
            A secretaria de Estado da Gestão Estratégica e Administração - SEGAD, certifica o(a) Servidor(a)
             <b>{{ strtoupper($certificado->nome_servidor) }}</b>, 
             Quadro
             <b>
                @if($certificado->tipo_vinculo == 'efetivo') 
                    EFETIVO 
                @elseif($certificado->tipo_vinculo == 'efetcomiss') 
                    EFETIVO/COMISSIONADO
                @elseif($certificado->tipo_vinculo == 'comissionado')
                    COMISSIONADO
                @elseif($certificado->tipo_vinculo == 'temporario')
                    TEMPORÁRIO
                @elseif($certificado->tipo_vinculo == 'federal')
                    FEDERAL
                @endif
            </b>,
                <b>matrícula {{ $certificado->matricula }}</b>, pela participação no curso de capacitação {{ $certificado->curso }},
            no período de {{ \Carbon\Carbon::parse($certificado->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($certificado->data_termino)->format('d/m/Y') }},
            ministrado por <b>{{ strtoupper($certificado->professor) }}</b>, 
            com carga horária de {{ $certificado->carga_horaria }}h, tendo aproveitamento de {{ $certificado->aproveitamento }}%.
            
        </div>
        <div class="data">
            Boa Vista - RR, {{ \Carbon\Carbon::parse($certificado->data_emissao)->format('d')}} de 
            @switch(\Carbon\Carbon::parse($certificado->data_emissao)->format('m'))
                @case('01')
                    janeiro
                    @break
                @case('02')
                    fevereiro
                    @break
                @case('03')
                    março
                    @break
                @case('04')
                    Abril
                    @break
                @case('05')
                    maio
                    @break
                @case('06')
                    junho
                    @break
                @case('07')
                    julho
                    @break
                @case('08')
                    agosto
                    @break
                @case('09')
                    setembro
                    @break
                @case('10')
                    outubro
                    @break
                @case('11')
                    novembro
                    @break
                @case('12')
                    dezembro
                    @break
            @endswitch
            de {{ \Carbon\Carbon::parse($certificado->data_emissao)->format('Y')}}.
        </div>
        <div class="assinatura-secretario">
            <img style="width: 100;" src="{{ $certificado->assinatura_secretario_segad }}" style="margin-bottom: 10px;" ><br>
            {{ $certificado->secretario_segad }} <br>
            Secretário de Estado da Administração
        </div>
        <div class="assinatura-diretor">
            <img style="width: 100;" src="{{ $certificado->assinatura_diretor_egrr }}" style="margin-bottom: 10px;"><br>
            {{ $certificado->diretor_egrr }} <br>
            <small>Diretor da Escola de Governo de Roraima</small>

        </div>
    </div>

</body>
</html>