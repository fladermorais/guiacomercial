@php
use App\Models\Site;
$site = Site::first();
@endphp

<nav class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('/storage/logo/' . $site->logo)}}" class="navbar-brand-img" alt="...">
      
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    @canany(['categorias.index', 'subCategorias.index', 'empresas.index'])
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted"><span class="docs-normal">Anúncios</span></h6>
    @endcanany
    <ul class="navbar-nav">
      @can('categorias.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "categorias" ? "active" : ""}}" href="{{ route('categorias.index') }}"><i class="fa fa-list text-default"></i><span class="nav-link-text">Categorias</span></a></li>
      @endcan
      @can('subCategorias.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "subcategorias" ? "active" : ""}}" href="{{ route('subCategorias.index') }}"><i class="fa fa-stream text-default"></i><span class="nav-link-text">Sub Categorias</span></a></li>
      @endcan
      
      @can('empresas.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "empresas" ? "active" : ""}}" href="{{ route('empresas.index') }}"><i class="fa fa-bullhorn text-default"></i><span class="nav-link-text">
        @if(auth()->user()->existRole('Administrador'))
        Meus Anúncios
        @else
        Meu Anúncio
        @endif
      </span></a></li>
      @endcan
    </ul>
    
    @canany(['categoriaBlog.index'])
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted"><span class="docs-normal">Blog</span></h6>
    @endcanany
    <!-- Nav items -->
    <ul class="navbar-nav">
      @can('categoriaBlog.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "categoriaBlog" ? "active" : ""}}" href="{{ route('categoriaBlog.index') }}"><i class="fa fa-list text-default"></i><span class="nav-link-text">Categorias</span></a></li>
      @endcan
      @can('noticias.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "noticias" ? "active" : ""}}" href="{{ route('noticias.index') }}"><i class="fa fa-list text-default"></i><span class="nav-link-text">Notícias</span></a></li>
      @endcan
    </ul>

    @canany(['administradores.indexAdmin','usuarios.index'])
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted"><span class="docs-normal">Usuários</span></h6>
    @endcanany
    <!-- Nav items -->
    <ul class="navbar-nav">
      @can('usuarios.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "usuarios" ? "active" : ""}}" href="{{ route('usuarios.index') }}"><i class="fa fa-users text-default"></i><span class="nav-link-text">Clientes</span></a></li>
      @endcan
    </ul>
    
    @canany(['roles.index', 'permissions.index'])
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted"><span class="docs-normal">Configurações</span></h6>
    @endcanany
    <ul class="navbar-nav">
      @can('roles.index')
      <li class="nav-item"><a class="nav-link {{ ($rota[0] == "roles" || $rota[0] == "rolePermission") ? "active" : ""}}" href="{{ route('roles.index') }}"><i class="fa fa-user-tag text-default"></i><span class="nav-link-text">Cargos</span></a></li>
      @endcan
      {{-- @can('permissions.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "permissions" ? "active" : ""}}" href="{{ route('permissions.index') }}"><i class="fa fa-sitemap text-default"></i><span class="nav-link-text">Permissão</span></a></li>
      @endcan --}}
      @can('sites.index')
      <li class="nav-item"><a class="nav-link {{ $rota[0] == "sites" ? "active" : ""}}" href="{{ route('sites.index') }}"><i class="fa fa-info text-default"></i><span class="nav-link-text">Info do Site</span></a></li>
      @endcan
    </ul>
    
  </div>
</nav>