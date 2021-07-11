@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Atualizar Cargo</h3>
        </div>
        <div class="card-body">
            <form action="{{route('roles.update', $role->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                @method(' PUT')
                {{csrf_field()}}
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="name">Nome</label>
                            <input class='form-control' type="text" id="name" name="name" value="{{$role->name}}">
                            @if($errors->has('name'))
                            @foreach($errors->get('name') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-12">
                            <label for="description">Descrição</label>
                            <input class='form-control' type="text" id="description" name="description" value="{{$role->description}}">
                            @if($errors->has('description'))
                            @foreach($errors->get('description') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Atualizar">    
                </div>          
            </form>
        </div>
    </div>
</div>
@endsection