@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row justify-content-center mt-4">
            @if (Session::has('success'))
                <div class="col-12 col-lg-4 text-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
              @elseif(Session::has('error'))
              <div class="col-12 col-lg-4 text-center">
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            </div>
            @endif
        </div>
        <div class="row pt-5">

            <div class="col-10 col-md-6 m-auto">
                
                        <form action="{{ route('alterar.senha') }}" method="POST" >
                            @csrf
                                <div class="row mb-3">
                                <label for="senha_atual" class="col-md-4 col-form-label">Senha Atual</label>
                                <div class="col-sm-12 col-md-8">
                                    <input type="password" class="form-control @error('senha_atual') is-invalid @enderror" name="senha_atual" id="senha_atual">
                                    @error('senha_atual')
                                    <span style="display: block;" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                </div>
                                <div class="row mb-3">
                                <label for="nova_senha" class="col-md-4 col-form-label">Nova Senha</label>
                                <div class="col-sm-12 col-md-8">
                                    <input type="password" class="form-control @error('nova_senha') is-invalid @enderror" name="nova_senha" id="nova_senha">
                                    @error('nova_senha')
                                    <span style="display: block;" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                                </div>
                                <div class="row mb-3">
                                <label for="nova_senha_confirmation" class="col-md-4 col-form-label">Confirme a nova senha</label>
                                <div class="col-sm-12 col-md-8">
                                    <input type="password" class="form-control" name="nova_senha_confirmation" id="nova_senha_confirmation">
                                </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-outline-primary">Alterar</button>
                                    <a href="{{ route('home.servidor') }}"  class="btn btn-outline-secondary">Cancelar</a>
                                </div>
                        </form>

            </div>
        </div>

    </div>

@endsection