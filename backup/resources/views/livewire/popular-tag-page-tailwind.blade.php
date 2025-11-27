<div class="pt-10">
    @if ($popularTag->count() > 0)
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="lg:grid lg:grid-cols-3 gap-8">
                <div class="col-span-2 sm:mb-0">
                    @foreach ($popularTag->take(5) as $post)
                        <div class="sm:flex mb-8">
                            <div
                                class="sm:w-[328px] h-[205px] sm:min-w-[328px] w-full rounded-lg overflow-hidden md:mr-5 sm:mr-4 sm:mb-0 mb-4 relative">
                                <a href="{{ route('detailPage', $post->slug) }}">
                                    @if ($post->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                        <div class="image-container">
                                            <img src="{{ $post->post_image }}"
                                                class="blurred-image w-full h-[205px] object-cover" loading="lazy" />
                                            <button class="common-music-icon slider-music-icon highlight-button"
                                                type="button">
                                                <i class="icon fa-solid fa-music text-white"></i>
                                            </button>
                                        </div>
                                    @elseif($post->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                        @php
                                            $thumbUrl =
                                                !empty($post->postVideo) &&
                                                !empty($post->postVideo->thumbnail_image_url)
                                                    ? $post->postVideo->thumbnail_image_url
                                                    : null;
                                            $thumbImage =
                                                !empty($post->postVideo) && !empty($post->postVideo->uploaded_thumb)
                                                    ? $post->postVideo->uploaded_thumb
                                                    : asset('front_web/images/default.jpg');
                                        @endphp
                                        <div class="image-container">
                                            <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                class="blurred-image w-full h-[205px] object-cover" loading="lazy" />
                                            <button class="common-music-icon slider-music-icon highlight-button"
                                                type="button">
                                                <i class="icon fa-solid fa-play text-white"></i>
                                            </button>
                                        </div>
                                    @else
                                        <img src="{{ $post->post_image }}" class="w-full h-[205px] object-cover"
                                            loading="lazy" />
                                    @endif
                                </a>
                            </div>
                            <div class="">
                                <h5 class="md:text-[22px] text-lg font-semibold mb-2">
                                    <a href="{{ route('detailPage', $post->slug) }}">
                                        {!! $post->title !!}
                                    </a>
                                </h5>
                                <p class="pt-3 text-gray-300 sm:text-base text-sm font-medium line-clamp-3">
                                    {!! \Illuminate\Support\Str::limit($post->description, 80, '...') !!}
                                </p>
                                <div class="sm:pt-5 flex flex-wrap">
                                    <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                        <div class="w-8 h-8 rounded-full overflow-hidden mr-4"><a
                                                href="{{ route('userDetails', $post->user->username ?? $post->user->id) }}">
                                                <img src="{{ $post->user->profile_image }}"
                                                    class="w-full h-full object-cover" loading="lazy" /></a>
                                        </div>
                                        <span class="text-gray-200 sm:text-base text-sm font-medium mt-3"><a
                                                href="{{ route('userDetails', $post->user->username ?? $post->user->id) }}">{{ Str::limit($post->user->full_name, 12) }}
                                            </a></span>
                                    </div>
                                    <div class="flex flex-wrap sm:pt-0 pt-3 sm:pt-2">
                                        <div class="flex items-center mr-5">
                                            <div class="w-4 h-4 mr-2.5">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                                        fill="#C00F24"></path>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($post->created_at->format('F')))) }}{{ $post->created_at->format(' d, Y') }}</span>
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
                                            @if ($post->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE || $post->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                        $post->postArticle?->article_content ? $post->postArticle->article_content : $post->description,
                                                    ) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($post->postGalleries as $postDet) {
                                                        $allContent .= $postDet->gallery_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($post->postSortLists as $postDet) {
                                                        $allContent .= $postDet->sort_list_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($post->postVideo->video_content) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($post->postAudios->audio_content) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex lg:flex-col flex-col">
                    <div class="lg:pb-16 pb-10">
                        @if (checkAdSpaced('popular_news'))
                            @if (isset(getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_POPULAR_NEWS_THEME_1)->code))
                                <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                                    {!! getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_POPULAR_NEWS_THEME_1)->code !!}
                                </div>
                            @elseif ($adRecord = getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_POPULAR_NEWS_THEME_1))
                                <div class="rounded-xl mx-auto flex justify-center items-center">
                                    <a href="{{ $adRecord->ad_url }}" target="_blank">
                                        <img src="{{ asset($adRecord->ad_banner) }}" loading="lazy"
                                            class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl">
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    @if (count(getPopularNews()))
                        <div class="light-gray-bg rounded-xl lg:-mt-7">.
                            @if (!empty(array_filter(getPopularNews())))
                                @include('theme1.most_read', [
                                    'popularNews' => array_slice(getPopularNews(), 0, 6),
                                ])
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @foreach ($popularTag->skip(5) as $post)
                @if (($loop->index + 1) % 5 == 0)
                    <div class="container mx-auto max-w-7xl">
                        @if (checkAdSpaced('categories'))
                            <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
                                @if (isset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                                    <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                                        {!! getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                                    </div>
                                @elseif ($adRecord = getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                                    <div class="container mx-auto max-w-7xl">
                                        <div class="bg-gray-100 rounded-xl mx-auto">
                                            <a href="{{ getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                                                target="_blank" class="w-full">
                                                <img src="{{ asset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                                                    class="w-full rounded-xl object-fill mx-auto"
                                                    style="margin-bottom: 32px" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="lg:pt-10 md:pt-14 xs:pt-12 py-10 index-top-mobile hidden">
                                @if (isset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                                    <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                                        {!! getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                                    </div>
                                @elseif ($adRecord = getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                                    <div class="container mx-auto max-w-7xl">
                                        <div class="lg:flex lg:gap-8 gap-10">
                                            <div class="rounded-xl mx-auto flex justify-center items-center">
                                                <a href="{{ getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                                                    target="_blank">
                                                    <img src="{{ asset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                                                        class="rounded-xl md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill"
                                                        loading="lazy">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="lg:grid lg:grid-cols-3 gap-8 pt-10">
                <div class="col-span-2 sm:mb-0">
                    @foreach ($popularTag->skip(5)->take(3) as $post)
                        <div class="sm:flex mb-8">
                            <div
                                class="sm:w-[328px] h-[205px] sm:min-w-[328px] w-full rounded-lg overflow-hidden md:mr-5 sm:mr-4 sm:mb-0 mb-4 relative">
                                <a href="{{ route('detailPage', $post->slug) }}">
                                    @if ($post->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                        <div class="image-container">
                                            <img src="{{ $post->post_image }}"
                                                class="blurred-image w-full h-[205px] object-cover" loading="lazy" />
                                            <button class="common-music-icon slider-music-icon highlight-button"
                                                type="button">
                                                <i class="icon fa-solid fa-music text-white"></i>
                                            </button>
                                        </div>
                                    @elseif($post->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                        @php
                                            $thumbUrl =
                                                !empty($post->postVideo) &&
                                                !empty($post->postVideo->thumbnail_image_url)
                                                    ? $post->postVideo->thumbnail_image_url
                                                    : null;
                                            $thumbImage =
                                                !empty($post->postVideo) && !empty($post->postVideo->uploaded_thumb)
                                                    ? $post->postVideo->uploaded_thumb
                                                    : asset('front_web/images/default.jpg');
                                        @endphp
                                        <div class="image-container">
                                            <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                class="blurred-image w-full h-[205px] object-cover" loading="lazy" />
                                            <button class="common-music-icon slider-music-icon highlight-button"
                                                type="button">
                                                <i class="icon fa-solid fa-play text-white"></i>
                                            </button>
                                        </div>
                                    @else
                                        <img src="{{ $post->post_image }}" class="w-full h-[205px] object-cover"
                                            loading="lazy" />
                                    @endif
                                </a>
                            </div>
                            <div class="">
                                <h5 class="md:text-[22px] text-lg font-semibold mb-2">
                                    <a href="{{ route('detailPage', $post->slug) }}">
                                        {!! $post->title !!}
                                    </a>
                                </h5>
                                <p class="pt-3 text-gray-300 sm:text-base text-sm font-medium line-clamp-3">
                                    {!! \Illuminate\Support\Str::limit($post->description, 80, '...') !!}
                                </p>
                                <div class="sm:pt-5 flex flex-wrap">
                                    <div class="flex items-center mr-5 sm:pt-0 pt-3">
                                        <div class="w-8 h-8 rounded-full overflow-hidden mr-4"><a
                                                href="{{ route('userDetails', $post->user->username ?? $post->user->id) }}">
                                                <img src="{{ $post->user->profile_image }}"
                                                    class="w-full h-full object-cover" loading="lazy" /></a>
                                        </div>
                                        <span class="text-gray-200 sm:text-base text-sm font-medium"><a
                                                href="{{ route('userDetails', $post->user->username ?? $post->user->id) }}">{{ Str::limit($post->user->full_name, 12) }}
                                            </a></span>
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
                                            <span
                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($post->created_at->format('F')))) }}{{ $post->created_at->format(' d, Y') }}</span>
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
                                            @if ($post->post_types == \App\Models\Post::ARTICLE_TYPE_ACTIVE || $post->post_types == \App\Models\Post::OPEN_AI_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime(
                                                        $post->postArticle?->article_content ? $post->postArticle->article_content : $post->description,
                                                    ) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::GALLERY_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($post->postGalleries as $postDet) {
                                                        $allContent .= $postDet->gallery_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::SORTED_TYPE_ACTIVE)
                                                <span class="text-gray-200 sm:text-base text-sm font-medium">
                                                    <?php
                                                    $allContent = '';
                                                    foreach ($post->postSortLists as $postDet) {
                                                        $allContent .= $postDet->sort_list_content;
                                                    }
                                                    ?>
                                                    {{ getReadingTime($allContent) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($post->postVideo->video_content) }}</span>
                                            @elseif ($post->post_types == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                <span
                                                    class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($post->postAudios->audio_content) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex lg:flex-col flex-col-reverse">
                    <!-- popular tags -->
                    @if (count(getPopularTags()))
                        <div>
                            @include('theme1.popular_tag')
                        </div>
                    @endif
                    <!-- advertiesment -->
                    <div class="lg:h-3/5 md:pt-8 pb-8">
                        @include('theme1.advertiesment.detail-side')
                    </div>
                </div>
            </div>
            <div class="overflow-auto">
                @if ($popularTag->count() > 0)
                    {{ $popularTag->links('pagination::tailwind-theme-1') }}
                @endif
            </div>
            @if (checkAdSpaced('categories'))
                <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
                    @if (isset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                        <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                            {!! getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                        </div>
                    @elseif ($adRecord = getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                        <div class="container mx-auto max-w-7xl">
                            <div class="bg-gray-100 rounded-xl mx-auto">
                                <a href="{{ getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                                    target="_blank" class="w-full">
                                    <img src="{{ asset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                                        class="w-full rounded-xl object-fill mx-auto"
                                        style="margin-bottom: 32px" loading="lazy">
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="lg:pt-10 md:pt-14 xs:pt-12 py-10 index-top-mobile hidden">
                    @if (isset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                        <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                            {!! getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                        </div>
                    @elseif ($adRecord = getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                        <div class="container mx-auto max-w-7xl">
                            <div class="lg:flex lg:gap-8 gap-10">
                                <div class="rounded-xl mx-auto flex justify-center items-center">
                                    <a href="{{ getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                                        target="_blank">
                                        <img src="{{ asset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                                            class="rounded-xl md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill"
                                            loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @else
        <div class="flex text-base md:text-[22px] text-lg font-semibold justify-evenly mt-10">
            <h1>{{ __('messages.no_matching_records_found') }}</h1>
        </div>
    @endif
</div>
