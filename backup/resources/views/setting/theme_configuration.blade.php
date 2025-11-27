@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection

@section('content')
{{ Form::open(['route' => ['setting.update'], 'method' => 'post']) }}
    <div class="container-fluid">
        @include('setting.setting_menu')
        <div class="card p-10">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-7">
                        <input type="hidden" name="theme_id" value="{{ $setting['theme_configuration'] }}" id="themeInput">
                        {{ Form::hidden('sectionName', $sectionName) }}
                        <div class="theme-img-radio  {{ $setting['theme_configuration'] == 1 ? 'img-border' : '' }}" data-id="1">
                            <img src="{{ asset('assets/theme1/images/theme1.png') }}" alt="Template" class="img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group mb-7">
                        <div class="theme-img-radio {{ $setting['theme_configuration'] == 2 ? 'img-border' : '' }}" data-id="2">
                            <img src="{{ asset('assets/theme1/images/theme2.png') }}" alt="Template" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-2 d-flex">
                <button class="btn btn-primary {{ auth()->user()->language == 'ar' ? 'ms-3' : 'me-3' }} ">
                    {{ __('messages.common.save') }}
                </button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    {{--    <div class="container-fluid mt-5"> --}}
    {{--        <div class="card"> --}}
    {{--            <div class="card-header"> --}}
    {{--                <div class="card-title m-0"> --}}
    {{--                    <h3 class="m-0">{{ __('messages.setting.download-db') }}</h3> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--            <div class="card-body"> --}}
    {{--                <a href="{{route('db-download')}}" class="btn btn-primary"> --}}

    {{--                    {{ __('messages.setting.download-db') }} --}}
    {{--                    <i class="fa-solid fa-download px-2"></i> --}}
    {{--                </a> --}}

    {{--            </div> --}}
    {{--            {{ Form::close() }} --}}
    {{--        </div> --}}
    {{--    </div> --}}
@endsection
{{-- @section('page_js') --}}
{{--    <script src="{{asset('/web/plugins/custom/tinymce/tinymce.bundle.js')}}"></script> --}}
{{--    <script src="{{mix('assets/js/settings/settings.js')}}"></script> --}}
{{-- @endsection --}}
