@php
$dados = DB::table('sites')->first();
@endphp
@extends('layouts.site')
@section('content')
<section class="container erro">
  <div class="erro-box">
    <h1> 404 </h1>
    <h2>Essa página não existe</h2>
    <a class="btn btn-default" href="{{ route('home')}}">Ir para a página inicial</a>
  </div>
</section>

@endsection