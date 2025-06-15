@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Cadastrar Usuário</h3>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('usuarios.store')}}" method="post" id="formulario">
                {{csrf_field()}}
                
                @include('Admin.user._form')
                
                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Cadastrar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection