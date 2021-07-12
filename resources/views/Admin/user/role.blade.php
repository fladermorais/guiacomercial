@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Funções para {{$user->name}}</h3>
        </div>
        
        <div class="card-body">
            
            <form class="row" action="{{route('userRole.store',$user->id)}}" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <select name="role_id" class="form-control">
                        @foreach($roles as $valor)
                        <option value="{{$valor->id}}">{{$valor->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4">
                    <button class="btn btn-default float-right">Adicionar</button>
                </div>
            </form>
            
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Função</th>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->roles as $papel)
                        <tr>
                            <td>{{ $papel->name }}</td>
                            <td>{{ $papel->description }}</td>
                            <td>
                                <form action="{{route('userRole.delete',[$user->id,$papel->id])}}" method="post">
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
</div>

@endsection
