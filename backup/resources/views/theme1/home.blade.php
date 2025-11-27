@extends('theme1.layouts.app')

@section('title')
    {!! !empty(getSEOTools()->home_title) ? getSEOTools()->home_title : __('messages.details.home') !!}
@endsection

@php
    $topAd = checkAdSpaced('index_top');
    $bottomAd = checkAdSpaced('index_bottom');

    if ($topAd) {
        $adImageDesktopTop = getAdImageDesktop(\App\Models\AdSpaces::INDEX_TOP_THEME_1);
        $adImageMobileTop = getAdImageMobile(\App\Models\AdSpaces::INDEX_TOP_THEME_1);
    }

    if ($bottomAd) {
        $adImageDesktopBottom = getAdImageDesktop(\App\Models\AdSpaces::INDEX_BOTTOM_THEME_1);
        $adImageMobileBottom = getAdImageMobile(\App\Models\AdSpaces::INDEX_BOTTOM_THEME_1);
    }
@endphp

@section('content')
    <div class="pt-8">
         @if(count(getBreakingPost()))
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="border rounded-xl overflow-hidden relative">
                <div
                    class="bg-gray-100 h-full sm:w-14 w-12 absolute border-r {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'right-0' : 'left-0' }} top-0 flex justify-center items-center z-10">
                    <div class="tag p-2.5 -rotate-90">
                        <h5 class="text-lg font-medium">{{ __('messages.trending') }}</h5>
                    </div>
                </div>

                <div class="trending-slider md:mb-0 mb-14 h-auto overflow-hiddden">
                    @foreach (getBreakingPost() as $getTrendingPost)
                        <div class="">
                            <div class="md:py-7 py-4 lg:ps-20 ps-16 pe-5">
                                <div class="sm:flex sm:ps-2">
                                    <div
                                        class="w-[150px] h-[100px] min-w-[150px] rounded-lg overflow-hidden sm:mr-3 sm:mb-0 mb-3">
                                        <a href="{{ route('detailPage', $getTrendingPost['slug']) }}" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                                            @if ($getTrendingPost['post_types'] == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <div class="image-container">
                                                    <img src="{{ $getTrendingPost['post_image'] }}" loading="lazy"
                                                        class="blurred-image w-full h-[100px] object-fill" alt="post-img" />
                                                    <button class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-music text-white"></i>
                                                    </button>
                                                </div>
                                            @elseif($getTrendingPost['post_types'] == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                @php
                                                    $thumbUrl = !empty($getTrendingPost['postVideo']) && !empty($getTrendingPost['postVideo']->thumbnail_image_url) ? $getTrendingPost['postVideo']->thumbnail_image_url : null;
                                                    $thumbImage = !empty($getTrendingPost['postVideo']) && !empty($getTrendingPost['postVideo']->uploaded_thumb) ? $getTrendingPost['postVideo']->uploaded_thumb : asset('front_web/images/default.jpg');
                                                @endphp
                                                <div class="image-container">
                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                        loading="lazy" class="blurred-image w-full h-[100px] object-cover"
                                                        alt="thumb-img" />
                                                    <button class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-play text-white"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <img src="{{ $getTrendingPost['post_image'] }}" loading="lazy"
                                                    class="w-full h-full object-cover" alt="post-img" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="">
                                        <p class="text-primary text-base font-medium pb-3">
                                            <a href="{{ route('categoryPage', $getTrendingPost['category']['slug']) }}">
                                                {{ $getTrendingPost['category']['name'] }}
                                            </a>
                                            {{-- <a href="{{ route('detailPage', $getTrendingPost['slug']) }}"> --}}
                                        </p>
                                        <p class="text-base font-bold line-clamp-2 hover:text-primary">
                                            <a href="{{ route('detailPage', $getTrendingPost['slug']) }}">
                                                {{ $getTrendingPost['title'] }}
                                            </a>
                                        </p>
                                        <div class="pt-3 flex flex-wrap">
                                            <div class="flex items-center mr-5">
                                                <div class="w-4 h-4 mr-2.5">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                            fill="#C00F24"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                               {{ ucfirst(__('messages.common.' . strtolower($getTrendingPost->created_at->format('M')))) }}{{ \Carbon\Carbon::parse($getTrendingPost['created_at'])->format(' d, Y') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 mr-2.5">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                            fill="#C00F24"></path>
                                                    </svg>
                                                </div>
                                                @if (
                                                    $getTrendingPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                        $getTrendingPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                    <span
                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                            $getTrendingPost->postArticle?->article_content
                                                                ? $getTrendingPost->postArticle->article_content
                                                                : $getTrendingPost->description,
                                                        ) }}</span>
                                                @elseif ($getTrendingPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        <?php
                                                        $allContent = '';
                                                        foreach ($getTrendingPost->postGalleries as $postDet) {
                                                            $allContent .= $postDet->gallery_content;
                                                        }
                                                        ?>
                                                        {{ getReadingTime($allContent) }}</span>
                                                @elseif ($getTrendingPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        <?php
                                                        $allContent = '';
                                                        foreach ($getTrendingPost->postSortLists as $postDet) {
                                                            $allContent .= $postDet->sort_list_content;
                                                        }
                                                        ?>
                                                        {{ getReadingTime($allContent) }}</span>
                                                @elseif ($getTrendingPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                    <span
                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($getTrendingPost->postVideo->video_content) }}</span>
                                                @elseif ($getTrendingPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                    <span
                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($getTrendingPost->postAudios->audio_content) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        @endif
    </div>
    <!-- banner -->
    <div class="pt-8">
        <div class="container  mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="lg:grid lg:grid-cols-2 xl:gap-8 lg:gap-10">
                <div class>
                    <div class="overflow-hidden relative" x-data="slider">
                        <div class="h-1 shadow absolute top-[400px] left-0 rounded-lg bg-primary w-full z-10"
                            x-ref="progress">
                        </div>
                        <ul class="flex transition-transform duration-700" x-ref="slider">
                            @foreach ($sliderPosts as $sliderPost)
                                <li class="flex-none w-full @if ($loop->iteration <= 1) active @endif relative">
                                    <div class="w-full h-[405px] rounded-lg overflow-hidden relative">
                                        <a href="{{ route('detailPage', $sliderPost->slug) }}" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                                            @if ($sliderPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <div class="image-container">
                                                    <img src="{{ $sliderPost->post_image }}" loading="lazy"
                                                        class="blurred-image w-full h-[405px] object-fill" alt="post-img" />
                                                    <button class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-music text-white"></i>
                                                    </button>
                                                </div>
                                            @elseif($sliderPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                @php
                                                    $thumbUrl = !empty($sliderPost->postVideo) && !empty($sliderPost->postVideo->thumbnail_image_url) ? $sliderPost->postVideo->thumbnail_image_url : null;
                                                    $thumbImage = !empty($sliderPost->postVideo) && !empty($sliderPost->postVideo->uploaded_thumb) ? $sliderPost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                @endphp
                                                <div class="image-container">
                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                        loading="lazy" class="blurred-image w-full h-[405px] object-cover"
                                                        alt="thumb-img" />
                                                    <button class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-play text-white"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <img src="{{ $sliderPost->post_image }}" loading="lazy"
                                                    class="w-full h-full object-cover" alt="post-img" />
                                            @endif
                                        </a>
                                        <a href="{{ route('categoryPage', $sliderPost->category->slug) }}"
                                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 {{ getColorClass($sliderPost->category->id) }}">{!! $sliderPost->category->name !!}</a>
                                    </div>
                                    <div class="pt-8 lg:mb-0 mb-10">
                                        <h1 class="font-bold xl:text-4xl sm:text-3xl text-2xl text-black">
                                            <a href="{{ route('detailPage', $sliderPost->slug) }}"
                                                class="text-decoration-none ms-1">{!! \Illuminate\Support\Str::limit($sliderPost->title, 85, '...') !!}</a>
                                        </h1>
                                        <p class="sm:pt-7 pt-4 text-gray-300 sm:text-base text-sm font-medium">
                                            <a href="{{ route('detailPage', $sliderPost->slug) }}"
                                                class="text-decoration-none ms-1">{!! \Illuminate\Support\Str::limit($sliderPost->description, 60, '...') !!}</a>
                                        </p>
                                        <div class="sm:pt-5 flex flex-wrap">
                                            <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                                <div class="w-8 h-8 rounded-full overflow-hidden mr-4">
                                                    <img src="{{ $sliderPost->user->profile_image }}" loading="lazy"
                                                        class="w-full h-full object-cover" alt="profile-img" />
                                                </div>
                                                <span class="text-gray-200 sm:text-base text-sm font-medium"><a
                                                        href="{{ route('userDetails', $sliderPost->user->username ?? $sliderPost->user->id) }}"
                                                        class="">{{ Str::limit($sliderPost->user->full_name, 20) }}</a></span>
                                            </div>
                                            <div class="flex flex-wrap sm:pt-0 pt-3">
                                                <div class="flex items-center mr-5">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                fill="#C00F24" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        {{ ucfirst(__('messages.common.' . strtolower($sliderPost->created_at->format('F')))) }}
                                                        {{ $sliderPost->created_at->format('d, Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                fill="#C00F24" />
                                                        </svg>
                                                    </div>
                                                    @if (
                                                        $sliderPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                            $sliderPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                $sliderPost->postArticle?->article_content ? $sliderPost->postArticle->article_content : $sliderPost->description,
                                                            ) }}</span>
                                                    @elseif ($sliderPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                        <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                            <?php
                                                            $allContent = '';
                                                            foreach ($sliderPost->postGalleries as $postDet) {
                                                                $allContent .= $postDet->gallery_content;
                                                            }
                                                            ?>
                                                            {{ getReadingTime($allContent) }}</span>
                                                    @elseif ($sliderPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                        <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                            <?php
                                                            $allContent = '';
                                                            foreach ($sliderPost->postSortLists as $postDet) {
                                                                $allContent .= $postDet->sort_list_content;
                                                            }
                                                            ?>
                                                            {{ getReadingTime($allContent) }}</span>
                                                    @elseif ($sliderPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($sliderPost->postVideo->video_content) }}</span>
                                                    @elseif ($sliderPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($sliderPost->postAudios->audio_content) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="">
                    <div class="grid xs:grid-cols-2 xl:gap-8 gap-6">
                        @foreach ($headlinePosts as $row)
                            <div class="">
                                <div class="w-full h-48 rounded-lg overflow-hidden relative">
                                    <a href="{{ route('detailPage', $row->slug) }}" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                                        @if ($row->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                            <div class="image-container">
                                                <img src="{{ $row->post_image }}" loading="lazy"
                                                    class="blurred-image w-full h-48 object-cover" alt="post-img" />
                                                <button class="common-music-icon slider-music-icon highlight-button"
                                                    type="button">
                                                    <i class="icon fa-solid fa-music text-white"></i>
                                                </button>
                                            </div>
                                        @elseif($row->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                            @php
                                                $thumbUrl = !empty($row->postVideo) && !empty($row->postVideo->thumbnail_image_url) ? $row->postVideo->thumbnail_image_url : null;
                                                $thumbImage = !empty($row->postVideo) && !empty($row->postVideo->uploaded_thumb) ? $row->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                            @endphp
                                            <div class="image-container">
                                                <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                    loading="lazy" class="blurred-image w-full h-48 object-cover"
                                                    alt="thumb-img" />
                                                <button class="common-music-icon slider-music-icon highlight-button"
                                                    type="button">
                                                    <i class="icon fa-solid fa-play text-white"></i>
                                                </button>
                                            </div>
                                        @else
                                            <img src="{{ $row->post_image }}" loading="lazy"
                                                class="w-full h-full object-cover" alt="post-img" />
                                        @endif
                                    </a>
                                    <a href="{{ route('categoryPage', $row->category->slug) }}"
                                        class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5 {{ getColorClass($row->category->id) }}">{!! $row->category->name !!}</a>
                                </div>
                                <div class="pt-5">
                                    <h2 class="font-bold xl:text-[22px] sm:text-xl text-lg text-black">
                                        <a href="{{ route('detailPage', $row->slug) }}"
                                            class="fs-16 text-black fw-6">{!! \Illuminate\Support\Str::limit($row->title, 40, '...') !!}</a>
                                    </h2>
                                    <div class="pt-3 flex flex-wrap">
                                        <div class="flex items-center mr-5">
                                            <div class="w-4 h-4 mr-2.5">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                        fill="#C00F24" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($row->created_at->format('M')))) }}
                                                {{ $row->created_at->format('d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-4 h-4 mr-2.5">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                        fill="#C00F24" />
                                                </svg>
                                            </div>
                                            @if ($row->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE || $row->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($row->postArticle?->article_content ? $row->postArticle->article_content : $row->description) }}</span>
                                            @elseif ($row->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($row->postGalleries as $postDet) {
                                                        $allContent .= $postDet->gallery_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($row->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($row->postSortLists as $postDet) {
                                                        $allContent .= $postDet->sort_list_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($row->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($row->postVideo->video_content) }}</span>
                                            @elseif ($row->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($row->postAudios->audio_content) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- category -->
    <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-10">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="text-center relative">
                <div class="lg:text-6xl sm:text-5xl text-4xl pb-3 text-gray-100 font-semibold">
                    {{ __('messages.explore_category') }}
                </div>
                <h3 class="text-black font-semibold lg:text-3xl text-2xl absolute bottom-0 left-0 right-0 mx-auto">
                  {{ __('messages.explore_category') }}
                </h3>
            </div>
            <div class="category-slider mt-10">
                @foreach ($getCategories->where('posts_count', '>', 0) as $getCategory)
                    <div class="lg:px-4 px-3">
                        <a href="{{ route('categoryPage', $getCategory['slug']) }}">
                            <div
                                class="relative rounded-xl overflow-hidden h-[110px] w-[188px] group max-w-[218px] mx-auto">
                                <img src="{{ $getCategory->category_image }}" alt="category" loading="lazy"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#2e2c2ced] group-hover:from-[#C00F24] group-hover:to-[#C00F24] group-hover:opacity-70">
                                </div>
                                <div class="absolute bottom-0 p-4 z-10 text-white">
                                    <h5 class="text-lg font-bold text-white">{{ $getCategory->name }}</h5>
                                    <p class="text-sm font-semibold text-white">{{ $getCategory->posts_count }} Stories</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- advertiesment -->
        @if ($topAd)
            @if (isset($adImageDesktopTop->code))
                <div class="index-top-desktop mx-auto flex justify-center items-center mb-7 mt-7">
                    {!! $adImageDesktopTop->code !!}
                </div>
            @else
                <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop px-4">
                    <div class="container max-w-7xl rounded-xl flex justify-center items-center mx-auto">
                        <a href="{{ $adImageDesktopTop->ad_url }}" target="_blank">
                            <img src="{{ asset($adImageDesktopTop->ad_banner) }}" loading="lazy"
                                class="rounded-xl object-fill">
                        </a>
                    </div>
                </div>
            @endif
            @if (isset($adImageMobileTop->code))
                <div class="index-top-mobile mx-auto flex justify-center items-center mb-7 mt-7">
                    {!! $adImageMobileTop->code !!}
                </div>
            @else
                <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-8 index-top-mobile">
                    <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                        <div class="container max-w-7xl rounded-xl mx-auto flex justify-center items-center">
                            <a href="{{ $adImageMobileTop->ad_url }}" target="_blank">
                                <img src="{{ asset($adImageMobileTop->ad_banner) }}" loading="lazy"
                                    class="rounded-xl md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill"
                                    alt="ad-img">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <!-- what's new -->
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
            @if (!empty($firstHeadlinePost))
                <div class="container  mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                    <div class="flex flex-wrap justify-between items-end border-b">
                        <p class="text-[28px] font-semibold sm:mb-0 mb-2 mr-3">
                            {{ __('messages.details.whats_new') }}
                        </p>
                        <div class="business-tab-section">
                            <div class="flex flex-wrap gap-x-8 w-full">
                                @foreach ($postCategory as $category)
                                    <button
                                        class="text-gray-300 text-sm font-semibold py-2  border-b-2 border-b-transparent {{ $loop->index == 0 ? 'show active !border-b-primary text-primary' : 'border-b' }}"
                                        id="{{ $category->id }}-tab" data-bs-target="#menu-{{ $category->id }}">
                                        {!! $category->name !!}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pt-10">
                        <div class="business-tab-content">
                            @foreach ($postCategory as $category)
                                @php
                                    $catePost = $category->posts->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE);
                                @endphp
                                <div class="tab-pane {{ $loop->index == 0 ? 'active' : 'hidden' }}"
                                    id="menu-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="{{ $category->id }}-tab">
                                    <div class="grid xl:grid-cols-7 lg:grid-cols-9 gap-8">
                                        @php
                                            $firstPost = $catePost->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE)->first();
                                        @endphp
                                        <div class="xl:col-span-4 lg:col-span-5">
                                            <div class="">
                                                <div class="w-full h-[405px] rounded-lg overflow-hidden">
                                                    <a href="{{ route('detailPage', $firstPost->slug) }}">
                                                        @if ($firstPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                            <div class="image-container">
                                                                <img src="{{ $firstPost->post_image }}" loading="lazy"
                                                                    class="blurred-image w-full h-[405px] object-cover"
                                                                    alt="post-img" />
                                                                <button
                                                                    class="common-music-icon slider-music-icon highlight-button"
                                                                    type="button">
                                                                    <i class="icon fa-solid fa-music text-white"></i>
                                                                </button>
                                                            </div>
                                                        @elseif($firstPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                            @php
                                                                $thumbUrl = !empty($firstPost->postVideo) && !empty($firstPost->postVideo->thumbnail_image_url) ? $firstPost->postVideo->thumbnail_image_url : null;
                                                                $thumbImage = !empty($firstPost->postVideo) && !empty($firstPost->postVideo->uploaded_thumb) ? $firstPost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                            @endphp
                                                            <div class="image-container">
                                                                <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                                    loading="lazy"
                                                                    class="blurred-image w-full h-[405px] object-cover"
                                                                    alt="thumb-img" />
                                                                <button
                                                                    class="common-music-icon slider-music-icon highlight-button"
                                                                    type="button">
                                                                    <i class="icon fa-solid fa-play text-white"></i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <img src="{{ $firstPost->post_image }}" loading="lazy"
                                                                class="w-full h-full object-cover" alt="post-img" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="pt-8">
                                                    <a href="{{ route('detailPage', $firstPost->slug) }}">
                                                        <h1 class="font-bold xl:text-4xl sm:text-3xl text-2xl text-black">
                                                            {!! $firstPost->title !!}
                                                        </h1>
                                                    </a>
                                                    <a href="{{ route('detailPage', $firstPost->slug) }}">
                                                        <p class="pt-7 text-gray-300 sm:text-base text-sm font-medium">
                                                            {!! \Illuminate\Support\Str::limit($firstPost->description, 200, '...') !!}
                                                        </p>
                                                    </a>
                                                    <div class="sm:pt-5 flex flex-wrap">
                                                        <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                                            <div class="w-8 h-8 rounded-full overflow-hidden mr-4">

                                                                <img src="{{ $firstPost->user->profile_image }}"
                                                                    loading="lazy" class="w-full h-full object-cover"
                                                                    alt="profile-img" />
                                                            </div>
                                                            <span class="text-gray-200 sm:text-base text-sm font-medium"><a
                                                                    href="{{ route('userDetails', $firstPost->user->username ?? $firstPost->user->id) }}"
                                                                    class="">{{ Str::limit($firstPost->user->full_name, 30) }}</a></span>
                                                        </div>
                                                        <div class="flex flex-wrap sm:pt-0 pt-3">
                                                            <div class="flex items-center mr-5">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($firstPost->created_at->format('M')))) }}
                                                                    {{ $firstPost->created_at->format('d, Y') }}</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                @if (
                                                                    $firstPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                                        $firstPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                            $firstPost->postArticle?->article_content ? $firstPost->postArticle->article_content : $firstPost->description,
                                                                        ) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($firstPost->postGalleries as $postDet) {
                                                                            $allContent .= $postDet->gallery_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($firstPost->postSortLists as $postDet) {
                                                                            $allContent .= $postDet->sort_list_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($firstPost->postVideo->video_content) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($firstPost->postAudios->audio_content) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $sidePosts = $catePost
                                                ->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE)
                                                ->skip(1)
                                                ->take(8);
                                        @endphp
                                        <div
                                            class="xl:col-span-3 lg:col-span-4 max-h-[665px] custom-scrollbar overflow-auto pr-3">
                                            @foreach ($sidePosts as $sidePost)
                                                <div class="xs:flex mb-8">
                                                    <div
                                                        class="xs:w-[200px] w-full h-[135px] min-w-[200px] w-full rounded-lg overflow-hidden xs:mr-5 xs:mb-0 mb-4">
                                                        <a href="{{ route('detailPage', $sidePost->slug) }}">
                                                            @if ($sidePost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                <div class="image-container">
                                                                    <img src="{{ $sidePost->post_image }}" loading="lazy"
                                                                        class="blurred-image w-full h-[135px] object-cover"
                                                                        alt="post-img" />
                                                                    <button
                                                                        class="common-music-icon slider-music-icon highlight-button"
                                                                        type="button">
                                                                        <i class="icon fa-solid fa-music text-white"></i>
                                                                    </button>
                                                                </div>
                                                            @elseif($sidePost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                @php
                                                                    $thumbUrl = !empty($sidePost->postVideo) && !empty($sidePost->postVideo->thumbnail_image_url) ? $sidePost->postVideo->thumbnail_image_url : null;
                                                                    $thumbImage = !empty($sidePost->postVideo) && !empty($sidePost->postVideo->uploaded_thumb) ? $sidePost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                                @endphp
                                                                <div class="image-container">
                                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                                        loading="lazy"
                                                                        class="blurred-image w-full h-[135px] object-cover"
                                                                        alt="thumb-img" />
                                                                    <button
                                                                        class="common-music-icon slider-music-icon highlight-button"
                                                                        type="button">
                                                                        <i class="icon fa-solid fa-play text-white"></i>
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <img src="{{ $sidePost->post_image }}" loading="lazy"
                                                                    class="w-full h-full object-cover" alt="post-img" />
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <p class="text-base font-semibold mb-2 line-clamp-3">
                                                            <a href="{{ route('detailPage', $sidePost->slug) }}"
                                                                class="">{!! $sidePost->title !!}
                                                            </a>
                                                        </p>
                                                        <div class="flex flex-wrap pt-3">
                                                            <div class="flex items-center mr-5">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($sidePost->created_at->format('M')))) }}
                                                                    {{ $sidePost->created_at->format('d, Y') }}</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="text-gray-200 sm:text-base text-sm font-medium">
                                                                    @if (
                                                                        $sidePost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                                            $sidePost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                                        <span
                                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                                $sidePost->postArticle?->article_content ? $sidePost->postArticle->article_content : $sidePost->description,
                                                                            ) }}</span>
                                                                    @elseif ($sidePost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                                        <span
                                                                            class="text-gray-200 sm:text-base text-sm font-medium">
                                                                            <?php
                                                                            $allContent = '';
                                                                            foreach ($sidePost->postGalleries as $postDet) {
                                                                                $allContent .= $postDet->gallery_content;
                                                                            }
                                                                            ?>
                                                                            {{ getReadingTime($allContent) }}</span>
                                                                    @elseif ($sidePost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                                        <span
                                                                            class="text-gray-200 sm:text-base text-sm font-medium">
                                                                            <?php
                                                                            $allContent = '';
                                                                            foreach ($sidePost->postSortLists as $postDet) {
                                                                                $allContent .= $postDet->sort_list_content;
                                                                            }
                                                                            ?>
                                                                            {{ getReadingTime($allContent) }}</span>
                                                                    @elseif ($sidePost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                        <span
                                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($sidePost->postVideo->video_content) }}</span>
                                                                    @elseif ($sidePost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                        <span
                                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($sidePost->postAudios->audio_content) }}</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="tab-pane hidden">Entertainment</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- voting poll -->
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="grid xl:grid-cols-3 md:grid-cols-2 xl:gap-x-8 gap-8">
                    @if (!empty($getPoll->count()))
                        <div class="light-gray-bg rounded-xl xs:p-5 p-4 h-[340px] custom-scrollbar overflow-auto">
                            <h5 class="font-semibold xl:text-[22px] sm:text-xl text-lg text-black mb-4">
                                Voting Poll
                            </h5>
                            @php $styleCss = ':style'; @endphp
                            @foreach ($getPoll as $poll)
                                <p class="text-primary text-sm font-medium mb-3">
                                    {!! $poll['question'] !!}
                                </p>
                                <form class="poll-vote-form" id="pollVoteFormTailwind">
                                    @csrf
                                    <input type="hidden" id="pollId" name="poll_id" value="{{ $poll['id'] }}">
                                    <div class="mb-2" id="pollOption{{ $poll->id }}">
                                        <div class="option-poll">
                                            <div class="grid xs:grid-cols-2 gap-3 mb-7">
                                                @foreach ($getOption as $option)
                                                    @if (!empty($poll->$option))
                                                        <div class="flex items-center">
                                                            <label class="inline-flex">
                                                                <input type="radio" class="hidden poll-answer"
                                                                    name="answer"
                                                                    id="pollAnswer-{{ $option }}-{{ $poll['id'] }}"
                                                                    value="{{ $poll[$option] }}">
                                                                <div
                                                                    class="w-5 h-5 border border-gray-200 rounded-full flex items-center justify-center custom-radio-button">
                                                                    <div
                                                                        class="w-3 h-3 bg-primary rounded-full hidden radio-dot">
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <span
                                                                class="ml-5 font-medium text-sm pollAnswer-{{ $option }}-{{ $poll['id'] }}">{!! $poll[$option] !!}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="text-primary" id="voteError{{ $poll->id }}"></span>
                                        <div class="flex xs:gap-5 gap-3 mb-4">
                                            <div class="w-1/2"> <button type="submit"
                                                    class="block w-full text-black font-semibold p-2.5 text-sm rounded-full border border-gray-200 text-center"
                                                    data-id="{{ $poll['id'] }}">{{ __('messages.details.vote') }}</button>
                                            </div>
                                            <div class="w-1/2"> <a href="javascript:void(0);"
                                                    class="block w-full text-black font-semibold p-2.5 text-sm rounded-full border border-gray-200 text-center view-statistic-tailwind"
                                                    data-id="{{ $poll->id }}">{{ __('messages.details.view_results') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="pollStatistic{{ $poll->id }}" class="mb-2 hidden">
                                    @php $vote = getPollStatistics($poll->id) @endphp
                                    <div class="result-poll">
                                        <div class="grid xs:grid-cols-2 gap-4 mb-7">
                                            @foreach ($vote['optionAns'] as $pollName => $statistic)
                                                <div class="">
                                                    <div class="flex mb-1 items-center justify-between">
                                                        <div> <span class="font-medium text-sm"> {{ $pollName }}
                                                            </span> </div>
                                                        <div class="text-right"> <span
                                                                class="text-primary font-semibold text-xs">
                                                                {{ $statistic }}%
                                                            </span> </div>
                                                    </div>
                                                    <div class="bg-[#dde0e5] h-1.5 w-full rounded-full"
                                                        x-data="{ val: {{ $statistic }}, start: 1 }" x-init="setTimeout(() => start = val, 100)">
                                                        <div class="bg-gray-200 h-1.5 w-1 rounded-full transition-all"
                                                            {{ $styleCss }}="`width: ${start}%; transition: 3s;`">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="flex xs:gap-5 gap-3">
                                            <div class="w-1/2">
                                                <a href=""
                                                    class="block text-primary font-semibold p-2.5 text-sm rounded-full text-center">{{ __('messages.poll.total_vote') }}:{{ $vote['totalPollResults'] }}</a>
                                            </div>
                                            <div class="w-1/2">
                                                <a href="javascript:void(0);"
                                                    class="view-option-tailwind block w-full text-black font-semibold p-2.5 text-sm rounded-full border border-gray-200 text-center"
                                                    data-id="{{ $poll->id }}">{{ __('messages.details.view_options') }}
                                                </a>
                                            </div>
                                            <span class="text-primary" id="voteSuccess{{ $poll->id }}">
                                                <p> </p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                        <div class="rounded-xl flex justify-center items-center">
                            @if ($bottomAd)
                                @if (isset($adImageMobileBottom->code))
                                    <div class="rounded-xl flex justify-center items-center mx-auto">
                                        <a href="{{ $adImageMobileBottom->ad_url }}" target="_blank">
                                            {!! $adImageMobileBottom->code !!}
                                        </a>
                                    </div>
                                @else
                                    <div class="rounded-xl flex justify-center items-center mx-auto">
                                        <a href="{{ $adImageMobileBottom->ad_url }}" target="_blank">
                                            <img src="{{ asset($adImageMobileBottom->ad_banner) }}" loading="lazy"
                                                class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl"
                                                alt="ad-img">
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    <!-- advertiesment -->
                    <!-- tag -->
                    @if (!empty(getPopularTags()))
                    <div class="light-gray-bg rounded-xl h-[340px] custom-scrollbar overflow-auto">
                        <?php $maxIterations = 30; ?>
                        @include('theme1.popular_tag', ['maxIterations' => $maxIterations])
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- most popular -->
        @if (isset($latestPosts) && !$latestPosts->isEmpty())
            <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
                <div class="container  mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                    <div class="grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <div class="flex flex-wrap justify-between items-center border-b">
                                <p class="text-[28px] font-semibold mb-2 mr-3">{{ __('messages.details.latest_news') }}
                                </p>
                                <div class="ms-auto">
                                    <a href="{{ route('allPosts') }}"
                                        class="text-primary font-semibold text-base">{{ __('messages.details.view_more') }}</a>
                                </div>
                            </div>
                            <div class="grid xs:grid-cols-2 xl:gap-8 gap-6 pt-10">
                                @foreach ($latestPosts as $news)
                                    <div class="">
                                        <div class="w-full h-[215px] rounded-lg overflow-hidden relative">
                                            <a href="{{ route('detailPage', $news['slug']) }}" aria-label="latest-news" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                                                @if ($news['post_types'] == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                    <div class="image-container">
                                                        <img src="{{ $news['post_image'] }}" loading="lazy"
                                                            class="blurred-image w-full h-[215px] object-cover"
                                                            alt="post-img" />
                                                        <button
                                                            class="common-music-icon slider-music-icon highlight-button"
                                                            type="button">
                                                            <i class="icon fa-solid fa-music text-white"></i>
                                                        </button>
                                                    </div>
                                                @elseif($news['post_types'] == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                    @php
                                                        $thumbUrl =
                                                            !empty($news->postVideo) &&
                                                            !empty($news->postVideo->thumbnail_image_url)
                                                                ? $news->postVideo->thumbnail_image_url
                                                                : null;
                                                        $thumbImage =
                                                            !empty($news->postVideo) &&
                                                            !empty($news->postVideo->uploaded_thumb)
                                                                ? $news->postVideo->uploaded_thumb
                                                                : asset('front_web/images/default.jpg');
                                                    @endphp
                                                    <div class="image-container">
                                                        <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                            loading="lazy"
                                                            class="blurred-image w-full h-[215px] object-cover"
                                                            alt="thumb-img" />
                                                        <button
                                                            class="common-music-icon slider-music-icon highlight-button"
                                                            type="button">
                                                            <i class="icon fa-solid fa-play text-white"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    <img src="{{ $news['post_image'] }}" alt="" loading="lazy"
                                                        class="w-full h-[215px] object-cover" alt="post-img" />
                                                @endif
                                            </a>
                                            <a href=""
                                                class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5">{!! $news['category']['name'] !!}</a>
                                        </div>
                                        <div class="pt-5">
                                            <h2 class="font-bold xl:text-[22px] sm:text-xl text-lg text-black">
                                                <a href="{{ route('detailPage', $news['slug']) }}" class="">
                                                    {!! $news['title'] !!}
                                                </a>
                                            </h2>
                                            <div class="pt-3 flex flex-wrap">
                                                <div class="flex items-center mr-5">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    <span
                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($news->created_at->format('M')))) }}{{ \Carbon\Carbon::parse($news['created_at'])->format(' d, Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    @if ($news->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE || $news->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                $news->postArticle?->article_content ? $news->postArticle->article_content : $news->description,
                                                            ) }}</span>
                                                    @elseif ($news->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                        <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                            <?php
                                                            $allContent = '';
                                                            foreach ($news->postGalleries as $postDet) {
                                                                $allContent .= $postDet->gallery_content;
                                                            }
                                                            ?>
                                                            {{ getReadingTime($allContent) }}</span>
                                                    @elseif ($news->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                        <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                            <?php
                                                            $allContent = '';
                                                            foreach ($news->postSortLists as $postDet) {
                                                                $allContent .= $postDet->sort_list_content;
                                                            }
                                                            ?>
                                                            {{ getReadingTime($allContent) }}</span>
                                                    @elseif ($news->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($news->postVideo->video_content) }}</span>
                                                    @elseif ($news->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                        <span
                                                            class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($news->postAudios->audio_content) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($loop->iteration >= 4)
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @include('theme1.recommended', ['getRecommendedPost' => getRecommendedPost()->take(6)])
                </div>
            </div>
        </div>
    @endif
    <!-- breaking-news -->
    @if (getBreakingPost()->isNotEmpty())
        <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-8">
            <div class="container  mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="lg:flex lg:gap-8 gap-10">
                    <div class="lg:basis-1/3 lg:mb-0 mb-8">
                        <div class="">
                            @if ($bottomAd)
                                @if (isset($adImageMobileBottom->code))
                                    <div class="mb-8">
                                        <div class="rounded-xl flex justify-center items-center mx-auto">
                                            {!! $adImageMobileBottom->code !!}
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-8">
                                        <div class="mx-auto rounded-xl flex justify-center items-center">
                                            <a href="{{ $adImageMobileBottom->ad_url }}" target="_blank">
                                                <img src="{{ asset($adImageMobileBottom->ad_banner) }}"
                                                    loading="lazy"
                                                    class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl"
                                                    alt="ad-img" />
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <!-- most read -->
                            <div class="light-gray-bg rounded-lg">
                                @if (!empty(array_filter(getPopularNews())))
                                    @include('theme1.most_read', ['popularNews' => array_slice(getPopularNews(), 0, 7)])
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="lg:basis-2/3">
                        <div class="flex flex-wrap justify-between items-center border-b">
                            <p class="text-[28px] font-semibold mb-2 mr-3">{{ __('messages.details.breaking') }}
                            </p>
                            <div class="ms-auto">
                                <a href="{{ route('allPosts') }}"
                                    class="text-primary font-semibold text-base">{{ __('messages.details.view_more') }}</a>
                            </div>
                        </div>
                        <div class="pt-10">
                            @foreach (getBreakingPost()->take(5) as $brekingPost)
                                <div class="sm:flex mb-8">
                                    <div
                                        class="sm:w-[328px] h-[205px] sm:min-w-[328px] w-full rounded-lg overflow-hidden md:mr-5 sm:mr-4 sm:mb-0 mb-4 relative">
                                        <a href="{{ route('detailPage', $brekingPost->slug) }}" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                                            @if ($brekingPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <div class="image-container">
                                                    <img src="{{ $brekingPost->post_image }}" loading="lazy"
                                                        class="blurred-image w-full h-[205px] object-cover"
                                                        alt="post-img" />
                                                    <button
                                                        class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-music text-white"></i>
                                                    </button>
                                                </div>
                                            @elseif($brekingPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                @php
                                                    $thumbUrl = !empty($brekingPost->postVideo) && !empty($brekingPost->postVideo->thumbnail_image_url) ? $brekingPost->postVideo->thumbnail_image_url : null;
                                                    $thumbImage = !empty($brekingPost->postVideo) && !empty($brekingPost->postVideo->uploaded_thumb) ? $brekingPost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                @endphp
                                                <div class="image-container">
                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                        loading="lazy"
                                                        class="blurred-image w-full h-[205px] object-cover"
                                                        alt="thumb-img" />
                                                    <button
                                                        class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-play text-white"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <img src="{{ $brekingPost->post_image }}" loading="lazy"
                                                    class="w-full h-[205px] object-cover" alt="post-img" />
                                            @endif
                                        </a>
                                        <a href="{{ route('categoryPage', $brekingPost->category->slug) }}"
                                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5">{{ $brekingPost->category->name }}</a>
                                    </div>
                                    <div class="">
                                        <p class="md:text-[22px] text-lg font-semibold mb-2">
                                            <a href="{{ route('detailPage', $brekingPost->slug) }}">
                                                {!! $brekingPost->title !!}</a>
                                        </p>
                                        <p class="pt-3 text-gray-300 sm:text-base text-sm font-medium line-clamp-3">
                                            {!! Str::limit($brekingPost->description, 220) !!}
                                        </p>
                                        <div class="sm:pt-5 flex flex-wrap">
                                            <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                                <div class="w-8 h-8 rounded-full overflow-hidden mr-4">
                                                    <img src="{{ $brekingPost->user->profile_image }}"
                                                        loading="lazy" class="w-full h-full object-cover"
                                                        alt="profile-img" />
                                                </div>
                                                <span class="text-gray-200 sm:text-base text-sm font-medium mt-3"><a
                                                        href="{{ route('userDetails', $brekingPost->user->username ?? $brekingPost->user->id) }}"
                                                        class="text-black">{{ Str::limit($brekingPost->user->full_name, 10) }}</a></span>
                                            </div>
                                            <div class="flex flex-wrap sm:pt-0 pt-3 sm:pt-2">
                                                <div class="flex items-center mr-5">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        {{ ucfirst(__('messages.common.' . strtolower($brekingPost->created_at->format('M')))) }}
                                                        {{ $brekingPost->created_at->format('d , Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        @if (
                                                            $brekingPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                                $brekingPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                    $brekingPost->postArticle?->article_content
                                                                        ? $brekingPost->postArticle->article_content
                                                                        : $brekingPost->description,
                                                                ) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">
                                                                <?php
                                                                $allContent = '';
                                                                foreach ($brekingPost->postGalleries as $postDet) {
                                                                    $allContent .= $postDet->gallery_content;
                                                                }
                                                                ?>
                                                                {{ getReadingTime($allContent) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">
                                                                <?php
                                                                $allContent = '';
                                                                foreach ($brekingPost->postSortLists as $postDet) {
                                                                    $allContent .= $postDet->sort_list_content;
                                                                }
                                                                ?>
                                                                {{ getReadingTime($allContent) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($brekingPost->postVideo->video_content) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($brekingPost->postAudios->audio_content) }}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- <div class="grid lg:grid-cols-3 lg:gap-8 gap-10">
                    <div class="">
                        <!-- advertiesment -->
                        <div class="pb-8 lg:h-3/5 h-40">
                            <div class="border bg-gray-100 rounded-xl h-full flex justify-center items-center">
                                <a href="#!" class="text-xl font-semibold">Advertiesment</a>
                            </div>
                        </div>
                        <!-- most read -->
                        <div class="bg-gray-100 rounded-lg">
                            @include('theme1.most_read')

                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="flex flex-wrap justify-between items-center border-b">
                            <p class="text-[28px] font-semibold mb-2 mr-3">{{ __('messages.details.breaking') }}
                            </p>
                            <div class="ms-auto">
                                <a href="{{ route('allPosts') }}"
                                    class="text-primary font-semibold text-base">{{ __('messages.details.view_more') }}</a>
                            </div>
                        </div>
                        <div class="pt-10">
                            @foreach (getBreakingPost()->take(5) as $brekingPost)
                                <div class="sm:flex mb-8">
                                    <div
                                        class="sm:w-[328px] h-[205px] sm:min-w-[328px] w-full rounded-lg overflow-hidden md:mr-5 sm:mr-4 sm:mb-0 mb-4 relative">
                                        <a href="{{ route('detailPage', $brekingPost->slug) }}">
                                            @if ($brekingPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <div class="image-container">
                                                    <img src="{{ $brekingPost->post_image }}"
                                                        class="blurred-image w-full h-[205px] object-cover" alt="post-img"/>
                                                    <button
                                                        class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-music text-white"></i>
                                                    </button>
                                                </div>
                                            @elseif($brekingPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                @php
                                                    $thumbUrl = !empty($brekingPost->postVideo) && !empty($brekingPost->postVideo->thumbnail_image_url) ? $brekingPost->postVideo->thumbnail_image_url : null;
                                                    $thumbImage = !empty($brekingPost->postVideo) && !empty($brekingPost->postVideo->uploaded_thumb) ? $brekingPost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                @endphp
                                                <div class="image-container">
                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                        class="blurred-image w-full h-[205px] object-cover" alt="thumb-img"/>
                                                    <button
                                                        class="common-music-icon slider-music-icon highlight-button"
                                                        type="button">
                                                        <i class="icon fa-solid fa-play text-white"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <img src="{{ $brekingPost->post_image }}"
                                                    class="w-full h-[205px] object-cover" alt="post-img" />
                                            @endif
                                        </a>
                                        <a href="{{ route('categoryPage', $brekingPost->category->slug) }}"
                                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5">{{ $brekingPost->category->name }}</a>
                                    </div>
                                    <div class="">
                                        <h5 class="md:text-[22px] text-lg font-semibold mb-2">
                                            <a href="{{ route('detailPage', $brekingPost->slug) }}">
                                                {!! $brekingPost->title !!}</a>
                                        </h5>
                                        <p class="pt-3 text-gray-300 sm:text-base text-sm font-medium line-clamp-3">
                                            {!! Str::limit($brekingPost->description, 220) !!}
                                        </p>
                                        <div class="sm:pt-5 flex flex-wrap">
                                            <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                                <div class="w-8 h-8 rounded-full overflow-hidden mr-4">
                                                    <img src="{{ $brekingPost->user->profile_image }}"
                                                        class="w-full h-full object-cover" alt="profile-img"/>
                                                </div>
                                                <span class="text-gray-200 sm:text-base text-sm font-medium"><a
                                                        href="{{ route('userDetails', $brekingPost->user->username ?? $brekingPost->user->id) }}"
                                                        class="text-black">
                                                        {{ $brekingPost->user->full_name }}</a></span>
                                            </div>
                                            <div class="flex flex-wrap sm:pt-0 pt-3">
                                                <div class="flex items-center mr-5">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        {{ ucfirst(__('messages.common.' . strtolower($brekingPost->created_at->format('M')))) }}
                                                        {{ $brekingPost->created_at->format('d , Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 mr-2.5">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                fill="#C00F24"></path>
                                                        </svg>
                                                    </div>
                                                    <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                        @if ($brekingPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE || $brekingPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                    $brekingPost->postArticle?->article_content
                                                                        ? $brekingPost->postArticle->article_content
                                                                        : $brekingPost->description,
                                                                ) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">
                                                                <?php
                                                                $allContent = '';
                                                                foreach ($brekingPost->postGalleries as $postDet) {
                                                                    $allContent .= $postDet->gallery_content;
                                                                }
                                                                ?>
                                                                {{ getReadingTime($allContent) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">
                                                                <?php
                                                                $allContent = '';
                                                                foreach ($brekingPost->postSortLists as $postDet) {
                                                                    $allContent .= $postDet->sort_list_content;
                                                                }
                                                                ?>
                                                                {{ getReadingTime($allContent) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($brekingPost->postVideo->video_content) }}</span>
                                                        @elseif ($brekingPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($brekingPost->postAudios->audio_content) }}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    @endif
    <!-- advertiesment -->
    @if ($bottomAd)
        @if (isset($adImageDesktopBottom->code))
            <div class="container index-top-desktop ad-space-url-desktop mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                {!! $adImageDesktopBottom->code !!}
            </div>
        @else
            <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop px-4">
                <div class="container max-w-7xl rounded-xl flex justify-center items-center mx-auto">
                    <a href="{{ $adImageDesktopBottom->ad_url }}" target="_blank">
                        <img src="{{ asset($adImageDesktopBottom->ad_banner) }}" loading="lazy"
                            class="rounded-xl object-fill">
                    </a>
                </div>
            </div>
        @endif
        @if (isset($adImageMobileBottom->code))
            <div class="index-top-mobile mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                {!! $adImageMobileBottom->code !!}
            </div>
        @else
            <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-8 index-top-mobile">
                <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                    <div class="lg:flex lg:gap-8 gap-10">
                        <div class="rounded-xl flex justify-center items-center mx-auto">
                            <a href="{{ $adImageMobileBottom->ad_url }}" target="_blank">
                                <img src="{{ asset($adImageMobileBottom->ad_banner) }}" loading="lazy" class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl" alt="ad-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <!-- featured post -->
    @if (!$featurePostCategory->isEmpty())
        <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-8">
            <div class="container  mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="flex flex-wrap justify-between items-end border-b">
                    <p class="text-[28px] font-semibold sm:mb-0 mb-2 mr-3">
                        {{ __('messages.details.featured_post') }}
                    </p>
                    <div class="featured-tab-section">
                        <div class="flex flex-wrap gap-x-8 w-full">
                            @foreach ($featurePostCategory as $category)
                                <button
                                    class="text-gray-300 text-sm font-semibold py-2  border-b-2 border-b-transparent {{ $loop->index == 0 ? 'show active !border-b-primary text-primary' : 'border-b' }}"
                                    id="{{ $category->id }}-f-tab" data-bs-target="#menu-f-{{ $category->id }}">
                                    {!! $category->name !!}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pt-10">
                    <div class="featured-tab-content">
                        @foreach ($featurePostCategory as $category)
                            @php
                                $featCatePost = $category->posts->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE);
                            @endphp
                            @if (!empty($featCatePost->first()))
                                <div class="tab-pane fade featured-post {{ $loop->index == 0 ? 'show active' : 'hidden' }}"
                                    id="menu-f-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="{{ $category->id }}-f-tab">
                                    <div class="grid xl:grid-cols-7 lg:grid-cols-9 gap-8">
                                        <div
                                            class="xl:col-span-3 lg:col-span-4 max-h-[665px] custom-scrollbar overflow-auto pr-3">
                                            @foreach ($featCatePost->where('featured', 1)->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE)->skip(1)->sortByDesc('id') as $posts)
                                                <div class="xs:flex mb-8">
                                                    <div
                                                        class="xs:w-[200px] w-full h-[135px] min-w-[200px] w-full rounded-lg overflow-hidden xs:mr-5 xs:mb-0 mb-4">
                                                        <a href="{{ route('detailPage', $posts->slug) }}">
                                                            @if ($posts->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                <div class="image-container">
                                                                    <img src="{{ $posts->post_image }}"
                                                                        loading="lazy"
                                                                        class="blurred-image w-full h-[135px] object-cover"
                                                                        alt="post-img" />
                                                                    <button
                                                                        class="common-music-icon slider-music-icon highlight-button"
                                                                        type="button">
                                                                        <i
                                                                            class="icon fa-solid fa-music text-white"></i>
                                                                    </button>
                                                                </div>
                                                            @elseif($posts->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                @php
                                                                    $thumbUrl = !empty($posts->postVideo) && !empty($posts->postVideo->thumbnail_image_url) ? $posts->postVideo->thumbnail_image_url : null;
                                                                    $thumbImage = !empty($posts->postVideo) && !empty($posts->postVideo->uploaded_thumb) ? $posts->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                                @endphp
                                                                <div class="image-container">
                                                                    <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                                        loading="lazy"
                                                                        class="blurred-image w-full h-[135px] object-cover"
                                                                        alt="thumb-img" />
                                                                    <button
                                                                        class="common-music-icon slider-music-icon highlight-button"
                                                                        type="button">
                                                                        <i
                                                                            class="icon fa-solid fa-play text-white"></i>
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <img src="{{ $posts->post_image }}" loading="lazy"
                                                                    class="w-full h-[135px] object-cover"
                                                                    alt="post-img" />
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <p class="text-base font-semibold mb-2 line-clamp-3">
                                                            <a href="{{ route('detailPage', $posts->slug) }}"
                                                                class="">{!! \Illuminate\Support\Str::limit($posts->title, 80, '...') !!}</a>
                                                        </p>
                                                        <div class="flex flex-wrap pt-3 sm:pt-2">
                                                            <div class="flex items-center mr-5">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($posts->created_at->format('M')))) }}
                                                                    {{ $posts->created_at->format('d, Y') }}</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                @if (
                                                                    $posts->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                                        $posts->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                            $posts->postArticle?->article_content ? $posts->postArticle->article_content : $posts->description,
                                                                        ) }}</span>
                                                                @elseif ($posts->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($posts->postGalleries as $postDet) {
                                                                            $allContent .= $postDet->gallery_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($posts->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($posts->postSortLists as $postDet) {
                                                                            $allContent .= $postDet->sort_list_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($posts->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($posts->postVideo->video_content) }}</span>
                                                                @elseif ($posts->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($posts->postAudios->audio_content) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="xl:col-span-4 lg:col-span-5">
                                            @php
                                                $firstPost = $featCatePost
                                                    ->where('featured', 1)
                                                    ->where('visibility', \App\Models\Post::VISIBILITY_ACTIVE)
                                                    ->first();
                                            @endphp
                                            <div class="">
                                                <div class="w-full h-[405px] rounded-lg overflow-hidden">
                                                    <a href="{{ route('detailPage', $firstPost->slug) }}">
                                                        @if ($firstPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                            <div class="image-container">
                                                                <img src="{{ $firstPost->post_image }}"
                                                                    loading="lazy"
                                                                    class="blurred-image w-full h-[405px] object-cover"
                                                                    alt="post-img" />
                                                                <button
                                                                    class="common-music-icon slider-music-icon highlight-button"
                                                                    type="button">
                                                                    <i class="icon fa-solid fa-music text-white"></i>
                                                                </button>
                                                            </div>
                                                        @elseif($firstPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                            @php
                                                                $thumbUrl = !empty($firstPost->postVideo) && !empty($firstPost->postVideo->thumbnail_image_url) ? $firstPost->postVideo->thumbnail_image_url : null;
                                                                $thumbImage = !empty($firstPost->postVideo) && !empty($firstPost->postVideo->uploaded_thumb) ? $firstPost->postVideo->uploaded_thumb : asset('front_web/images/default.jpg');
                                                            @endphp
                                                            <div class="image-container">
                                                                <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                                    loading="lazy"
                                                                    class="blurred-image w-full h-[405px] object-cover"
                                                                    alt="thumb-img" />
                                                                <button
                                                                    class="common-music-icon slider-music-icon highlight-button"
                                                                    type="button">
                                                                    <i class="icon fa-solid fa-play text-white"></i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <img src="{{ $firstPost->post_image }}" loading="lazy"
                                                                class="w-full h-[405px] object-cover"
                                                                alt="post-img" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="pt-8">
                                                    <h1 class="font-bold xl:text-4xl sm:text-3xl text-2xl text-black">
                                                        <a href="{{ route('detailPage', $firstPost->slug) }}"
                                                            class="">{!! $firstPost->title !!}</a>
                                                    </h1>
                                                    <p class="pt-7 text-gray-300 sm:text-base text-sm font-medium">
                                                        <a href="{{ route('detailPage', $firstPost->slug) }}"
                                                            class="">{!! \Illuminate\Support\Str::limit($firstPost->description, 220, '...') !!}</a>
                                                    </p>
                                                    <div class="sm:pt-5 flex flex-wrap">
                                                        <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                                            <div class="w-8 h-8 rounded-full overflow-hidden mr-4">
                                                                <img src="{{ $firstPost->user->profile_image }}"
                                                                    loading="lazy" class="w-full h-full object-cover"
                                                                    alt="profile-img" />
                                                            </div>
                                                            <span
                                                                class="text-gray-200 sm:text-base text-sm font-medium"><a
                                                                    href="{{ route('userDetails', $firstPost->user->username ?? $firstPost->user->id) }}"
                                                                    class="">
                                                                    {{  Str::limit($firstPost->user->full_name, 30) }}</a></span>
                                                        </div>
                                                        <div class="flex flex-wrap sm:pt-0 pt-3 sm:pt-2">
                                                            <div class="flex items-center mr-5">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($firstPost->created_at->format('M')))) }}
                                                                    {{ $firstPost->created_at->format('d, Y') }}</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="w-4 h-4 mr-2.5">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                                                            fill="#C00F24"></path>
                                                                    </svg>
                                                                </div>
                                                                @if (
                                                                    $firstPost->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE ||
                                                                        $firstPost->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                                            $firstPost->postArticle?->article_content ? $firstPost->postArticle->article_content : $firstPost->description,
                                                                        ) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($firstPost->postGalleries as $postDet) {
                                                                            $allContent .= $postDet->gallery_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">
                                                                        <?php
                                                                        $allContent = '';
                                                                        foreach ($firstPost->postSortLists as $postDet) {
                                                                            $allContent .= $postDet->sort_list_content;
                                                                        }
                                                                        ?>
                                                                        {{ getReadingTime($allContent) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($firstPost->postVideo->video_content) }}</span>
                                                                @elseif ($firstPost->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                                    <span
                                                                        class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($firstPost->postAudios->audio_content) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@endsection
