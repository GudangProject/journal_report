<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                <h6 class="brand-text">LAPORAN JURNAL</h6>
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

            @role('super admin|pic')
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="database"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Master Data</span></a>
                <ul class="menu-content">
                    <li class="nav-item {{ (request()->segment(2) == 'journals' ? 'active' : '') }}">
                        <a class="d-flex align-items-center" href="{{ route('journals.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Jurnal">Jurnal</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->segment(2) == 'knowledge' ? 'active' : '') }}">
                        <a class="d-flex align-items-center" href="{{ route('knowledge.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Rumpun Ilmu">Rumpun Ilmu</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endrole

            @role('author|super admin|pic|finance')
            <li class="nav-item {{ (request()->segment(2) == 'payment' ? 'active' : '') }}">
                <a class="d-flex align-items-center" href="{{ route('payment.index') }}">
                    <i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate" data-i18n="Pembayaran">Pembayaran</span>
                </a>
            </li>
            @endrole

            @role('super admin|pic|finance')
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Laporan</span></a>
                <ul class="menu-content">
                    <li class="nav-item {{ (request()->segment(2) == 'reports.stock' ? 'active' : '') }}">
                        <a class="d-flex align-items-center" href="{{ route('reports.stock') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Stock Journal">Stok Jurnal</span>
                        </a>
                    </li>
                    @role('super admin|finance')
                    <li class="nav-item {{ (request()->segment(2) == 'reports.payment' ? 'active' : '') }}">
                        <a class="d-flex align-items-center" href="{{ route('reports.payment') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Laporan Pembayaran">Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->segment(2) == 'reports.finance' ? 'active' : '') }}">
                        <a class="d-flex align-items-center" href="{{ route('reports.finance') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Laporan Pembayaran">Asset Keuangan</span>
                        </a>
                    </li>
                    @endrole
                </ul>
            </li>
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
