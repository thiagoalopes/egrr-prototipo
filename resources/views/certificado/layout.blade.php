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
            left: 320px;
            font-weight: bold;
            font-size: 0.8rem;

        }

        .cabecalho p {
            margin: 0;
        }

        .texto {

            width: 80%;
            text-align: justify;
            position: absolute;
            left: 50%;
            top: 40%;
            margin-left: -40%;

        }   
        
    </style>
</head>
<body>

    <div class="box-certificado">
        <img class="brasao" src="assets/img/brasao.png" alt="">
        <div class="cabecalho">
            <p>Estado de Roraima</p>
            <p>Secretaria de Estado de Gestão Estratégica e Administração</p>
            <p>Escola de Governo de Roraima</p>
        </div>
        <div class="texto">
            Certificamos que <b>{{ $usuario->dados->nome }}</b>, <b>CPF n. {{ $usuario->cpf }}</b> participou do curso de Informatica basica no periodo de 01/01/2022 a 15/01/2022
            com carga horaria de 60h.
            
        </div>
    </div>

</body>
</html>