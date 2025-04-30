@extends('layouts.site')
@section('content')

@if(isset($dados))
<section id="about">
    <div class="col-md-12 col-sm-12 col-xs-12 text-inner ">
        <div class="text-block">
            <div class="section-heading">
                <h1 class="text-center">{{ $dados->titulo}}</h1>
            </div>
            
            <ul class="aboutul">
                <li class="text-center">{!! $dados->mensagem !!}</li>
            </ul>
            
        </div>
    </div>
</section>
@endif


@include('Site._pesquisa')

<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="section-heading text-center">
                <div class="col-md-12 col-xs-12">
                    <h1>Anúncios em <span>Destaque</span></h1>
                    <p class="subheading">Aqui você encontra os anúncios mais visitados do guia comercial!</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($anuncios as $anuncio)
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 portfolio-item">
                <div class="portfolio-one">
                    <div class="portfolio-head">
                        <div class="portfolio-img">
                        <img alt="{{ $anuncio->nome }}" src="{{ asset('storage/logo/'.$anuncio->img)}}">
                        </div>
                    </div>
                    <!-- End portfolio-head -->
                    <div class="portfolio-content">
                        <h5 class="title">{{ $anuncio->nome }}</h5>
                        <p class="descricao">{!! Str::limit($anuncio->descricao,40) !!}</p>
                        {{-- <p class="telefone"><b>Telefone: </b><a href="tel:{{ $anuncio->telefone }}">{{ $anuncio->telefone }}</a></p> --}}
                        <p class="categoria">
                            <b>Categoria:</b> 
                            <br>
                            <a href="{{ route('categoria', $anuncio->categorias->alias) }}"> {{ Str::limit($anuncio->categorias->nome, 20) }} </a>
                            @if($anuncio->subcategoria_id)- 
                            <a href="{{ route('subcategoria', $anuncio->subcategorias->alias)}}">{{ Str::limit($anuncio->subcategorias->nome, 20) }}</a>
                            @endif
                        </p>
                        <div class="flex-row detalhes">
                            <a class="btn btn-default btn-sm visualizar" href="{{ route('anuncio', $anuncio->alias )}}">Visualizar</a>
                            @if($anuncio->like > 0)
                            <p class="curtir-home">
                                <i class="fa fa-heart"></i> 
                                <span>{{ strlen($anuncio->like) == 1 ? "0".$anuncio->like : $anuncio->like }}</span>
                            </p>
                            @endif
                        </div>
                        
                    </div>
                    <!-- End portfolio-content -->
                </div>
                <!-- End portfolio-item -->
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection