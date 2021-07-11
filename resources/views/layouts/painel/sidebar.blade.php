<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            <br>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu de Navegação</li>
            <li>
                <a href="{{route('usuarios.index')}}">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Banners</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-blue"></i> <span>Empresa</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-truck-moving"></i> <span>Produtos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-sitemap"></i> Categorias</a></li>
                    <li><a href=""><i class="fa fa-times-circle"></i> Produtos</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o text-purple"></i> <span>Notícias</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Configurações</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('roles.index') }}"><i class="fa fa-sitemap"></i> Cargos</a></li>
                    <li><a href="{{ route('permissions.index') }}"><i class="fa fa-sitemap"></i> Permissões</a></li>
                    <li><a href=""><i class="fa fa-hard-hat"></i>Contato</a></li>
                    <li><a href=""><i class="fa fa-thumbs-up"></i>News Letter</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
