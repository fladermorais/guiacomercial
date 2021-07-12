@extends('layouts.argo')
@section('content')

<div class="col">
  <div class="card">
    <div class="card-header">
      <h3>Atualizar Cliente da Empresa</h3>
      <p class="flex-row">Empresa: <span>{{ $empresa->nome }}</span></p>
      <p class="flex-row">Usuário Atual: <span>{{ $empresa->users->name }}</span></p>
    </div>
    <form action="{{route('empresas.alterClientUpdate', $empresa->id)}}" method="post" id="formulario" enctype="multipart/form-data">
      {{csrf_field()}}
      @method('PUT')
      
      <div class="card-body">
        <div class="form-row">
          <div class="col-md-12">
            <label for="user_id">Novo Usuário * </label>
            <select required class="form-control" name="user_id" id="user_id">
              <option value="">Escolha um usuário</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      <div class="card-footer">
        <input class="btn btn-primary" type="submit" value="Atualizar">    
      </div>
    </form>
    
  </div>
</div>
@endsection