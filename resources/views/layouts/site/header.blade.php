<header>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home')}}">
                        <img class="logo" src="{{ asset('storage/logo/'.$dados->logo )}}" alt="">
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="{{ route('home')}}">Home</a></li>
                        <li class=""><a href="{{ route('categorias')}}">Categorias</a></li>
                        <li class=""><a href="{{ route('logado')}}">Área do Anunciante</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>