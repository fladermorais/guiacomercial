@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3>Lista de Categorias para Blog</h3>
            
            <form action="{{ route('categoriaBlog.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3 d-flex" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
            </form>
            
            @can('categoriaBlog.create')
            <a class="btn btn-default float-right" href="{{route('categoriaBlog.create')}}">Nova Categoria</a>
            @endcan
        </div>

        @if(isset($resultado))
            <div class="card-body flex-row">
                <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
                <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
                <a class="btn btn-success" href="{{ route('categoriaBlog.index') }}">Visualizar todos</a>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-flush ">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->titulo }}</td>
                        <td><span class="badge text-bg-{{ $categoria->status == "I" ? "danger" : "success"}} ">{{ $categoria->status }}</span></td>
                        <td>
                            @can('categoriaBlog.edit')
                            <a class="btn btn-primary btn-sm" href="{{route('categoriaBlog.edit', $categoria) }}" title="Editar"><i class="fas fa-edit"></i></a>
                            @endcan
                            {{-- <a class="btn btn-danger btn-sm" href="{{route('categoriaBlo.active', $categoria->id)}}" title="Desabilitar"><i class="fas fa-trash-alt"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection