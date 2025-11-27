<div class="h-2/5">
    <div class="light-gray-bg rounded-xl xs:p-5 p-4 lg:h-full">
        <h4 class="text-[22px] font-semibold mb-4">Most Read</h4>
        @foreach ($popularNews as $news)
            <div class="flex mb-4">
                <div class="w-[115px] h-[90px] min-w-[115px] rounded-lg overflow-hidden mr-3">
                    <a href="{{ route('detailPage', $news['slug']) }}" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'data-turbo=false' : '' }}>
                        @if ($news['post_types'] == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                            <div class="image-container">
                                <img src="{{ $news['post_image'] }}" class="blurred-image w-full h-[90px] object-cover" loading="lazy" />
                                <button class="common-music-icon slider-music-icon highlight-button" type="button">
                                    <i class="icon fa-solid fa-music text-white"></i>
                                </button>
                            </div>
                        @elseif($news['post_types'] == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                            @php
                                $thumbUrl = !empty($news['post_video']) && !empty($news['post_video']['thumbnail_image_url']) ? $news['post_video']['thumbnail_image_url'] : null;
                                $thumbImage = !empty($news['post_video']) && !empty($news['post_video']['uploaded_thumb']) ? $news['post_video']['uploaded_thumb'] : asset('front_web/images/default.jpg');
                            @endphp
                            <div class="image-container">
                                <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                    class="blurred-image w-full h-[90px] object-cover" loading="lazy" />
                                <button class="common-music-icon slider-music-icon highlight-button" type="button">
                                    <i class="icon fa-solid fa-play text-white"></i>
                                </button>
                            </div>
                        @else
                            <img src="{{ $news['post_image'] }}" class="w-full h-[90px] object-cover" alt=""
                                loading="lazy" />
                        @endif
                    </a>
                </div>
                <div class="">
                    <p class="text-base font-semibold line-clamp-2">
                        <a href="{{ route('detailPage', $news['slug']) }}" class="text-black break-all">
                            {{ $news['title'] }}</a>
                    </p>
                    <div class="flex flex-wrap xl:pt-3 pt-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2.5">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                        fill="#C00F24"></path>
                                </svg>
                            </div>
                            <span
                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower(\Carbon\Carbon::parse($news['created_at'])->format('M')))) }}{{ \Carbon\Carbon::parse($news['created_at'])->format(' d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
