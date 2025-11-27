@extends('theme1.layouts.app')
@section('title')
    {!!  $page->name !!}
@endsection
@section('content')
<div class="">
    <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
        <nav class="text-gray-600 pt-5">
            <ol class="list-none p-0 inline-flex flex-wrap">
                <li class="flex items-center">
                    <a href="/" class="text-gray-300 text-sm font-medium">{{ __('messages.details.home') }}</a>
                    <span class="lg:mx-3 mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="#606060" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                </li>
                <li class="flex items-center">
                    <a href="/" class="text-gray-300 text-sm font-medium">Pages</a>
                    <span class="lg:mx-3 mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="#606060" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                </li>
                <li class="flex items-center">
                    <a href="javascript:void(0)" class="text-gray-300 text-sm text-primary font-medium">{!! $page->name !!}</a>
                </li>
            </ol>
        </nav>
        <div class="mt-10">
            <span class="font-medium">{!!  $page->content !!}</span>
        </div>
    </div>
</div>
@endsection
