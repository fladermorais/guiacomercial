@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar SubCategoria</h3>
        </div>
    </div>
    <div class="card">
        <form action="{{route('subCategorias.update', $categoria->id)}}" method="post" id="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('Admin.subcategorias._form')
            </div>
            
            <div class="card-footer">
                <button class="btn btn-default" type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection