@extends('layouts.app')
@section('title')
    {{__('messages.staffs')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:staff-table lazy/>
        </div>
    </div>
@endsection
{{--@section('page_js')--}}
{{--    <script src="{{mix('assets/js/staff/staff.js')}}"></script>--}}
{{--@endsection--}}

