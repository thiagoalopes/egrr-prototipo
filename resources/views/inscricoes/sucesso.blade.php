@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Session::has('success'))
            <div class="col-12 text-center">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                <h2><a id="comprovante" href="{{ route('comprovante.inscricao',['idCurso'=>$idCurso,'codigoInscricao'=>$codigoInscricao]) }}">Comprovante</a></h2>
                <small>Você será redirecionado automaticamente em <span id="redirect"></span></small>
            </div>
        @endif
      </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">

    window.open("{{ route('comprovante.inscricao',['idCurso'=>$idCurso,'codigoInscricao'=>$codigoInscricao]) }}");

    let sec = 30;
    document.querySelector('#redirect').innerHTML = sec;

    var refreshIntervalId = setInterval(() => {

        sec--;
        document.querySelector('#redirect').innerHTML = sec;

        if(sec == 0){
            clearInterval(refreshIntervalId);
            window.location = '{{ route('welcome') }}';
        }
    }, 1000);
    
    


</script>
@endsection