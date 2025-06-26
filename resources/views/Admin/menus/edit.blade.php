@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Atualizar item de menu</h3>
        </div>
    </div>
    <div class="card">
        <form action="{{route('menus.update', $info->id)}}" method="post" id="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('Admin.menus._form')
            </div>
            <div class="card-footer">
                <input class="btn btn-primary" type="submit" value="Atualizar">    
            </div>
        </form>
    </div>
</div>
@endsection