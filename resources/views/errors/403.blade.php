@php
$dados = DB::table('sites')->first();
@endphp
@extends('layouts.site')
@section('content')
<section class="container erro">
  <div class="erro-box">
    <h1> 403 </h1>
    <h2>Você não tem permissão para acessar esta página!</h2>
    <a class="btn btn-default" href="{{ route('logado') }}">Voltar</a>
  </div>
</section>

@endsection