@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Imagens do anúncio {{ $empresa->nome }}</h3>
        </div>
    </div>
    
    <div class="card mb-4">
        <form action="{{ route('galeria.store', $empresa) }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="images">Selecione as imagens</label>
                        <input type="file" class="form-control" name="images[]" id="images" multiple>
                        @if($errors->has('images'))
                        @foreach($errors->get('images') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <h4>Lista de Imagens</h4>
        </div>
        
        <div class="body">
            <div class="row">
                @foreach($empresa->galerias as $foto)
                <div class="col-md-2 img-galeria">
                    <img src="{{ asset('storage/galeria/' . $foto->path) }}" alt="{{ $foto->titulo }}">
                    <form action="{{  route('galeria.destroy', $foto->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return(confirm('Deseja realmente excluir esta foto?'))" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
@endsection