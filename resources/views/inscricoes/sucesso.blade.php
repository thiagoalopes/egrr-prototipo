@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Session::has('success'))
            <div class="col-12 text-center">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                <small>Você será redirecionado automaticamente em <span id="redirect"></span></small>
            </div>
        @endif
      </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">

    let sec = 10;
    document.querySelector('#redirect').innerHTML = sec;

    var refreshIntervalId = setInterval(() => {

        sec--;
        document.querySelector('#redirect').innerHTML = sec;

        if(sec == 0){
            clearInterval(refreshIntervalId);
            window.location = '{{ route('inscricao.servidor') }}';
        }
    }, 1000);
    
    


</script>
@endsection