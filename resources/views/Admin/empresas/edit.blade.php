@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar Empresa</h3>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('empresas.update', $empresa->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                
                @include('Admin.empresas._form')

                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Atualizar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection