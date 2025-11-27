@extends('theme1.layouts.app')
@section('title')
    {{ __('messages.post.gallery') }}
@endsection

@section('content')
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
        <div class="container xl:px-10 md:px-8 px-4 mx-auto">
            <div class="text-center relative">
                @if (!empty($allSubCategory->first()))
                    <div class="lg:text-6xl sm:text-5xl text-4xl pb-3 text-gray-100 font-semibold">
                        {!! $allSubCategory->first()->album->name !!}
                    </div>
                    <h3 class="text-black font-semibold lg:text-3xl text-2xl absolute bottom-0 left-0 right-0 mx-auto">
                        {!! $allSubCategory->first()->album->name !!}
                    </h3>
                @endif
            </div>
            @if (!empty($allSubCategory))
                <div class="pt-10">
                    <div class="">
                        <!-- Tabs -->
                        <ul id="tabs" class="inline-flex flex-wrap justify-center w-full">
                            <li class="bg-white px-4 font-semibold sub-category-btn py-2 rounded-t">
                                <button class="text-primary border-b-2 border-primary" href="javascript:void(0)"
                                    data-rel="all">{{ __('messages.all') }}</button>
                            </li>
                            @if ($allSubCategory->isNotEmpty())
                            @if (count($allSubCategory) > 1)
                                @foreach ($allSubCategory as $category)
                                    @if ($category->gallery->count())
                                        <li class="px-4 text-gray-800 font-semibold py-2 rounded-t sub-category-btn">
                                            <button data-href="javascript:void(0)"
                                                data-rel="{{ str_replace(' ', '-', $category->name) }}">
                                                {!! $category->name !!}
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                <li class="px-4 text-gray-800 font-semibold py-2 rounded-t sub-category-btn">
                                    <button href="javascript:void(0)"
                                        data-rel="{{ str_replace(' ', '-', $allSubCategory->first()->name) }}">
                                        {!! $allSubCategory->first()->name !!}</button>
                                </li>
                            @endif
                            @endif
                        </ul>
                        <!-- Tab Contents -->
                        <div id="portfolio" class="pt-8">
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 gap-4">
                                @if (!empty($galleryImages))
                                    @foreach ($galleryImages as $galleryImage)
                                        @foreach ($galleryImage->gallery_image as $gallery)
                                            <div
                                                class="gallery-img w-full rounded-xl overflow-hidden {{ str_replace(' ', '-', $galleryImage->category->name) }}">
                                                <img class="w-full h-full object-cover" src="{{ $gallery }}"
                                                    alt="Gallery Image" loading="lazy"/>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- advertiesment -->
    @if (checkAdSpaced('categories'))
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
            <div class="container xl:px-10 md:px-8 px-4 mx-auto">
                <div class="border bg-gray-100 h-48 rounded-xl flex justify-center items-center">
                    <a href="{{ getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES)->ad_url }}" target="_blank">
                        <img src="{{ asset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES)->ad_banner) }}"
                            class="img-fluid" loading="lazy">
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-mobile">
            <div class="container xl:px-10 md:px-8 px-4 mx-auto">
                <div class="lg:flex lg:gap-8 gap-10">
                    <div class="mb-8 lg:h-80 h-40">
                        <div class="border bg-gray-100 rounded-xl lg:h-80 h-40  flex justify-center items-center">
                            <a href="{{ getAdImageMobile(\App\Models\AdSpaces::CATEGORIES)->ad_url }}" target="_blank">
                                <img src="{{ asset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES)->ad_banner) }}"
                                    width="350" class="img-fluid" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
