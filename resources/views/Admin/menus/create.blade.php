@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Cadastrar Item de Menu</h3>
        </div>
    </div>

    <div class="card">
        <form action="{{route('menus.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">  
                @include('Admin.menus._form')
            </div>
            
            <div class="card-footer">
                <button class="btn btn-default" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection