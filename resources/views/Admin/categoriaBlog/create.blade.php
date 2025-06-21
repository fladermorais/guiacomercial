@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Cadastrar Categoria - Blog</h3>
        </div>
    </div>

    <div class="card">
        <form action="{{route('categoriaBlog.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">  
                @include('Admin.categoriaBlog._form')
            </div>
            
            <div class="card-footer">
                <button class="btn btn-default" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection