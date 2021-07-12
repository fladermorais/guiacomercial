@extends('layouts.site')
@section('content')

<section id="login-reg">
    <div class="">
    <form role="form" action="{{ route('search')}}" method="post" class="login-form pesquisar">
        @csrf
            <h3 class="text-center">O que você deseja encontrar! </h3>
            <div class="col-md-10">
                <div class="input-group form-group form-busca">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" name="busca" class="form-control busca" placeholder="Digite o que procura" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Pesquisar</button>    
            </div>
            <div class="row espacamento">
                
            </div>
        </form>
        
    </div>
</section>

<section id="faq">
    <div class="titlebar">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center">
                    <div class="col-md-12 col-xs-12">
                        <h2>Resultado da <span>Pesquisa</span></h2>
                        <div class="flex-row">
                            <p class="subheading">Palavra chave: <span>{{ $result['palavra'] }}</span></p>
                            <p class="subheading">Resultado da busca: <span>{{ $result['total'] }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($resultados as $anuncio)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="rich-accordian">
                    <div class="panel-group" id="accordion{{$anuncio->id}}" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne-{{$anuncio->id}}">
                                <h4 class="panel-title">
                                <div class="resultado_imagem"><img src="{{ asset('storage/logo/'.$anuncio->img)}}" alt="{{ $anuncio->nome }}"> </div>
                                    <a role="button" data-toggle="collapse" data-parent="#accordion{{$anuncio->id}}" href="#collapseOne{{$anuncio->id}}" aria-expanded="true" aria-controls="collapseOne{{$anuncio->id}}">
                                        {{ $anuncio->nome }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne{{$anuncio->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-{{$anuncio->id}}">
                                <div class="panel-body">
                                    {!! Str::limit($anuncio->descricao, 100) !!}
                                </div>

                                <div class="panel-footer">
                                    <a class="btn btn-default right" href="{{ route('anuncio', $anuncio->alias) }}">Detalhes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection