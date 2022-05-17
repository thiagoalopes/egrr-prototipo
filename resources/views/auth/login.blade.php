<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Servidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

</head>
<body>
    <div class="container">
      
        <div class="row justify-content-center mt-4">
            @if (Session::has('success'))
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
              @elseif(Session::has('error'))
              <div class="col-12 col-md-6 col-lg-4 text-center">
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-8 m-auto">

                    <div class="row mt-5 mb-4">
                        <div class="col-12">
                            <h5>Acesso ao Sistema</h5>
                        </div>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @if (isset($rotaAnterior))
                            <input type="hidden" value="{{ $rotaAnterior }}" name="rotaAnterior">
                        @endif
                        <div class="row mb-3">
                            <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
                            <div class="col-sm-10">
                              <input type="text" name="cpf" class="form-control cpf" id="cpf" placeholder="CPF">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="senha" id="senha" placeholder="senha">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                              <div class="form-check">
                                <input class="form-check-input" value="1" name="senha_portal" type="checkbox" id="senha_portal">
                                <i data-bs-toggle="tooltip" data-bs-placement="top" title="Essa opção funciona caso o servidor possua Acesso ao Portal do Servidor" class="fas fa-info text-primary"></i>
                                <label class="form-check-label" for="senha_portal">
                                  Usar senha do Portal do Servidor
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="btns-login">
                              <button id="btnlogin" type="submit" class="btn btn-primary w-50">Acessar</button>
                              <a id="btncadastro" class="btn btn-outline-success mt-3 mt-md-0" href="{{ route('cadastro.servidor') }}">Novo Cadastro</a>
                              <a id="linksenha" class="mt-3" style="display: block;" href="{{ route('cadastro.servidor') }}">Esqueci a Senha</a>
                          </div>
                    </form>
                </div>
            </div>
       
    </div>
    <script src="https://kit.fontawesome.com/9af20ff67f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
    <script>

        $(document).ready(function(){
  
          //JquaryMask
          $('.cpf').mask('000.000.000-00', {reverse: true});
  
          //Bootstrap Tooltips
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
          var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl)
          });
  
        });
  
      </script>

</body>
</html>