@php
$dados = DB::table('sites')->first();
@endphp
@extends('layouts.site')
@section('content')



<section id="login-reg">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-sm-offset-3">
            <div class="form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Registre-se</h3>
                        <p>Após o registro, você terá direito a criação de um anúncio de forma gratuita!</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" method="POST" class="login-form" action="{{ route('register') }}" >
                        @csrf
                        
                        <div class="input-group form-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" aria-describedby="basic-addon1" placeholder="Digite seu nome">
                            
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        
                        <div class="input-group form-group">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Digite seu E-mail">
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        
                        <div class="input-group form-group">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-unlock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="input-group form-group">
                            <span class="input-group-addon" id="basic-addon4"><i class="fa fa-unlock"></i></span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmação de Senha">
                        </div>
                        
                        {{-- <div class="text-danger">
                            @error('grecaptcha')
                            <span>{{$message}}</span>
                            @enderror
                        </div> --}}
                        @php
                        $a = rand(0,20);
                        $b = rand(0,20);
                        @endphp
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="teste" class="col-md-4 col-form-label text-md-right">Verificar</label>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <label for="">{{ $a ." + " . $b}}</label>
                                <input id="valorA" type="hidden" class="form-control" name="valorA" required value="{{$a}}" >
                                <input id="valorB" type="hidden" class="form-control" name="valorB" required value="{{$b}}" >                                
                                <input id="valorC" type="text" class="form-control" name="valorC" required >
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
