<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
    $settings = settings();
    @endphp
    <meta charset="{{ config('app.charset') }}">
    <meta name="viewport" content="{{ __('width=device-width, initial-scale=1') }}">
    <!-- favicon -->
    <link rel="icon" href="{{ asset($settings->favicon) }}">

    <title>{{ $settings->title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('admin/fonts/google-font-sans.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
    <style>
        .forgetsec a{
            color: black;
            font-size: 13px;
            padding: 4px;
        }
        .forgetpass{
            padding-right: 20px;
        }
    </style>


</head>
<body>
    
<!-- /.login-box -->

<div class="new-login-section">
    <div class="row">
        <div class="col-md-6">
            <div class="login-bg"><img src="{{ asset('admin/img/login/login-bgjpg.jpg') }}" alt=""></div>
        </div>
    </div>
    <div class="login-form-section">
        <div class="row">
            <div class="col-md-6">
                <div class="login-left-img">
                    <img src="{{ asset('admin/img/login/login-left.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-6">

                <div id="loginMessage">
                    @if (session()->has('message'))
                        <div class="alert alert-{{session('type')}}">
                            {{session('message')}}
                        </div>

                    @endif
                </div>
                <div class="new-login-form">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <h2>{{ __('Welcome to') }} <span>{{ __('Maan News') }}</span></h2>
                        <p> {{ __('Welcome back, Please login in to your account') }}</p>
                        <div class="login-input-item">
                            <div class="input-group">
                                <span class="left-img"><img src="{{ asset('admin/img/login/user.svg') }}" alt="icon"></span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="login-input-item">
                            <div class="input-group">
                                <span class="left-img"><img src="{{ asset('admin/img/login/lock.svg') }}" alt="icon"></span>
                                <div class="input-wrp">
                                    <input type="password"  name="password" id="password"  class="form-control passwordhide" placeholder="Password">
                                    <span class="hide-pass"><img src="{{ asset('admin/img/login/eye-slash.svg') }}" alt="icon"></span>
                                    <span class="hideicon"><img src="{{ asset('admin/img/login/eye-slash.svg') }}" alt="icon"></span>
                                </div>
                            </div>
                        </div>
                        <div class="remember-check">
                            <label>
                                <input type="checkbox">
                                <span>{{ __('Remember me') }}</span>
                            </label>
                            <a href="#" class="forget-pass">{{ __('Forgot Password?') }}</a>
                        </div>
                        <button type="submit" class="login-btn">{{ __('LogIn') }}</button>
                        <div class="login-button-group">
                            <a href="#" class="login-btn quick-login-btn" data-email="superadmin21@gmail.com" data-password="superadmin21" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-lock"></i>
                                {{ __('Super Admin') }}
                            </a>

                            <a href="#" class="login-btn quick-login-btn" data-email="admin21@gmail.com" data-password="admin21" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-lock"></i>
                                {{ __('Admin') }}
                            </a>

                            <a href="#" class="login-btn quick-login-btn" data-email="editor21@gmail.com" data-password="editor21" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-lock"></i>
                                {{ __('Editor') }}
                            </a>
                            <a href="#" class="login-btn quick-login-btn" data-email="reporter21@gmail.com" data-password="reporter21" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-lock"></i>
                                {{ __('Reporter') }}
                            </a>
                            <a href="#" class="login-btn quick-login-btn" data-email="accountant21@gmail.com" data-password="accountant21" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-lock"></i>
                                {{ __('Accountant') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- Login JS -->
<script src="{{ asset('admin/js/login.js') }}"></script>

<script>
        $(".hide-pass").click(function() {
            $(".passwordhide").attr("type", "text");
            $(".hide-pass").hide();
            $(".hideicon").show();
        });
        
        $(".hideicon").click(function() {
            $(".passwordhide").attr("type", "password");
            $(".hideicon").hide();
            $(".hide-pass").show();
        });
</script>

</body>
</html>
