@extends('layout.app')
@section('headers')
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
@endsection
@section('content')

<section class="cursos">

    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="title">Cursos e Treinamentos</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="como-participar">
                
                    <h4>Como Participar?</h4>
                    <p>
                        Você sabia que o servidor público estadual pode se capacitar gratuitamente!? 
                    </p>
                    <p>A Escola de Governo oferece várias modalidades de cursos e treinamentos para melhorar os conhecimentos dos servidores estaduais.</p>
                    <p>
                        Veja o cursos disponíveis abaixo, e se inscreva!<sup style="color: red;">1</sup> 
                    </p>
                    <p>
                        <small><sup style="color: red;">1</sup>Apenas servidores que atendem o requisito do cursos devem se inscrever.</small>
                    </p>
                </div>
            </div>
        </div>
    

        <div class="row mt-5 mb-3">
    
            @if($cursos->count())

                        @foreach ($cursos as $item)
                
                            <div class="col-12 col-md-4 col-lg-3 mb-4" data-aos="flip-left">
                                
                                <div class="card" >
                                    <img src="{{ $item->imagem != null?$item->imagem:asset('assets/img/cursos/sem-foto.jpg') }}" class="card-img-top" alt="Logo do parceiro">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>{{ $item->nome }}</b></h5>
                                        <p class="card-text"><b>Descrição:</b> {{ $item->descricao }}</p>
                                        <p><b>Professor(a):</b> {{ $item->professor->nome }}</p>
                                        <p>
                                            <b>Período:</b> De {{ $item->data_inicio?\Carbon\Carbon::parse($item->data_inicio)->format('d/m/Y'):'' }} 
                                        até {{ $item->data_inicio?\Carbon\Carbon::parse($item->data_termino)->format('d/m/Y'):'' }}
                                        </p>
                                        <p><b>Vagas:</b> {{ $item->total_vagas }}</p>
                                        <p><b>Situação:</b> {{ $item->situacao->situacao }}</p>
                                        <p>
                                            <a href="{{ route('home.inscricao', ['idCurso'=>$item->id]) }}">Ver Turmas</a>
                                        </p>
                                    </div>
                                </div>
                
                            </div> 
                
                        @endforeach
                    
                @else


                        <div class="col-12" data-aos="flip-left">
        
                            <h5>Nenhum curso foi ofertado</h5>
        
                        </div>
                        
                @endif
        
        </div>
    </div>

</section>

<section class="parceiros">

    <div class="container">

    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="title">Parceiros</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="como-participar">
            
                <h4>Como Participar?</h4>
                <p>Que tal participar do clube de beneicio do servidor?</p>
                <p>
                    Você sabia que o servidor público estadual pode participar de um
                    Clube de Descontos com inúmeras vantagens em comércios e serviços!? 
                </p>
                <p>
                    São descontos em academias, clínicas de saúde, faculdades e cursos,
                    lavagem de carros, óticas, dentre outros que estão incluídos na lista de parceiros.
                </p>
                <p>
                    Os benefícios estão disponíveis para servidores efetivos, comissionados e seus
                    dependentes, bastando acessar o <a href="https://www2.servidor.rr.gov.br/app/login/">Portal do Governo do Estado</a> ou se dirigir
                    ao prédio da UNIVIRR, onde funciona a Escola de Governo, para emitir o seu cartão. 
                </p>
                <p>
                    Se interessou em participar do Clube de Benefícios!? 
                    Então leve seus documentos pessoais e um comprovante de endereço para fazer sua inscrição.
                </p>
            </div>
        </div>
    </div>

        <div class="row mt-5 mb-3">
        
    
        
            @if ($parceiros->count())
        
        
                    @foreach ($parceiros as $item)
        
                        <div class="col-12 col-md-4 col-lg-3 mb-4" data-aos="flip-left">
                            
                            <div class="card" >
                                <img src="https://www.servidor.rr.gov.br/app/admparceiros/imagens/{{ $item->img }}" class="card-img-top" alt="Logo do parceiro">
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{ $item->nome }}</b></h5>
                                    <p class="card-text">{{ $item->descricao }}</p>
                                    <p><b>Endereço:</b> {{ $item->rua }}, {{ $item->numero }}, {{ $item->bairro }}, {{ $item->cidade }}</p>
                                    <p><b>Desconto:</b> {{ $item->desconto }} (%)</p>
                                    <p><b>Vigência:</b> {{ $item->vigencia }}</p>
                                    <section>
                                        <iframe
                                            width="100%"
                                            height="100%"
                                            style="border:0"
                                            loading="lazy"
                                            allowfullscreen
                                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC5LUggILbRZs7Ze3TFYO7lGJ1t508c9j0
                                                &q={{ $item->rua }}+{{ $item->bairro }}+{{ $item->numero }}">
                                        </iframe>
                                    </section>
                                </div>
                            </div>
        
                        </div> 
        
                    @endforeach
                    
        
        
                
        
            @else
        
                    <div class="col-12" data-aos="flip-left">
            
                        <h5>Nenhum parceiro foi cadastrado</h5>
            
                </div>
            @endif
        
        </div>
    </div>

</section>

<div class="container-fluid">
    <div class="row">
      <div class="col-12 p-0" style="border-top: 1px solid #ccc; margin-top: 3.px">
        <iframe style="vertical-align: bottom;" width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJheF1S3EFk40RYQia2XMnYaQ&key=AIzaSyC5LUggILbRZs7Ze3TFYO7lGJ1t508c9j0" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <footer class="p-4" style="background-color: #111111;">
    <p style="color: #fff; margin: 0;" class="text-center">© {{ \Carbon\Carbon::now()->year }} Governo do Estado de Roraima. Todos os Direitos Reservados. Desenvolvimento equipe IMP/TI/SEGAD</p>
</footer>

@endsection
@section('scripts')
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>  
@endsection