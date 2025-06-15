@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar Cargo</h3>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('roles.update', $role->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                @method(' PUT')
                {{csrf_field()}}
                
                @include('Admin.roles._form')

                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Atualizar">    
                </div>          
            </form>
        </div>
    </div>
</div>
@endsection