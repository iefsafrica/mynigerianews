<!-- header start  -->
<div class="news10-overlay"></div>
<header class="news10-header-section">
    <div class="container">
        <div class="news10-header-wrapper">
            <div class="news10-header-logo">
                <a class="header-logo"href="{{ URL('/') }}"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>

            </div>
            <div class="news10-main-menu-wrapper">
                <div class="news10-main-menu desktop-menu">
                    <ul>
                        <li class="dropdown"><a href="{{route('home')}}">{{ home() }}</a>
                            <ul class="dropdown-menu">

                            </ul>
                        </li>
                        </li>
                        {{--start menu dynamic--}}
                        @include('frontend.layouts._menu_one')
                        {{--end menu dynamic--}}
                        <li ><a href="{{ route('contactus') }}">{{ contactus() }}</a></li>
                    </ul>
                </div>
                <div class="news10-nav-right">

                    <div class="news10-nav-open btn1">
                        <div class="icon-left"></div>
                        <div class="icon-right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- mobile manu  -->
<div class="news10-main-menu mobile-menu">
    <div class="nav-close">
        <i class="fa fa-times"></i>
    </div>
    <ul>
        <li><a href="{{route('home')}}">{{ home() }}</a>
        </li>
        {{--start menu dynamic mobile--}}
        @include('frontend.layouts._menu_mobile')
        {{--end menu dynamic mobile--}}
    </ul>
</div>
<!-- header end -->

<!-- search news10l start  -->
<div class="news10-search-news10l news10-travel-search-news10l">
    <div class="container">
        <form class="news10-search-form">
            <input type="search" class="form-control" placeholder="Search..." autocomplete="off">
            <button class="theme-btn">{{__('Search')}}</button>
        </form>
    </div>
</div>
<!-- search news10l end  -->
