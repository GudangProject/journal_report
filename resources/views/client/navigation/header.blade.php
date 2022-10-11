<header class="header-wraper jl_header_magazine_style two_header_top_style header_layout_style3_custom jl_cus_top_share">
    <div class="header_top_bar_wrapper">
        <div class="container map_wrapper">
            <div class="row">
                <div class="logo_small_wrapper col-md-4 col-sm-12 col-xs-12 mt-3 d-flex align-items-center">
                    <a class="logo-mod-a text-center" href="/">
                        <img class="jl_logo_n logo_mod" src="{{asset('assets/images/logo.png')}}" alt="Kemenag Sulsel"/>
                    </a>
                    <div class="d-block d-sm-none search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons">
                            <div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span>
                            </div>
                        </div>
                        <div class="jl_day_night jl_day_en"> <span class="jl-night-toggle-icon">
                        <span class="jl_moon">
                        <i class="jli-moon"></i>
                        </span>
                            <span class="jl_sun">
                        <i class="jli-sun"></i>
                        </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 mt-3 mb-3 text-center">
                    @include('client.widget.banner', ['data'=>$banner_header])
                </div>
            </div>
        </div>
    </div>
    <!-- Start Main menu -->
    <div class="jl_blank_nav"></div>
    <div id="menu_wrapper" class="menu_wrapper jl_menu_sticky jl_stick d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="main_menu ">
                <div class="menu-primary-container navigation_wrapper">

                    <div class="d-flex justify-content-between">
                        <ul id="mainmenu" class="jl_main_menu">
                            @foreach ($menu as $item)
                                @if ($item->parent_id == 0 && $item->category_id == 1)
                                <li class="menu-item current-menu-item current_page_item">
                                    <a href="{{ $item->slug }}">{{ $item->name }}<span class="border-menu"></span></a>
                                    @if ($item->type == 1)
                                    <ul class="sub-menu">
                                        @foreach ($menu as $value)
                                        @if($value->parent_id == $item->id)
                                        <li class="menu-item">
                                            <a href="{{ $value->slug }}">{{ $value->name }}<span class="border-menu"></span></a>
                                       </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>

                        <ul>
                            <li>
                                <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search text-white"></i>
                                </div>
                            </li>
                            <li>
                                <div class="jl_day_night jl_day_en">
                                    <span class="jl-night-toggle-icon">
                                        <span class="jl_moon">
                                            <i class="jli-moon"></i>
                                        </span>
                                        <span class="jl_sun">
                                            <i class="jli-sun"></i>
                                        </span>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu_wrapper menu_office d-none d-lg-block d-xl-block shadow-sm border-sm">
        <div class="container">
            <div class="">
                <div class="menu-primary-container navigation_wrapper">
                    <div class="d-flex justify-content-between">
                        <ul id="officemenu" class="jl_main_menu_office">
                            @foreach ($menu_office as $item)
                                <li class="menu-item current-menu-item current_page_item">
                                    <a href="{{ $item->url }}"><span class="text-uppercase">{{ $item->title }}</span><span class="border-menu"></span></a>
                                </li>
                                @if ($loop->index == 10)
                                    @break
                                @endif
                            @endforeach
                            @if ($menu_office->count() > 10)
                                <li class="menu-item current-menu-item current_page_item">
                                    <a href="#">Lainnya<span> <i class="fas fa-chevron-down"></i></span></a>
                                    <ul class="sub-menu">
                                    @foreach ($menu_office as $value)
                                        @if($loop->index < 11)
                                            @continue
                                        @endif
                                        <li class="menu-item">
                                            <a href="{{ $value->url }}">{{ $value->title }}<span class="border-menu"></span></a>
                                    </li>

                                    @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="d-block d-sm-none scrollmenu jl_menu_sticky jl_stick">
    <div class="menu-primary-container navigation_wrapper">
        <ul id="mainmenu" class="jl_main_menu">
            @foreach ($menu as $item)
                @if ($item->parent_id == 0)
                <li class="menu-item current-menu-item current_page_item">
                    <a href="{{ $item->slug }}">{{ $item->name }}<span class="border-menu"></span></a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="d-block d-sm-none scrolloffice">
    <div class="menu-primary-container navigation_wrapper">
        <ul id="mainmenu" class="jl_main_menu">
            @foreach ($menu_office as $item)
                <li class="menu-item current-menu-item current_page_item">
                    <a href="{{ $item->url }}">{{ $item->title }}<span class="border-menu"></span></a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div id="content_nav" class="jl_mobile_nav_wrapper">
    <div id="nav" class="jl_mobile_nav_inner">
        <div class="menu_mobile_icons mobile_close_icons closed_menu"> <span class="jl_close_wapper"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
        </div>
        <ul id="mobile_menu_slide" class="menu_moble_slide">
            @foreach ($menu as $item)
                @if ($item->parent_id == 0)
                <li class="menu-item current-menu-item current_page_item">
                    <a href="{{ $item->slug }}">{{ $item->name }}<span class="border-menu"></span></a>
                    @if ($item->type == 1)
                    <ul class="sub-menu">
                        @foreach ($menu as $value)
                        @if($value->parent_id == $item->id)
                        <li class="menu-item"> <a href="#">{{ $value->name }}<span class="border-menu"></span></a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
            @endforeach
        </ul>
        <div id="sprasa_about_us_widget-3" class="widget jellywp_about_us_widget">
            <div class="widget_jl_wrapper about_widget_content">
                <div class="jellywp_about_us_widget_wrapper">
                    <div class="social_icons_widget">
                        <ul class="social-icons-list-widget icons_about_widget_display">
                            <li> <a href="#" class="facebook" target="_blank"><i class="jli-facebook"></i></a>
                            </li>
                            <li> <a href="#" class="twitter" target="_blank"><i class="jli-twitter"></i></a>
                            </li>
                            <li> <a href="#" class="instagram" target="_blank"><i class="jli-instagram"></i></a>
                            </li>
                            <li> <a href="#" class="youtube" target="_blank"><i class="jli-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search_form_menu_personal">
    <div class="menu_mobile_large_close"> <span class="jl_close_wapper search_form_menu_personal_click"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
    </div>
    <form method="GET" class="searchform_theme" action="{{ route('search') }}">
        <input type="text" placeholder="Search..." value="" name="q" class="search_btn" />
        <button type="submit" class="button"><i class="jli-search"></i>
        </button>
    </form>
</div>
<div class="mobile_menu_overlay"></div>


