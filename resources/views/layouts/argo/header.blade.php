<nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-success border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav align-items-center  ml-md-auto ">
        <li class="nav-item d-xl-none">
          <!-- Sidenav toggler -->
          <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </li>
        
        @if(session('impersonate'))
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="{{ route('impersonate.destroy')}}">
            <i class="fa fa-undo"></i>
            Voltar p/ Admin
          </a>
        </li>
        @endif
        
        @if(isset(auth()->user()->id))
        <li class="nav-item dropdown">
          <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-ban"></i>
            Logoff
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link" href="{{route('usuarios.edit', auth()->user()->id)}}">
            <i class="fa fa-user"></i>
            Meus Dados
          </a>
        </li>
        @endif
        
        @if(isset(session('ramal')->accountcode))
        <li class="nav-item dropdown">
          <a class="btn btn-danger btn-flat" href="{{ route('logout.user')}}">
            <i class="fa fa-user"></i>
            Sair
          </a>
        </li>
        @endif
      </ul>
      
      <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <div class="media-body  ml-2  d-none d-lg-block">
                @if(isset(auth()->user()->name))
                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                @endif
                @if(isset(session('ramal')->alias_name ))
                <span class="hidden-xs">{{session('ramal')->alias_name}}</span>
                @endif
              </div>
            </div>
          </a>
        </li>
      </ul>
    </div>
    
  </nav>