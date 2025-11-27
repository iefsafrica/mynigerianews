<!DOCTYPE html>
@php
    $settings = App\Models\Setting::pluck('value', 'key')->toArray();
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ auth()->user()->language == 'ar' ? 'dir=rtl' : '' }}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ $settings['application_name'] }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ $settings['favicon'] }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    @if (!Auth::user()->dark_mode)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins.css') }}">
        <link href="{{ mix('assets/css/full-screen.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('front_web/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins.dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('front_web/css/flatpicker-dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('front_web/css/custom-dark.css') }}">
    @endif

    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}"> --}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"> --}}


    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}"> --}}
    {{--    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css "/> --}}

    <!-- CSS Libraries -->
    @yield('page_css')
    @yield('css')
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
    @routes
    <script src="https://js.stripe.com/v3/"></script>

    <script src="{{ asset('assets/js/third-party.js') }}"></script>

    <script data-turbo-eval="false">
        let stripe = ''
        @if (!empty(getStripeAPIKey()))
            stripe = Stripe('{{ getStripeAPIKey() }}');
        @endif
        let changePasswordUrl = "{{ route('user.changePassword') }}"
        let darkMode = "{{ Auth::user()->dark_mode ? 1 : 0 }}"
        let lang = "{{ Auth::user()->language ?? 'en' }}"
        let defaultImage = "{{ asset('front_web/images/default.jpg') }}"
        // Lang.setLocale(lang)
    </script>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <script src="{{ mix('assets/js/pages.js') }}"></script>
    @if (auth()->user()->language == 'ar')
        <style>
            img,
            .toast-close-button {
                margin-left: 10px;
            }

            .rappasoft-striped-row .me-5 {
                margin: 0 !important;
            }

            .btn-secondary {
                margin-right: 10px;
            }

            .dropdown-toggle:after {
                margin-right: 10px;
            }

            .aside-menu-container {
                right: 0 !important;
            }

            ul.aside-menu-container__aside-menu.nav.flex-column {
                padding: 0 !important;
            }

            .wrapper.d-flex.flex-column.flex-row-fluid {
                padding-left: 0 !important;
            }

            @media (min-width: 1200px) {
                .wrapper {
                    transition: padding-left 0.3s ease;
                    padding-right: 16.563rem;
                }
            }

            .collapsed-menu .wrapper {
                padding-right: 5rem;
            }

            .dropdown.dropdown-hover .dropdown-menu {
                right: -250px !important;
            }

            @media (max-width: 1199px) {
                .aside-menu-container.collapsed-menu {
                    right: 0 !important;
                }
            }

            .aside-menu-container {
                left: 0 !important;
            }

            @media (max-width: 1199px) {
                .aside-menu-container {
                    position: fixed;
                    width: calc(100% - 30px);
                    top: 0;
                    right: -265px !important;
                    max-width: 265px;
                }
            }

            @media (max-width: 1199px) {
                .header .top-navbar {
                    transition: width, left, right, 0.3s;
                    position: fixed;
                    left: -265px;
                    top: 0;
                    bottom: 0;
                    width: 265px;
                    z-index: 999;
                    background: #FFFFFF;
                }
            }

            @media (max-width: 1199px) {
                .header .show-nav {
                    left: 0;
                }
            }

            .table.table-striped> :not(caption)>*>*,
            .table.table-striped>thead>tr>th {
                padding: 0.625rem 1.875rem 0.625rem 0.25rem !important;
                vertical-align: middle;
            }

            .nav-pills .nav-item:first-child .nav-link {
                border-top-left-radius: 0rem;
                border-bottom-left-radius: 0rem;
                border-top-right-radius: 0.313rem;
                border-bottom-right-radius: 0.313rem;
            }

            .nav-pills .nav-item:last-child .nav-link {
                border-top-right-radius: 0rem;
                border-bottom-right-radius: 0rem;
                border-top-left-radius: 0.313rem;
                border-bottom-left-radius: 0.313rem;
            }
            .toast-message{
                margin-right: 20px;
            }
            .aside-menu-container__aside-menu .nav-item .nav-link:hover, .aside-menu-container__aside-menu .nav-item.active>.nav-link {
                border-right-color: #6571ff !important;
                border-left-color: none;
            }
            .aside-menu-container__aside-menu .nav-item .nav-link {
                border-right: .313rem solid transparent !important;
                border-left: none;
            }
            .aside-menu-container__search-icon {
                right: 10px;
            }
            .aside-menu-container__aside-search .form-control {
                padding-right: 1.875rem;
            }
            .select2-container--bootstrap-5 .select2-selection--single {
                padding: 0.688rem 0.938rem 0.688rem 2.814rem;
                background-position: left 0.938rem center;
            }
            .accordion-button::after {
                margin-right: auto !important;
                margin-left: 0 !important;
            }
        </style>
    @else
        <style>
            @media (max-width: 1199px) {
                .header .top-navbar {
                    transition: width, left, right, 0.3s;
                    position: fixed;
                    right: -265px;
                    top: 0;
                    bottom: 0;
                    width: 265px;
                    z-index: 999;
                    background: #FFFFFF;
                }
            }

            @media (max-width: 1199px) {
                .header .show-nav {
                    right: 0;
                }
            }
        </style>
    @endif
</head>
@php $styleCss='style' @endphp

<body class="">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid">
                <div class='container-fluid d-flex align-items-stretch justify-content-between px-0'>
                    @include('layouts.header')
                </div>

                <div class="content d-flex flex-column flex-column-fluid pt-7">
                    @yield('header_toolbar')
                    <div class='d-flex flex-wrap flex-column-fluid'>
                        @yield('content')
                    </div>
                </div>
                <div class='container-fluid footer'>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    @include('profile.changePassword')
</body>

</html>
