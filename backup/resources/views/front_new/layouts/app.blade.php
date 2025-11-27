<!DOCTYPE html>
<html lang="en" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'dir=rtl' : '' }}>
@php
    $settings = getSettingValue();
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    @if (!empty(getSEOTools()->keyword)) --}}
    <meta name="keywords" content="@yield('meta_tags'),{{ !empty(getSEOTools()) ? getSEOTools()->keyword : '' }}">
    {{--    @endif --}}
    {{--    @if (!empty(getSEOTools()->site_description)) --}}
    <meta name="description"
        content="@if (View::hasSection('meta_description')) @yield('meta_description')
        @else{{ !empty(getSEOTools()) ? getSEOTools()->site_description : '' }} @endif">
    {{--    @endif --}}

    <meta http-equiv="content-language" content="{{ getFrontSelectLanguageName() ?? 'en' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image"
        content="@if (View::hasSection('meta_image')) @yield('meta_image')@else{{ $settings['logo'] }} @endif" />
    <title>@yield('title') |
        {{ !empty(getSEOTools()->site_title) ? getSEOTools()->site_title : $settings['application_name'] }} </title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $settings['favicon'] }}">
    <link href="{{ mix('css/front-third-party.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/front-pages.css') }}" rel="stylesheet" type="text/css">
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
    {!! reCaptcha()->renderJs() !!}
    @php
        $langSession = Session::get('frontLanguageChange');
        $frontLanguage = !isset($langSession) ? getSettingValue()['front_language'] : $langSession;
    @endphp

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ mix('assets/js/front-third-party.js') }}"></script>
    @routes
    <script src="{{ asset('messages.js') }}"></script>
    <script data-turbo-eval="false">
        let userProfile = '{{ asset('images/avatar.png') }}'
        let siteKey = "{{ $settings['site_key'] }}"
        let frontLanguage = "{{ App\Models\Language::find($frontLanguage)->iso_code }}"

        Lang.setLocale(frontLanguage)
    </script>
    <script src="{{ mix('assets/js/front-pages.js') }}"></script>
    {!! !empty(getSEOTools()->google_analytics) ? getSEOTools()->google_analytics : '' !!}
     @if (getFrontSelectLanguageIsoCode() == 'ar')
        <style>
            .section-heading  h2:after {
                left: -100px !important;
                right:auto !important;


            }
            @media (max-width: 575px) {
            .section-heading  h2:after {
                    left: -70px !important;
                    right:auto !important;
                }
            }
        </style>
    @endif
</head>

<body class="">
    @include('front_new.layouts.header')
    <div>
        @yield('content')
    </div>

    <!-- start footer section -->
    @include('front_new.layouts.footer')
    <!-- end footer section -->
    @if ($settings['show_cookie'])
        @include('cookie-consent::index')
    @endif
    <!-- start dark-mode-section -->
    <div class="theme-switch-box-wrap">
        <div class="theme-switch-box">
            <span class="theme-status"><i class="fa-solid fa-sun"></i></span>
            <label class="switch-label" for="themeSwitchCheckbox">
                <input class="input" type="checkbox" name="themeSwitchCheckbox" id="themeSwitchCheckbox">
                <span class="switch" onclick="myFunction()"></span>
            </label>
            <span class="theme-status"><i class="fas fa-moon"></i></span>
        </div>
    </div>
    <!-- end dark-mode-section -->
</body>

</html>
