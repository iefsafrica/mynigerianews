@extends('layouts.app')
@section('title')
    {{__('messages.news_letters')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column overflow-auto">
            @include('flash::message')
            <livewire:news-letter-table lazy/>
        </div>
    </div>
    @include('news_letter.modal')
@endsection

{{--@section('page_js')--}}
{{--    <script src="{{mix('assets/js/news_letter/news_letter.js')}}"></script>--}}
{{--@endsection--}}
