@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3>Lista de Itens de Menu</h3>
            
            {{-- <form action="{{ route('categorias.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3 d-flex" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
            </form> --}}
            @can('menus.create')
            <a class="btn btn-default float-right" href="{{route('menus.create')}}">Novo Menu</a>
            @endcan
        </div>

        @if(isset($resultado))
            <div class="card-body flex-row">
                <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
                <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
                <a class="btn btn-success" href="{{ route('categorias.index') }}">Visualizar todos</a>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th class="text-center">Exibir no Menu</th>
                        <th class="text-center">Exibir na Home</th>
                        <th class="text-center">Ordem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infos as $info)
                    <tr>
                        <td>{{ $info->alias}}</td>
                        <td>{{ $info->categorias->titulo }}</td>
                        <td class="text-center">{{ $info->exibe_menu }}</td>
                        <td class="text-center">{{ $info->exibe_home }}</td>
                        <td class="text-center">{{ $info->ordem}}</td>
                        <td class="d-flex">
                            @can('menus.edit')
                            <a class="btn btn-primary btn-sm" href="{{route('menus.edit', $info->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('menus.delete')
                            <form action="{{ route('menus.destroy', $info) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return(confirm('Deseja realmente remover este item?'))" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection