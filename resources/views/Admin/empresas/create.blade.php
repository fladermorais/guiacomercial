@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Cadastrar Categoria ( Itens com <b>*</b> são obrigatórios )</h3>
        </div>
        <div class="card-body">
            <form action="{{route('empresas.store')}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                
                @include('Admin.empresas._form')
                
                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Cadastrar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection