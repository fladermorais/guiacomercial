@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Atualizar Categoria</h3>
        </div>
        <div class="card-body">
            <form action="{{route('categorias.update', $categoria->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-8">
                            <label for="nome">Nome * </label><br>
                            <input required class='form-control' type="text" id="nome" name="nome" value="{{ $categoria->nome }}">
                            @if($errors->has('nome'))
                            @foreach($errors->get('nome') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <label for="imagem">Imagem</label>
                            <input class='form-control' type="file" id="imagem" name="imagem">
                            @if($errors->has('imagem'))
                            @foreach($errors->get('imagem') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="descricao">Descrição</label>
                            <input required class='form-control' type="text" id="descricao" name="descricao" value="{{ $categoria->descricao }}">
                            @if($errors->has('descricao'))
                            @foreach($errors->get('descricao') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Atualizar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection