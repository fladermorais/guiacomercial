@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card">
        <div class="card-header">
            <a class="btn btn-default float-right" href="{{route('permissions.create')}}">Nova Permissão</a>
            <h3>Permissões</h3>
        </div>
        
        <div class="card-body">
            
            
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Descrição</th>
                        <th>Rota</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $p)
                    <tr>
                        <td>{{$p->description}}</td>
                        <td>{{$p->name}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('permissions.edit', $p->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection