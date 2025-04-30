@extends('layouts.site')
@section('content')

<section id="top_banner">
    <div class="banner">
        <div class="inner text-center">
            <h2>{{ $anuncio->nome }}</h2>
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

<section id="about-page-section-3">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7 text-align anuncio">
                <div class="section-heading">
                    <h2>{{ $anuncio->nome }}</h2>
                </div>
                <p> {!! $anuncio->descricao !!}</p>
                
                <hr>
                <h4>Contato:</h4>
                @if($anuncio->telefone)
                <p> <i class="fa fa-phone"></i><a href="tel:{{ $anuncio->telefone }}">{{ $anuncio->telefone }}</a></p>
                @endif
                @if($anuncio->whatsapp)
                <p> <i class="fa fa-mobile"></i> <a target="_blank" href="https://api.whatsapp.com/send?phone=55{{ $anuncio->whatsapp }}">{{ $anuncio->whatsapp }}</a></p>
                @endif
                @if($anuncio->email)
                <p> <i class="fa fa-envelope"></i> <a target="_blank" href="mailto:{{ $anuncio->email }}">{{ $anuncio->email }}</a></p>
                @endif
                
                <hr>
                @if($anuncio->segunda || $anuncio->terca || $anuncio->quarta || $anuncio->quinta || $anuncio->sexta || $anuncio->sabado || $anuncio->domingo)
                <div class="row">
                    <div class="col-md-6">
                        <h4>Horário de Atendimento</h4>
                        <p class="flex-row2"><span>Segunda-Feira </span> @if($anuncio->segunda) {{ $anuncio->segunda}} às {{ $anuncio->segunda_final }} @endif </p>
                        <p class="flex-row2"><span>Terça-Feira </span> @if($anuncio->terca) {{ $anuncio->terca}} às {{ $anuncio->terca_final }} @endif </p>
                        <p class="flex-row2"><span>Quarta-Feira </span> @if($anuncio->quarta) {{ $anuncio->quarta}} às {{ $anuncio->quarta_final }} @endif </p>
                        <p class="flex-row2"><span>Quinta-Feira </span> @if($anuncio->quinta) {{ $anuncio->quinta}} às {{ $anuncio->quinta_final }} @endif </p>
                        <p class="flex-row2"><span>Sexta-Feira </span> @if($anuncio->sexta) {{ $anuncio->sexta}} às {{ $anuncio->sexta_final }} @endif </p>
                        <p class="flex-row2"><span>Sábado: </span> @if($anuncio->sabado) {{ $anuncio->sabado}} às {{ $anuncio->sabado_final }} @endif </p>
                        <p class="flex-row2"><span>Domingo: </span> @if($anuncio->domingo) {{ $anuncio->domingo}} às {{ $anuncio->domingo_final }} @endif </p>
                        <p class="flex-row2"><span>Feriados: </span> @if($anuncio->feriado) {{ $anuncio->feriado}} às {{ $anuncio->feriado_final }} @endif </p>
                    </div>
                </div>
                <hr>
                @endif
                
                
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
            <img height="" width="auto" src="{{ asset('/storage/logo/'.$anuncio->img ) }}" class="attachment-full img-responsive" alt="{{ $anuncio->nome }}">
            </div>
        </div>
    </div>
</section>

@if($anuncio->endereco || $anuncio->facebook)
<section id="features-page">
    <div class="subsection3" style=" overflow-x:hidden;">
        <h1 class="titulo">Localização: </h1>            
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 left-section">
                    <div class="subfeature">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            @if($anuncio->endereco)
                            <div class="featureblock">
                                <div class="col-md-2 col-xs-2 icon"><i class="fa fa-location-arrow"></i></div>
                                <div class="col-md-10 col-xs-10">
                                    <p>   {{ $anuncio->endereco }}</p>
                                    
                                </div>
                            </div>
                            @endif
                            
                            @if($anuncio->bairro)
                            <div class="featureblock">
                                <div class="col-md-2 col-xs-2 icon"><i class="fa fa-location-arrow"></i> </div>
                                <div class="col-md-10 col-xs-10">
                                    <p> {{ $anuncio->bairro }}</p>
                                    
                                </div>
                            </div>
                            @endif
                            
                            @if($anuncio->cidade)
                            <div class="featureblock">
                                <div class="col-md-2 col-xs-2 icon"><i class="fa fa-location-arrow"></i></div>
                                <div class="col-md-10 col-xs-10">
                                    <p>  {{ $anuncio->cidade }} @if($anuncio->estado) / {{ $anuncio->estado }} @endif</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($anuncio->site || $anuncio->facebook || $anuncio->instagran)
                <div class="col-md-6 col-sm-6 col-xs-12 right-section right-background">
                    <div class="subfeature">
                        <div class="featureblock">
                            {{-- <div class="col-md-2 col-xs-2 icon"></div> --}}
                            <div class="col-md-12 col-xs-12">
                                @if($anuncio->site)
                                <p> <i class="fa fa-support"></i> <a target="_blank" href="http://{{ $anuncio->site }}">{{ $anuncio->site }}</a></p>
                                @endif
                                @if($anuncio->facebook)
                                <p> <i class="fa fa-facebook"></i> <a target="_blank" href="https://www.facebook.com{{ $anuncio->facebook }}">{{ $anuncio->facebook }}</a></p>
                                @endif
                                @if($anuncio->instagran)
                                <p> <i class="fa fa-instagram"></i> <a target="_blank" href="https://www.instagram.com{{ $anuncio->instagran }}">{{ $anuncio->instagran }}</a></p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                @endif
                
            </div>
        </div>
    </div>
    
</section>
@endif


<section id="about-page-section-3">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <img height="" width="auto" src="{{ asset('/storage/imagem/'.$anuncio->foto ) }}" class="attachment-full img-responsive" alt="{{ $anuncio->nome }}">
        </div>
        
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-align">

            <div class="section-heading">
                <div class="like">
                    <h4 class="flex-row"> <i class="fa fa-eye"></i>Visualizações <span>{{ $anuncio->view }}</span></h4>
                </div>
            </div>

            <div class="section-heading">
                <div class="like">
                    <h4 class="flex-row"> <i class="fa fa-thumbs-up"></i>Curtidas <span>{{ $anuncio->like }}</span></h4>
                </div>
            </div>
            
            <div class="section-heading curtir">
                
                <div class="like">
                    {{-- <h4 class="flex-row"> <i class="fa fa-heart"></i> Curtir </h4> --}}
                    {{-- <p><a href="{{ route('like', $anuncio->id )}}" class="btn btn-default flex-row"><i class="fa fa-plus"></i>   Gostei </a></p> --}}
                    <p><a href="{{ route('like', $anuncio->id )}}" class="btn btn-default flex-row"> Gostei </a></p>
                </div>
            </div>
            
        </div>
        
    </div>
</section>

@include('Site._pesquisa')

@endsection