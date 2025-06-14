@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3 class="float-left">Lista de SubCategorias</h3>
            
            <form action="{{ route('subCategorias.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
            </form>
            
            <a class="btn btn-default float-right" href="{{route('subCategorias.create')}}">Nova SubCategoria</a>
        </div>
        
        @if(isset($resultado))
        <div class="card-body flex-row">
            <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
            <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
            <a class="btn btn-success" href="{{ route('subCategorias.index') }}">Visualizar todos</a>
        </div>
        @endif
    </div>
    
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Link</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{$categoria->nome}}</td>
                        <td>{{$categoria->categorias->nome }}</td>
                        <td><a target="_blank" href="{{ url('/').'/subcategoria/'. $categoria->alias }} ">Visualizar</a></td>
                        <td class="badge badge-{{ $categoria->status == "nao" ? "danger" : ""}} " >{{$categoria->status}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('subCategorias.edit', $categoria->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="{{route('subCategorias.active', $categoria->id)}}" title="Desabilitar"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $categorias->links() }}
        </div>
    </div>
</div>
@endsection