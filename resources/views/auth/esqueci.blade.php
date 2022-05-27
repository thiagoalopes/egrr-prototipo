@extends('layout.app')
@section('content')

    <div class="container">

        <div class="row justify-content-center mt-4">
            @if (Session::has('success'))
                <div class="col-12 col-lg-6 text-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
              @elseif(Session::has('error'))
              <div class="col-12 col-lg-6 text-center">
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            </div>
            @endif
        </div>
        <div class="row pt-5">

            <div class="col-10 col-md-6 m-auto">
                
                        <form action="{{ route('reset.senha') }}" method="POST" >
                            @csrf
                                <div class="row mb-3">
                                    <label for="cpf" class="col-md-4 col-form-label">CPF</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control cpf @error('cpf') is-invalid @enderror" value="{{ old('cpf') }}" name="cpf" id="cpf">
                                        @error('cpf')
                                            <span style="display: block;" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label">E-mail<sup><i data-bs-toggle="tooltip" data-bs-placement="top" title="Informe o e-mail cadastrado no sistema" class="fas fa-info text-primary"></i></sup></label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="email">
                                        @error('email')
                                            <span style="display: block;" class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="captcha mb-3 mt-3">
                                          <span class="img">{!! captcha_img() !!}</span>
                                          <button type="button" class="btn btn-danger" style="display: inline;" class="reload" id="reload">
                                              &#x21bb;
                                          </button>
                                          <span><input style="display: inline" id="captcha" type="text" class="form-control w-25 @error("captcha") is-invalid @enderror" placeholder="Enter Captcha" name="captcha"></span>
                                        </div>
                                        @error('captcha')
                                          <span style="display: block;" class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-sync"></i> Alterar</button>
                                    <a href="{{ route('login') }}"  class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Voltar</a>
                                </div>
                                <div class="mt-3">
                                    <small>Informe o e-mail cadastrado no sistema<span class="text-danger">*</span></small><br>
                                </div>
                        </form>
            </div>
        </div>

    </div>

@endsection
@section('scripts')

    <script>
          $(document).ready(function(){
            //JquaryMask
            $('.cpf').mask('000.000.000-00', {reverse: true});

            $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '{{route('reload.captcha')}}',
                success: function (data) {
                    $(".captcha .img").html(data.captcha);
                }
            });

        });
          });
    </script>
@endsection