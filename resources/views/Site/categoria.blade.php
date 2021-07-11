@extends('layouts.site')
@section('content')

<section id="top_banner">
    <div class="banner">
        <div class="inner text-center">
            <h2>{{ $categoria->nome }}</h2>
        </div>
    </div>
</section>

<section class="breadcrumbs">
    <span><a href="{{ route('home') }}">Home /</a> </span>
    @if($breadcrumbs['categoria'] == $breadcrumbs['atual'])
    <span>{{ $breadcrumbs['atual'] }}</span>
    @else
    <span><a href="{{ route('categorias', $breadcrumbs['categoria'] ) }}"> {{ $breadcrumbs['categoria'] }}</a> /</span>
    <span>{{ $breadcrumbs['atual'] }}</span>
    @endif
</section>
@if(isset($subcategorias))
<section class="container-fluid">
    <ul class="subcategorias">
        @foreach($subcategorias as $sub)
        <li><a href="{{ route('subcategoria', $sub->alias ) }}">{{ $sub->nome }}</a></li>
        @endforeach
    </ul>
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
                            <b>Categoria: </b><a href="{{ route('categoria', $anuncio->categorias->alias) }}"> {{ $anuncio->categorias->nome }} </a>
                            @if($anuncio->subcategoria_id)
                            - 
                            <a href="{{ route('subcategoria', $anuncio->subcategorias->alias)}}">{{ $anuncio->subcategorias->nome }}</a>
                            @endif
                            
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
    @endif
    
    @include('Site._pesquisa')
    
    @endsection