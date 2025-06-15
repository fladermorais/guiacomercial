@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="float-left">Cargos</h3>
            <a class="btn btn-default" href="{{route('roles.create')}}">Novo Cargo</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $r)
                    <tr>
                        <td>{{$r->id}}</td>
                        <td>{{$r->name}}</td>
                        <td>{{$r->description}}</td>
                        <td>
                            @if($r->id == 1)
                            
                            @else
                            <a class="btn btn-default btn-sm" href="{{route('rolePermission.index', $r->id)}}" title="Permissões"><i class="fas fa-tag"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{route('roles.edit', $r->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            {{-- <a title="Permissões" class="btn btn-success btn-sm" href="{{route('cargos.permissions',$r->id)}}"><i class="fas fa-network-wired"></i></a> --}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection