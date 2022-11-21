<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                <h6 class="brand-text">JCMS</h6>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboards.index') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboards.create') }}">
                    <i data-feather="trending-up"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Analytics</span>
                </a>
            </li> --}}

            <li class=" navigation-header">
                <span data-i18n="Contents &amp; Pages">Data</span>
                <i data-feather="more-horizontal"></i>
            </li>

            @role('super admin')

            <li class="nav-item {{ (request()->segment(2) == 'journals' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('journals.index') }}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Berita">Data Jurnal</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ (request()->segment(2) == 'videos' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('videos.index') }}">
                    <i data-feather="clipboard"></i>
                    <span class="menu-title text-truncate" data-i18n="Video">Laporan</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item {{ (request()->segment(2) == 'pages' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('pages.index') }}">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="Page">Page</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'images' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('images.index') }}">
                    <i data-feather="layout"></i>
                    <span class="menu-title text-truncate" data-i18n="Image">Banner & Infografis</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'photos' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('photos.index') }}">
                    <i data-feather="image"></i>
                    <span class="menu-title text-truncate" data-i18n="Image">Photos</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'files' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('files.index') }}">
                    <i data-feather="database"></i>
                    <span class="menu-title text-truncate" data-i18n="File">File</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'services' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('services.index') }}">
                    <i data-feather="airplay"></i>
                    <span class="menu-title text-truncate" data-i18n="File">Layanan</span>
                </a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="server"></i><span class="menu-title text-truncate" data-i18n="Dashboards">PTSP</span></a>
                <ul class="menu-content">
                    <li class="nav-item {{ request()->routeIs('ptsp.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('ptsp.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Data Permohonan</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('data-ptsp') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('data-ptsp') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Data PTSP</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('categories-ptsp') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('categories-ptsp') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Kategori PTSP</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'officers' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('officers.index') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="File">Struktur Organisasi</span>
                </a>
            </li> --}}

            @endrole




            @role('super admin')
            <li class="navigation-header {{ (request()->segment(2) == 'settings' ? 'active' : '') }}">
                <span data-i18n="Setting">Setting</span>
                <i data-feather="more-horizontal"></i>
            </li>

            {{-- <li class="nav-item {{ (request()->segment(2) == 'menus' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('menus.index') }}">
                    <i data-feather="menu"></i>
                    <span class="menu-title text-truncate" data-i18n="Menu">Menu</span>
                </a>
            </li> --}}


            {{-- <li class="nav-item {{ (request()->segment(2) == 'authors' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('authors.index') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Users">Author</span>
                </a>
            </li> --}}

            <li class="nav-item {{ (request()->segment(2) == 'users' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Users">Users</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</div>
