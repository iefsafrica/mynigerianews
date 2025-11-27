@extends('theme1.layouts.app')
@section('title')
    {{ __('messages.post.gallery') }}
@endsection

@section('content')
<div>
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
        <div class="container mx-auto max-w-7xl">
            <div class="text-center relative">
                <div class="lg:text-6xl sm:text-5xl text-4xl pb-3 text-gray-100 font-semibold">
                  {{ __('messages.post.gallery') }}
                </div>
                <h3 class="text-black font-semibold lg:text-3xl text-2xl absolute bottom-0 left-0 right-0 mx-auto">
                  {{ __('messages.post.gallery') }}
                </h3>
            </div>
            <div class="pt-10">
                <div class="">
                    <!-- Tab Contents -->
                    <div id="tab-contents" class="pt-8">
                        <div id="first">
                            <div class="grid sm:grid-cols-4 lg:gap-7 gap-5">
                                @php
                                    $startIndex = 2;
                                @endphp
                                <div class="flex flex-col lg:gap-8 gap-5">
                                    @foreach ($galleries as $key => $gallery)
                                        @if ($key >= $startIndex)
                                            <div
                                                class="gallery-img sm:h-1/3 max-h-[260px] w-full rounded-xl overflow-hidden relative group">
                                                <a href="{{ route('galleryPage', $gallery->album_id) }}" data-turbo="false">
                                                    <img src="{{ !empty($gallery->gallery_image['0']) ? $gallery->gallery_image['0'] : asset('front_web/images/default.jpg') }}"
                                                        class="w-full h-full object-cover" loading="lazy"/>
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-[#181d2740] to-[#181d2740] opacity-0 group-hover:opacity-100">
                                                        <span
                                                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 z-10">{!! $gallery->album->name !!}</span>
                                                    </div>
                                                </a>
                                            </div>
                                            @if ($loop->iteration == 5)
                                            @break
                                        @endif
                                    @endIf
                                @endforeach
                            </div>
                            @if (!empty($galleries))
                                <div class="sm:col-span-2 flex flex-col lg:gap-8 gap-5">
                                    @foreach ($galleries as $gallery)
                                        <div
                                            class="gallery-img w-full sm:h-1/2 sm:max-h-[410px] max-h-[260px] rounded-xl overflow-hidden group relative">
                                            <a href="{{ route('galleryPage', $gallery->album_id) }}" data-turbo="false">
                                                <img src="{{ !empty($gallery->gallery_image['0']) ? $gallery->gallery_image['0'] : asset('front_web/images/default.jpg') }}"
                                                    class="w-full h-full object-cover" loading="lazy"/>

                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-[#181d2740] to-[#181d2740] opacity-0 group-hover:opacity-100">
                                                    <span
                                                        class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 z-10">{!! $gallery->album->name !!}</span>
                                                </div>
                                            </a>
                                        </div>
                                        @if ($loop->iteration == 2)
                                        @break
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @php
                            $startIndex = 5;
                        @endphp
                        <div class="flex flex-col lg:gap-8 gap-5">
                            @foreach ($galleries as $key => $gallery)
                                @if ($key >= $startIndex)
                                    <div
                                        class="gallery-img sm:h-1/3 max-h-[260px] w-full rounded-xl overflow-hidden relative group">
                                        <a href="{{ route('galleryPage', $gallery->album_id) }}" data-turbo="false">
                                            <img src="{{ !empty($gallery->gallery_image['0']) ? $gallery->gallery_image['0'] : asset('front_web/images/default.jpg') }}"
                                                class="w-full h-full object-cover" loading="lazy"/>
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-[#181d2740] to-[#181d2740] opacity-0 group-hover:opacity-100">
                                                <span
                                                    class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 z-10">{!! $gallery->album->name !!}</span>
                                            </div>
                                        </a>
                                    </div>
                                    @if ($loop->iteration == 8)
                                    @break
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @php
            $startIndex = 8;
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 mt-5 gap-4">
            @foreach ($galleries as $key => $gallery)
                @if ($key >= $startIndex)
                    <div class="gallery-img max-h-[260px] w-full rounded-xl overflow-hidden relative group">
                        <img src="{{ !empty($gallery->gallery_image['0']) ? $gallery->gallery_image['0'] : asset('front_web/images/default.jpg') }}"
                            class="w-full h-full object-cover" loading="lazy"/>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#181d2740] to-[#181d2740] opacity-0 group-hover:opacity-100">
                            <span
                                class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 z-10">{!! $gallery->album->name !!}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- advertiesment -->
    @if (checkAdSpaced('categories'))
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            @if (isset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
            <div class="index-top-desktop">
                {!! getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
            </div>
        @elseif($adRecord = getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1))
            <div class="bg-gray-100 container max-w-7xl rounded-xl mx-auto">
                <a href="{{ $adRecord->ad_url }}" target="_blank">
                    <img src="{{ asset($adRecord->ad_banner) }}"
                        class="rounded-xl object-fill" loading="lazy">
                </a>
            </div>
        @endif
        </div>
    </div>
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-mobile">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="lg:flex lg:gap-8 gap-10">
                <div class="mb-8">
                    @if (isset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                    <div class="index-top-desktop">
                        {!! getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                    </div>
                @elseif($adRecord = getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                    <div class="flex justify-center items-center rounded-xl mx-auto">
                        <a href="{{ $adRecord->ad_url }}"
                            target="_blank">
                            <img src="{{ asset($adRecord->ad_banner) }}"
                                class="rounded-xl object-fill md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px]"
                                loading="lazy">
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endif
</div>
@endsection
