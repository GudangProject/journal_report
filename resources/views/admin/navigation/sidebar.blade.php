<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                <span class="brand-logo">
                    <img src="{{ asset('assets/images/favicon.png') }}" alt="">
                </span>
                <h2 class="brand-text">SULSEL</h2>
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

            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboards.create') }}">
                    <i data-feather="trending-up"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Analytics</span>
                </a>
            </li>

            <li class=" navigation-header">
                <span data-i18n="Contents &amp; Pages">Contents &amp; Pages</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'posts' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('posts.index') }}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Berita">Berita</span>
                </a>
            </li>

            @unlessrole('admin daerah')

            <li class="nav-item {{ (request()->segment(2) == 'videos' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('videos.index') }}">
                    <i data-feather="video"></i>
                    <span class="menu-title text-truncate" data-i18n="Video">Video & Podcast</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'pages' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('pages.index') }}">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="Page">Page</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'images' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('images.index') }}">
                    <i data-feather="image"></i>
                    <span class="menu-title text-truncate" data-i18n="Image">Image</span>
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

            <li class="navigation-header {{ (request()->segment(2) == 'settings' ? 'active' : '') }}">
                <span data-i18n="Setting">Integrasi</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ (request()->segment(2) == 'integrations' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('integrations.index') }}">
                    <i data-feather="cpu"></i>
                    <span class="menu-title text-truncate" data-i18n="Menu">Integrasi</span>
                </a>
            </li>
            @endrole

            <li class="nav-item {{ (request()->segment(2) == 'offices' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('offices.index') }}">
                    <i data-feather="briefcase"></i>
                    <span class="menu-title text-truncate" data-i18n="Page">Kantor</span>
                </a>
            </li>




            @role('super admin')
            <li class="navigation-header {{ (request()->segment(2) == 'settings' ? 'active' : '') }}">
                <span data-i18n="Setting">Setting</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'menus' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('menus.index') }}">
                    <i data-feather="menu"></i>
                    <span class="menu-title text-truncate" data-i18n="Menu">Menu</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(2) == 'points' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('points.index') }}">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="Menu">Point</span>
                </a>
            </li>

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
