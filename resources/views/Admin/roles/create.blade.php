@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Cadastrar Cargo</h3>
        </div>
        <div class="card-body">
            <form action="{{route('roles.store')}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="name">Nome *</label>
                            <input required class='form-control' type="text" id="name" name="name" value="{{old('name')}}">
                            @if($errors->has('name'))
                            @foreach($errors->get('name') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-12">
                            <label for="description">Descrição *</label>
                            <input required class='form-control' type="text" id="description" name="description" value="{{old('description')}}">
                            @if($errors->has('description'))
                            @foreach($errors->get('description') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary btn-cadastro" type="submit" value="Cadastrar">    
                </div>      
            </form>
        </div>
    </div>
</div>
@endsection