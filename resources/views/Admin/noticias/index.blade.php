@extends('layouts.argo')
@section('content')
<div class="col">    
    <div class="card mb-4">
        <div class="card-header flex-row">
            <h3>Notícias</h3>
            @can('noticias.create')
            <a class="btn btn-default" href="{{route('noticias.create')}}">Nova Notícia</a>
            @endcan
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-flush">
                <thead class="thead-dark">
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Visualizações</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->titulo }}</td>
                        <td>{{ $noticia->categorias->titulo }}</td>
                        <td>{{ $noticia->views }}</td>
                        <td>{{ $noticia->status }}</td>
                        <td>
                            @can('noticias.edit')
                            <a class="btn btn-primary btn-sm" href="{{route('noticias.edit', $noticia->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                            @endcan
                            
                            @can('noticias.delete')
                            <a class="btn btn-danger btn-sm" href="{{route('noticias.destroy', $noticia->id)}}" title="Excluir"><i class="fas fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Nenhuma Notícia até o momento</td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection