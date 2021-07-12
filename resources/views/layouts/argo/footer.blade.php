<footer class="footer pt-0">
  <div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6">
      <div class="copyright text-center  text-lg-left  text-muted">
        &copy; {{ date('Y', strtotime(now()))}} <a href="#" class="font-weight-bold ml-1" >Fladermorais</a>
      </div>
    </div>
    <div class="col-lg-6">
      <ul class="nav nav-footer justify-content-center justify-content-lg-end">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link" >Home</a>
        </li>
        @if( auth()->user())
        <li class="nav-item">
          <a href="{{ route('usuarios.edit', auth()->user()->id) }}" class="nav-link" >Meus Dados</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logoff
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</footer>