<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Servidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Login</h2>
            </div>
        </div>
        <form action="{{ route('login') }}" method="POST" class="row">
            @csrf
            <div class="col-12 col-md-6 col-lg-3">
            <input type="text" class="form-control" placeholder="cpf" name="cpf" id="cpf">
        
            </div>
            <div class="col-12 col-md-6 col-lg-3">
            <input type="password" class="form-control" placeholder="senha" name="senha" id="senha">
        
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">Entrar</button> <a class="align-bottom ms-2 btn btn-success" href="{{ route('cadastro.servidor') }}">Novo Cadastro</a> <a class="align-bottom ms-2" href="https://www.servidor.rr.gov.br/app/recuperarsenha/" target="_blank">Esqueci a senha</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>