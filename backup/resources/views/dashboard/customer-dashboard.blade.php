@extends('layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@section('pageCss')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{ Form::hidden('dashboardChartBGColor',(Auth::user()->dark_mode) ? 'rgb(28,73,113)' : 'rgb(214,237,255)',['id' => 'dashboardChartBGColor']) }}
                <livewire:customer-dashboard lazy :posts="$posts" :postsDraft="$postsDraft"/>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
<script>
    let dashboardChartBGColor = "{{ (Auth::user()->dark_mode) ? 'rgb(28,73,113)' : 'rgb(214,237,255)'}}"
</script>
@endsection
