@extends('layouts.site')
@section('content')

<section id="top_banner">
    <div class="banner">
        <div class="inner text-center">
            <h2>{{ $noticia->categorias->titulo }}</h2>
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

<section id="noticia">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="section-heading text-center">
                        <div class="col-md-12 col-xs-12 ">
                            <h1><span>{{ $noticia->titulo }}</span></h1>
                            <p class="text-right">Por: {{ $noticia->users->name }}  |  {{ date('d/m/Y', strtotime($noticia->created_at)) }}</p>
                            <div class="noticia-img">
                                <img src="{{ asset('storage/noticias/' . $noticia->imagem) }}" alt="{{ $noticia->alias }}">
                            </div>
                            
                            <div class="noticia-content">
                                {!! $noticia->descricao !!}
                            </div>
                            
                            <div class="noticia-link">
                                <h6>Referência</h6>
                                @isset($noticia->referencia)
                                <p>Referência: <a target="_blank" href="{{ $noticia->referencia }}">{{ $noticia->referencia }}</a></p>
                                @endif
                                
                                <br>
                                
                                @isset($noticia->linkExterno)
                                <p>Link Externo: <a target="_blank" href="{{ $noticia->linkExterno }}">{{ $noticia->linkExterno }}</a></p>
                                @endif
                            </div>
                            
                        </div>
                    </div>
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

@endsection