@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar Usuário</h3>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('usuarios.update', $user->id)}}" method="post" id="formulario">
                {{csrf_field()}}
                
                @include('Admin.user._form')
                
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Atualizar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection