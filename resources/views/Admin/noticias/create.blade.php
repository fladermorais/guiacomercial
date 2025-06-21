@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Cadastrar Notícia</h3>
        </div>
    </div>
    <form action="{{route('noticias.store')}}" method="POST" id="formulario" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-body"> 
                @include('Admin.noticias._form')
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h3>Informações de SEO</h3>
                @include('Admin._formSeo')
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-footer">
                <input class="btn btn-default btn-cadastro" type="submit" value="Cadastrar">    
            </div>
        </div>
    </form>
</div>

@endsection