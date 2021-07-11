@php
$dados = DB::table('sites')->first();
@endphp
@extends('layouts.site')
@section('content')

<section id="login-reg">
    <div class="container">
        <div class="col-md-8 col-sm-12">
            {{-- <div class="col-md-6 col-sm-12 col-sm-offset-3"> --}}
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login</h3>
                            <p>Faça seu logim e tenha acesso ao painel administrativo</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-key"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" method="POST" class="login-form" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" aria-describedby="basic-addon1">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                <input type="password" class="form-control" placeholder="Senha" name="password" aria-describedby="basic-addon1">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn">Entrar!</button>
                            
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    
                                    @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        Esqueci minha senha
                                    </a>
                                    @endif
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-4 preco-titulo">
                <h4>Ainda não tem cadastro?</h4>
            </div>
            <hr>
            <div class="col-md-4 preco">
                <div class="preco-topo">
                    <h4>Entre em contato com nossa equipe!</h4>
                    <p class="flex-row">Telefone: <a href="tel:035984012190">035 984012190</a></p>
                    <p class="flex-row">E-mail: <a href="mailto:contato@fladermorais.com.br">contato@fladermorais.com.br</a></p>
                    <p>Tenha direito aos seguintes itens</p>
                </div>
                <div class="preco-detalhes">
                    <ul>
                        <li><strong>Anúncio</strong> 01</li>
                        <li><strong>Imagens</strong> 02</li>
                        <li><strong>Links Sociais</strong>Sim</li>
                        <li><strong>Dados de Contato</strong>Sim</li>
                        <li><strong>Painel Administrativo</strong>Sim</li>
                    </ul>
                    
                    {{-- <a href="{{ route('register') }}" class="btn btn-default btn-sm">Criar Conta</a> --}}
                </div>
            </div>
        </div>
    </div>        
</section>



@endsection
