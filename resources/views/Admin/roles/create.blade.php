@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Cadastrar Cargo</h3>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('roles.store')}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                
                @include('Admin.roles._form')
                
                <div class="card-footer">
                    <input class="btn btn-primary btn-cadastro" type="submit" value="Cadastrar">    
                </div>      
            </form>
        </div>
    </div>
</div>
@endsection