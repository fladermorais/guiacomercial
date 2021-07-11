@extends('layouts.argo')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">
            <h3 >Lista de Permissões para {{$role->name}}</h3>
        </div>
        <div class="card-body">
            <form class="row" action="{{route('rolePermission.store',$role->id)}}" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <select class="form-control" name="permission_id">
                        <option value="">Escolha uma permissão</option>
                        @foreach($permissions as $value)
                        <option value="{{$value->id}}">{!! $value->description !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-default">Adicionar</button>
                </div>
            </form>
        </div>
        
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        
                        <th>Descrição</th>
                        <th>Permissão</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($role->permissions as $permission)
                    <tr>
                        <td>{{ $permission->description }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            
                            <form action="{{route('rolePermission.delete',[$role->id, $permission->id])}}" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button title="Deletar" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>
</div>

@endsection