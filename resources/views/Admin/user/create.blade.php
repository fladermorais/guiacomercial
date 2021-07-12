@extends('layouts.argo')
@section('content')
<div class="col">
    <div class="card">
        <div class="card-header">
            <h3>Cadastrar Usuário</h3>
        </div>
        <div class="card-body">
            <form action="{{route('usuarios.store')}}" method="post" id="formulario">
                {{csrf_field()}}
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="name">Nome * </label><br>
                            <input required class='form-control' type="text" id="name" name="name" value="{{old('name')}}">
                            @if($errors->has('name'))
                            @foreach($errors->get('name') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <input class='form-control' type="text" id="email" name="email" value="{{old('email')}}">
                            @if($errors->has('email'))
                            @foreach($errors->get('email') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <label for="password">Senha</label>
                            <input required class='form-control' type="password" id="password" name="password" value="{{old('password')}}">
                            @if($errors->has('password'))
                            @foreach($errors->get('password') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <label for="password_confirmation">Confirmar Senha:</label>
                            <input class='form-control' type="password" id="password_confirmation" name="password_confirmation">
                            @if($errors->has('password_confirmation'))
                            @foreach($errors->get('password_confirmation') as $e)
                            {{$e}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <input class="btn btn-default" type="submit" value="Cadastrar">    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection