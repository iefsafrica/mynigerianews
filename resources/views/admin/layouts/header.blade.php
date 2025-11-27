<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{URL('/') }}" class="nav-link">{{ __('Frontend') }}</a>
        </li>
        <li class="nav-item dropdown  theme-color">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge pulse-animation">New</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <a href="#" class="dropdown-item theme-color violet @if($settings->theme_color=='theme-violet') active @endif " id="theme-violet" data-id="theme-violet" data-color="theme-violet" data-colortext="Violet">
                    {{__('Theme Violet')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color brown @if($settings->theme_color=='theme-brown') active @endif" id="theme-brown" data-color="theme-brown" data-colortext="Brown">
                    {{__('Theme Brown')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color blue @if($settings->theme_color=='theme-blue') active @endif" id="theme-blue" data-color="theme-blue" data-colortext="Blue">
                    {{__('Theme Blue')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color magenta @if($settings->theme_color=='theme-magenta') active @endif" id="theme-magenta" data-color="theme-magenta" data-colortext="Magenta">
                    {{__('Theme Magenta')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color green @if($settings->theme_color=='theme-green') active @endif" id="theme-green" data-color="theme-green" data-colortext="Green">
                    {{__('Theme Green')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color orange @if($settings->theme_color=='theme-orange') active @endif" id="theme-orange" data-color="theme-orange" data-colortext=Orange">
                    {{__('Theme Orange')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color pink @if($settings->theme_color=='theme-pink') active @endif" id="theme-pink" data-color="theme-pink" data-colortext="Pink">
                    {{__('Theme Pink')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color dark @if($settings->theme_color=='theme-dark') active @endif" id="theme-dark" data-color="theme-dark" data-colortext="Dark">
                    {{__('Theme Dark')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color red @if($settings->theme_color=='theme-red') active @endif" id="theme-red" data-color="theme-red" data-colortext="Red">
                    {{__('Theme Red')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color maroon @if($settings->theme_color=='theme-maroon') active @endif" id="theme-maroon" data-color="theme-maroon" data-colortext="Maroon">
                    {{__('Theme Maroon')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color rose @if($settings->theme_color=='theme-rose') active @endif" id="theme-rose" data-color="theme-rose" data-colortext="Rose">
                    {{__('Theme Rose')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-color black-white @if($settings->theme_color=='black-white') active @endif" id="black-white" data-color="black-white" data-colortext="Black & White">
                    {{__('Black & White')}}
                </a>

            </div>
        </li>

    </ul>

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle fa-fw"></i>
                {{ optional(auth()->user())->user_name }}
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <a href="{{ route('logout') }}" class="dropdown-item btn btn-danger">
                    {{ __('Log Out') }}
                    <i class="fas fa-logout right"></i>
                    <span class="float-right text-muted text-sm"></span>
                </a>

            </div>
        </li>



    </ul>
    <!-- Raw Links -->

</nav>
