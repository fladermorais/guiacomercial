@extends('layouts.site')
@section('content')

<section id="top_banner">
    <div class="banner">
        <div class="inner text-center">
            <h2>Categorias</h2>
        </div>
    </div>
</section>

{{-- <section id="about">
    <div class="container-fluid">    
        <div class="col-md-12 col-sm-12 col-xs-12 text-inner ">
            <div class="text-block">
                <div class="section-heading">
                    <h1 class="text-center">Categorias</h1>
                </div>
                
                <ul class="aboutul">
                    <li class="text-center">Aqui você encontra uma lista com as categorias do nosso guia comercial, clique sobre ela e verá todos os anúncios correspondentes!</li>
                </ul>
                
            </div>
        </div>
    </div>
</section> --}}

<section class="breadcrumbs">
    <span><a href="{{ route('home') }}">Home /</a> </span>
    @if($breadcrumbs['categoria'] == $breadcrumbs['atual'])
    <span>{{ $breadcrumbs['atual'] }}</span>
    @else
    <span><a href="{{ route('categorias', $breadcrumbs['categoria'] ) }}"> {{ $breadcrumbs['categoria'] }}</a> /</span>
    <span>{{ $breadcrumbs['atual'] }}</span>
    @endif
</section>

@if(isset($categorias))
<section id="portfolio">
    <div class="container">
        <div class="row">
            @foreach($categorias as $categoria)
            <a href="{{ route('categoria', $categoria->alias) }}">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 portfolio-item">
                    <div class="portfolio-one">
                        <div class="portfolio-head">
                            <div class="portfolio-img categoria-img">
                                <img alt="{{ $categoria->alias }}" src="{{ asset('storage/categorias/'.$categoria->img)}}">
                            </div>
                            {{-- <div class="portfolio-hover">
                                <a class="portfolio-link" href="{{ route('categoria', $categoria->alias )}}"><i class="fa fa-link"></i></a>
                            </div> --}}
                        </div>
                        <div class="portfolio-content">
                            <h5 class="title">{{ $categoria->nome }}</h5>
                            {{-- <p class="descricao">{{ Str::limit($categoria->descricao,40) }}</p> --}}
                            @if($categoria->total > 0)
                            <p class="count_categoria"><i class="fa fa-circle"></i> <span>{{ strlen($categoria->total) == 1 ? "0".$categoria->total : $categoria->total }}</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section> 
@endif

@if($anuncios)
<section id="portfolio">
    <div class="container">
        <div class="row">
            @foreach($anuncios as $anuncio)
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 portfolio-item">
                <div class="portfolio-one">
                    <div class="portfolio-head">
                        <div class="portfolio-img"><img alt="{{ $anuncio->nome }}" src="{{ asset('storage/logo/'.$anuncio->img)}}"></div>
                    </div>
                    <div class="portfolio-content">
                        <h5 class="title">{{ $anuncio->nome }}</h5>
                        {{-- <p class="descricao">{{ Str::limit($anuncio->descricao,40) }}</p> --}}
                        <p class="telefone"><b>Telefone: </b><a href="tel:{{ $anuncio->telefone }}">{{ $anuncio->telefone }}</a></p>
                        <p class="categoria">
                            <b>Categoria: </b>
                            <a href="{{ route('categoria', $anuncio->categorias->alias) }}"> {{ $anuncio->categorias->nome }} </a>
                            @if($anuncio->subcategoria_id)
                            - 
                            <a href="{{ route('subcategoria', $anuncio->subcategorias->alias)}}">{{ $anuncio->subcategorias->nome }}</a>
                            @endif
                        </p>
                        <div class="flex-row detalhes">
                            <a class="btn btn-default btn-sm" href="{{ route('anuncio', $anuncio->alias )}}">Visualizar</a>
                            @if($anuncio->like > 0)
                            <p class="curtir-home">
                                <i class="fa fa-heart"></i> 
                                <span>{{ strlen($anuncio->like) == 1 ? "0".$anuncio->like : $anuncio->like }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 

<div class="container">
    <div class="row">
        {{ $anuncios->links() }}
    </div>
</div>
@endif

@include('Site._pesquisa')

@endsection