@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar Categoria</h3>
        </div>
    </div>
    <div class="card">
        <form action="{{route('categorias.update', $categoria->id)}}" method="post" id="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('Admin.categorias._form')
            </div>
            <div class="card-footer">
                <input class="btn btn-primary" type="submit" value="Atualizar">    
            </div>
        </form>
    </div>
</div>
@endsection