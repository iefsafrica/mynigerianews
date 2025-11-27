@extends('layouts.app')
@section('title')
    {{__('messages.post.posts')}}
@endsection
@section('content')
    @php $styleCss = 'style' @endphp
    <div class="container-fluid">
        @include('flash::message')
            <livewire:post-component lazy :subCategories="$subCategories" :categories="$categories" />
        <div>
            {{ Form::hidden('id',Auth::user()->hasRole('customer'),['id' => 'loginUserRole']) }}
            <div class="overflow-auto">
                <livewire:post-table lazy/>
            </div>
        </div>
    </div>
@endsection
{{--@section('page_js')--}}
{{--    <script src="{{mix('assets/js/add_post/create_edit.js')}}"></script>--}}
{{--@endsection--}}
