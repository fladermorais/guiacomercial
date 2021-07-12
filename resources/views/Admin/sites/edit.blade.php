@extends('layouts.argo')
@section('content')

<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Atualizar Categoria</h3>
        </div>
        <div class="card-body">
            <form action="{{route('sites.update', $dados->id)}}" method="post" id="formulario" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-8">
                            <label for="nome">Nome do site </label><br>
                            <input required class='form-control' type="text" id="nome" name="nome" value="{{ $dados->nome }}">
                            @if($errors->has('nome'))
                            @foreach($errors->get('nome') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <label for="logo">Logo</label>
                            <input class='form-control' type="file" id="logo" name="logo">
                            @if($errors->has('logo'))
                            @foreach($errors->get('logo') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="descricao">Quem Somos</label>
                            <textarea class="form-control" name="quem_somos" id="descricao" cols="30" rows="5">{{ $dados->quem_somos }}</textarea>
                            {{-- <input required class='form-control' type="text" id="quem_somos" name="quem_somos" value="{{ $dados->quem_somos }}"> --}}
                            @if($errors->has('quem_somos'))
                            @foreach($errors->get('quem_somos') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <hr>
                    <div class="form-row">
                        <h3>Mensagem da Home</h3>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="titulo">Título da Mensagem </label><br>
                            <input required class='form-control' type="text" id="titulo" name="titulo" value="{{ $dados->titulo }}">
                            @if($errors->has('titulo'))
                            @foreach($errors->get('titulo') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-12">
                            <label for="mensagem">Mensagem</label>
                            <textarea class='form-control' id="mensagem" name="mensagem" cols="30" rows="5">{{ $dados->mensagem }}</textarea>
                            @if($errors->has('mensagem'))
                            @foreach($errors->get('mensagem') as $e)
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