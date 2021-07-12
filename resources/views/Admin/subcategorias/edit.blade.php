@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Atualizar SubCategoria</h3>
        </div>
        <div class="card-body">
            <form action="{{route('subCategorias.update', $categoria->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                
                @include('Admin.subcategorias._form')
                
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Atualizar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection