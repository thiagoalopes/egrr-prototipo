<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/b_gov.png') }}">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @yield('headers')
</head>
<body>

    <header class="bg-custom-nav">

        <div class="container">


          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/gove.png') }}" alt="" width="100" class="d-inline-block align-text-top">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('welcome')) active @endif" aria-current="page" href="{{ route('welcome') }}">Início</a>
                  </li>
                  @if(Auth::check())
                  <li class="nav-item dropdown">
                    <a class="nav-link  
                      @if(request()->routeIs('home.servidor') ||
                          request()->routeIs('cadastro.servidor') ||
                          request()->routeIs('certificados')) active @endif dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Área do Servidor
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="{{ route('home.servidor') }}">Painel</a></li>
                      <li><a class="dropdown-item" href="{{ route('cadastro.servidor') }}">Cadastro</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{ route('certificados') }}">Certificados</a></li>
                      <li><a class="dropdown-item" href="#">Cartão do Servidor</a></li>
                    </ul>
                  </li>
                  @endif
                </ul>
                <div class="d-flex">
                  @if(Auth::user() != null) 
                    <a href="{{ route('logout') }}" class="btn btn-outline-success">Sair</a>
                  @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Entrar</a>
                  @endif 
                </div>
              </div>
            </div>
          </nav>
    </div>

    </header>

    

  
    <main>
        <div class="container">
            
            @yield('content')

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>