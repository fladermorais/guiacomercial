@extends('layouts.site')
@section('content')

<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="section-heading text-center">
                <div class="col-md-12 col-xs-12">
                    <h1>Conheça um pouco <span>Sobre nós</span></h1>
                    <div class="subheading">{!! $sobre->quem_somos !!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection