@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
@section('pageCss')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}"> --}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{ Form::hidden('dashboardChartBGColor', Auth::user()->dark_mode ? 'rgb(28,73,113)' : 'rgb(214,237,255)', ['id' => 'dashboardChartBGColor']) }}
                {{-- @dd($posts, $postsDraft, $users, $rss, $rssPost); --}}
                <div class="col-12">
                    @can('manage_all_post')
                        <div class="row">
                            <livewire:admin-dashboard lazy :posts="$posts" :postsDraft="$postsDraft" :users="$users" :rss="$rss" :rssPost="$rssPost" />
                            <div class="col-12">
                                <div class="card-header border-0 pt-5 pb-1">
                                    <div class="px-2 py-2">
                                        <h3>{{ __('messages.dashboard_show.post_views') }}</h3>
                                    </div>
                                    <div id="timeRange" class="border px-2 py-2 justify-content-end">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>&nbsp;&nbsp<span></span> <b
                                            class="caret"></b>
                                    </div>
                                </div>
                                <div class="card mb-5 mb-xl-8 p-5" id="postChartContainer">
                                </div>
                            </div>
                        </div>
                    @endcan
                    @can('manage_staff')
                    <livewire:admin-dashboard-table lazy :posts="$posts" :postsDraft="$postsDraft" :users="$users" :rss="$rss" :rssPost="$rssPost" />
                    @endcan
                </div>
            </div>
        </div>
        @include('dashboard.templates.templates')
    </div>
    @endsection
    @section('page_js')
        <script>
            let dashboardChartBGColor = "{{ Auth::user()->dark_mode ? 'rgb(28,73,113)' : 'rgb(214,237,255)' }}";
        </script>
        {{-- <script src="{{ asset('assets/js/chart.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/daterangepicker.js') }}"></script> --}}
        {{-- <script src="{{mix('assets/js/dashboard/dashboard.js')}}"></script> --}}
    @endsection
