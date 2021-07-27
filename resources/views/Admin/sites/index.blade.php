@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card">
        <div class="card-header">
            <h3 class="float-left">Lista de Categorias</h3>
            <a class="btn btn-default float-right" href="{{route('categorias.create')}}">Nova Categoria</a>
        </div>
        
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Link</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td id="imagem"><img src="{{asset('storage/categorias/'.$categoria->img)}}" alt=""></td>
                        <td>{{$categoria->nome}}</td>
                        <td><a target="_blank" href="{{ url('/').'/'. $categoria->alias }} ">Visualizar</a></td>
                        <td class="badge badge-{{ $categoria->status == "nao" ? "danger" : ""}} " >{{$categoria->status}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('categorias.edit', $categoria->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="{{route('categorias.active', $categoria->id)}}" title="Desabilitar"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection