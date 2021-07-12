@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card">
        <div class="card-header flex-row">
            <h3 class="float-left">Lista de Categorias</h3>
            
            <form action="{{ route('categorias.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
            
            <a class="btn btn-default float-right" href="{{route('categorias.create')}}">Nova Categoria</a>
        </div>

        @if(isset($resultado))
            <div class="card-body flex-row">
                <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
                <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
                <a class="btn btn-success" href="{{ route('categorias.index') }}">Visualizar todos</a>
            </div>
        @endif

        <div class="card-body">
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
                        <td><a target="_blank" href="{{ url('/').'/categoria/'. $categoria->alias }} ">Visualizar</a></td>
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