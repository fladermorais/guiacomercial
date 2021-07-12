@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Cadastrar SubCategoria</h3>
        </div>
        <div class="card-body">
            <form action="{{route('subCategorias.store')}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                
                @include('Admin.subcategorias._form')
                
                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Cadastrar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection