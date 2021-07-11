<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 block">
                <div class="footer-block">
                    <h4>Informações</h4>
                    <hr/>
                <p><a href="{{ route('sobre') }}">Quem Somos</a></p>
                <p><a href="{{ route('logado') }}">Fazer Login</a></p>
                <p><a href="{{ route('register') }}">Registrar-se</a></p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-12 block">
                {{-- <div class="footer-block">
                    <h4>Contato</h4>
                    <hr/>
                    <ul class="footer-links">
                        <li><a href="">TEste</a></li>
                    </ul>
                </div> --}}
            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-12 block">
                <div class="footer-block">
                    <ul class="footer-links">
                        
                    <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="logo" src="{{ asset('storage/logo/'.$dados->logo )}}" alt="">
                            </a>
                        
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    
    
</section>

<section id="bottom-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 btm-footer-links">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 copyright">
                Desenvolvido por <a target="_blank" href="http://www.fladermorais.com.br">FladerMorais</a>
            </div>
        </div>
    </div>
</section>
</html>