@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3 class="float-left">Lista de Empresas</h3>
            @if(count($empresa) > 1 || auth()->user()->quantidade > 1)
            <form action="{{ route('empresas.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
            </form>
            @endif
            @if($criar == 1)
            <a class="btn btn-default float-right" href="{{route('empresas.create')}}">Nova Empresa</a>
            @endif
        </div>
        
        @if(isset($resultado))
        <div class="card-body flex-row">
            <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
            <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
            <a class="btn btn-success" href="{{ route('empresas.index') }}">Visualizar todos</a>
        </div>
        @endif
    </div>
    
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Visualizações</th>
                        <th>Curtidas</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresa as $emp)
                    <tr>
                        <td id="imagem"><img src="{{asset('storage/logo/'.$emp->img)}}" alt=""></td>
                        <td>{{ $emp->nome }}</td>
                        <td>{{ (isset($emp->subcategoria_id) ? $emp->subcategorias->nome : "-" ) }}</td>
                        <td>{{ $emp->view }}</td>
                        <td>{{ $emp->like }}</td>
                        <td>{{ $emp->users->name }}</td>
                        <td class="action flex-row">
                            @can('galeria.index')
                            <a class="btn btn-info btn-sm" href="{{route('galeria.show', $emp)}}" title="Galeria"><i class="fas fa-image"></i></a>
                            @endcan
                            <a class="btn btn-primary btn-sm" href="{{route('empresas.edit', $emp->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            <form action="{{route('empresas.delete', $emp->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o Anúncio?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            
                            @can('empresas.alterClient')
                            <a class="btn btn-default btn-sm" href="{{route('empresas.alterClient', $emp->id)}}" title="Alterar Cliente"><i class="fas fa-edit"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div>
            {{ $empresa->links() }}
        </div>
    </div>
</div>
@endsection