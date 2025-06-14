<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
  <div class="container-fluid py-1 px-3">
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
      <ul class="navbar-nav  justify-content-end navbar-personalizado flex-row">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>

        @if(session('impersonate'))
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="{{ route('impersonate.destroy')}}">
            <i class="fa fa-undo"></i>
            Voltar p/ Admin
          </a>
        </li>
        @endif

        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0">
            @if(isset(auth()->user()->name))
            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
            @endif
          </a>
        </li>
        
        <li class="nav-item d-flex align-items-center">
          <a class="nav-link text-white font-weight-bold px-0" href="{{route('usuarios.edit', auth()->user()->id)}}">
            <i class="fa fa-user me-sm-1"></i>
            Meus Dados
          </a>
        </li>

        <li class="nav-item d-flex align-items-center">
          <a class="nav-link text-white font-weight-bold px-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-user me-sm-1"></i>
            Logoff
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
            </form>
          </a>
        </li>
      </ul>

    </div>
  </div>
</nav>