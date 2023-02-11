<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">

        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{ ucwords(auth()->user()->name) }}</span>
                        <span class="user-status">{{ ucwords(auth()->user()->getRoleNames()[0]) }}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ isset(auth()->user()->image) ? '/storage/pictures/users/mid/'.auth()->user()->image : asset('assets/images/dummy-image.jpeg') }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('profile', auth()->user()->slug) }}"><i class="mr-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
