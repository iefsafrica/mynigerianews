@extends('admin.master')

@section('main_content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layouts._message')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Content Header  Title -->
                        <h1>{{ __('Theme Color') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Theme Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Theme Color') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="color-grid">
                    <label class="color-items" id="color-violet" data-id="color-violet" data-color="theme-violet" data-colortext="Violet" class="active">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-violet') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box violet"></span>
                            <span class="color-name">{{_('Violet')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-brown" data-id="color-brown" data-color="theme-brown" data-colortext="Brown">
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='theme-brown') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box brown"></span>
                            <span class="color-name">{{_('Brown')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-blue" data-id="color-blue" data-color="theme-blue" data-colortext="Blue">
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='theme-blue') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box blue"></span>
                            <span class="color-name">{{_('Blue')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-magenta" data-id="color-magenta" data-color="theme-magenta" data-colortext="Magenta">
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='theme-magenta') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box magenta"></span>
                            <span class="color-name">{{_('magenta')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-green" data-id="color-green" data-color="theme-green" data-colortext="Green">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-green') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box green"></span>
                            <span class="color-name">{{_('green')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-orange" data-id="color-orange" data-color="theme-orange" data-colortext=Orange">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-orange') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box orange"></span>
                            <span class="color-name">{{_('orange')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-pink" data-id="color-pink" data-color="theme-pink" data-colortext="Pink">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-pink') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box pink"></span>
                            <span class="color-name">{{__('pink')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-dark" data-id="color-dark" data-color="theme-dark" data-colortext="Dark">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-dark') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box dark"></span>
                            <span class="color-name">{{__('Dark')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-red" data-id="color-red" data-color="theme-red" data-colortext="Red">
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='theme-red') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box red"></span>
                            <span class="color-name">{{__('Red')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-maroon" data-id="color-maroon" data-color="theme-maroon" data-colortext="Maroon">
                        <input type="radio"  name="radio" class="d-none"@if($settings->theme_color=='theme-maroon') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box maroon"></span>
                            <span class="color-name">{{__('Maroon')}}</span>
                        </div>
                    </label>
                    <label class="color-items"  id="color-black-white"  data-id="color-black-white"  data-color="black-white" data-colortext="Black & White" >
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='black-white') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box black-white"></span>
                            <span class="color-name">{{__('Black & White')}}</span>
                        </div>
                    </label>
                    <label class="color-items" id="color-rose" data-id="color-rose" data-color="theme-rose" data-colortext="Rose">
                        <input type="radio"  name="radio" class="d-none" @if($settings->theme_color=='theme-rose') checked @endif>
                        <div class="colorbox-wrp">
                            <span class="color-box rose"></span>
                            <span class="color-name">{{__('Rose')}}</span>
                        </div>
                    </label>

                </div>
            </div>
        </section>
    </div>


@endsection
