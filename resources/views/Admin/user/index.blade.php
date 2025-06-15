@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3 class="float-left">Lista de Usuários</h3>
            
            <form action="{{ route('usuarios.search')}}" method="POST" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                @csrf
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <input class="form-control" placeholder="Pesquisar" type="text" name="search">
                    </div>
                </div>
            </form>
            
            <a class="btn btn-default float-right" href="{{route('usuarios.create')}}">Novo Usuário</a>
        </div>
        
        @if(isset($resultado))
        <div class="card-body flex-row">
            <p><span>Resultado: </span> {{ $resultado['total'] }} Encontrados</p>
            <p><span>Palavra Pesquisada</span> {{ $resultado['palavra'] }}</p>
            <a class="btn btn-success" href="{{ route('usuarios.index') }}">Visualizar todos</a>
        </div>
        @endif
    </div>
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="alert alert-{{isset($user->deleted_at) ? 'danger' : ''}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(isset($user->deleted_at))
                            <a class="btn btn-warning btn-sm" href="{{route('usuarios.active', $user->id)}}" title="Ativar"><i class="fas fa-plus"></i></a>
                            @else
                            <a class="btn btn-default btn-sm" href="{{route('userRole.index', $user->id)}}" title="Funções"><i class="fas fa-tag"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{route('usuarios.edit', $user->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="{{route('usuarios.delete', $user->id)}}" title="Deletar"><i class="fas fa-trash-alt"></i></a>
                            @endif
                            {{-- <a class="btn btn-warning btn-sm" href="{{route('impersonate', $user->id)}}" title="Impersonate"><i class="fas fa-eye"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection