@extends('layouts.site')
@section('content')

<section id="top_banner">
    <div class="banner">
        <div class="inner text-center">
            <h2>{{ $categoria->alias }}</h2>
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

@if(isset($noticias))
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    @foreach($noticias as $noticia)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 portfolio-item">
                        
                        <div class="portfolio-one row">
                            <div class="portfolio-head col-md-4">
                                <div class="portfolio-img"><img alt="{{ $noticia->titulo }}" src="{{ asset('storage/noticias/'.$noticia->imagem)}}"></div>
                            </div>
                            <div class="col-md-8 d-flex">
                                <div class="portfolio-content">
                                    <h5 class="title">{{ $noticia->titulo }}</h5>
                                    <p class="descricao">{{ Str::limit($noticia->descricao,250) }}</p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('noticias', $noticia->titulo) }}" class="btn btn-sm btn-default">Ver mais</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 noticia-categoria">
                <h4>Categorias</h4>
                <ul>
                    @foreach($categorias as $cat)
                    <li><a href="{{ route('categoria', $cat->alias) }}">{{ $cat->alias }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section> 
@endif

@include('Site._pesquisa')

@endsection