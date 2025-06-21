@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Editar Notícia</h3>
        </div>
    </div>
    
    <form action="{{route('noticias.update', $info->id)}}" method="POST" id="formulario" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                <input class="btn btn-default btn-cadastro" type="submit" value="Atualizar">    
            </div>
        </div>
    </form>
</div>
@endsection