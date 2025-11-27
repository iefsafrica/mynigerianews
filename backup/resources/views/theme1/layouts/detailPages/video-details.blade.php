@extends('theme1.layouts.app')

@section('title')
    {!! $postDetail->title !!}
@endsection
@section('meta_image')
    {{ $postDetail->post_image }}
@endsection
@section('meta_tags')
    {!! $postDetail->keywords !!}
@endsection
@section('meta_description')
    {!! $postDetail->description !!}
@endsection

@section('content')
    @php
        $settings = getSettingValue();
    @endphp
    <div class="">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <nav class="text-gray-600 pt-5">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li class="flex items-center">
                        <a href="/" class="text-gray-300 text-sm font-medium">{{ __('messages.details.home') }}</a>
                        <span class="lg:mx-3 mx-2"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="#606060" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        </span>
                    </li>
                    <li class="flex items-center ms-3">
                        <a href="{{ route('categoryPage', $postDetail->category->name) }}"
                            class="text-gray-300 text-sm font-medium category-name">{!! $postDetail->category->name !!}</a>
                        <span class="lg:mx-2 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="#606060" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </li>
                    <li class="flex items-center">
                        <a href="#" class="text-primary text-sm font-medium">{!! $postDetail->title !!}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- details-section -->
    <div class="pt-10">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="">
                <h2 class="text-black xl:text-[28px] text-2xl font-bold">
                    {!! $postDetail->title !!}
                </h2>
                <div class="sm:pt-5 flex flex-wrap">
                    <div class="flex items-center mr-10 sm:pt-0 pt-3">
                        <div class="w-8 h-8 rounded-full overflow-hidden mr-4">
                            <a href="{{ route('userDetails', $postDetail->user->username ?? $postDetail->user->id) }}">
                                <img src="{{ $postDetail->user->profile_image }}" class="w-full h-full object-cover" loading="lazy"/>
                            </a>
                        </div>
                        <a href="{{ route('userDetails', $postDetail->user->username ?? $postDetail->user->id) }}">
                            <span
                                class="text-gray-200 sm:text-base text-sm font-medium">{{  Str::limit($postDetail->user->full_name, 20) }}</span>
                        </a>
                    </div>
                    <div class="flex flex-wrap sm:pt-0 pt-3">
                        <div class="flex items-center mr-10">
                            <div class="w-4 h-4 mr-2.5">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.6667 1.33333H12V0.666667C12 0.298667 11.7013 0 11.3333 0C10.9653 0 10.6667 0.298667 10.6667 0.666667V1.33333H5.33333V0.666667C5.33333 0.298667 5.03467 0 4.66667 0C4.29867 0 4 0.298667 4 0.666667V1.33333H3.33333C1.49533 1.33333 0 2.82867 0 4.66667V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V4.66667C16 2.82867 14.5047 1.33333 12.6667 1.33333ZM3.33333 2.66667H12.6667C13.7693 2.66667 14.6667 3.564 14.6667 4.66667V5.33333H1.33333V4.66667C1.33333 3.564 2.23067 2.66667 3.33333 2.66667ZM12.6667 14.6667H3.33333C2.23067 14.6667 1.33333 13.7693 1.33333 12.6667V6.66667H14.6667V12.6667C14.6667 13.7693 13.7693 14.6667 12.6667 14.6667ZM10.6667 10.6667C10.6667 11.0347 10.368 11.3333 10 11.3333H6C5.632 11.3333 5.33333 11.0347 5.33333 10.6667C5.33333 10.2987 5.632 10 6 10H10C10.368 10 10.6667 10.2987 10.6667 10.6667Z"
                                        fill="#C00F24"></path>
                                </svg>
                            </div>
                            <span
                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($postDetail->created_at->format('F')))) }}
                                {{ $postDetail->created_at->format('d, Y') }}</span>
                        </div>
                        <div class="flex items-center mr-10">
                            <div class="w-4 h-4 mr-2.5">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 16C3.58867 16 0 12.4113 0 8C0 3.58867 3.58867 0 8 0C12.4113 0 16 3.58867 16 8C16 12.4113 12.4113 16 8 16ZM8 1.33333C4.324 1.33333 1.33333 4.324 1.33333 8C1.33333 11.676 4.324 14.6667 8 14.6667C11.676 14.6667 14.6667 11.676 14.6667 8C14.6667 4.324 11.676 1.33333 8 1.33333ZM11.3333 8C11.3333 7.63133 11.0353 7.33333 10.6667 7.33333H8.66667V4C8.66667 3.63133 8.368 3.33333 8 3.33333C7.632 3.33333 7.33333 3.63133 7.33333 4V8C7.33333 8.36867 7.632 8.66667 8 8.66667H10.6667C11.0353 8.66667 11.3333 8.36867 11.3333 8Z"
                                        fill="#C00F24"></path>
                                </svg>
                            </div>
                            <span
                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($postDetail->postVideo->video_content) }}</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2.5">
                                <svg width="16" height="12" viewBox="0 0 16 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.5112 4.34286C14.4776 2.72103 12.1265 0 8 0C3.87353 0 1.5224 2.72103 0.488783 4.34286C0.169253 4.84078 0 5.4146 0 6C0 6.5854 0.169253 7.15923 0.488783 7.65714C1.5224 9.27897 3.87353 12 8 12C12.1265 12 14.4776 9.27897 15.5112 7.65714C15.8307 7.15923 16 6.5854 16 6C16 5.4146 15.8307 4.84078 15.5112 4.34286ZM14.375 6.98491C13.4873 8.3756 11.478 10.7159 8 10.7159C4.52196 10.7159 2.5127 8.3756 1.62503 6.98491C1.43519 6.68895 1.33464 6.34791 1.33464 6C1.33464 5.65209 1.43519 5.31105 1.62503 5.01509C2.5127 3.6244 4.52196 1.28411 8 1.28411C11.478 1.28411 13.4873 3.62183 14.375 5.01509C14.5648 5.31105 14.6654 5.65209 14.6654 6C14.6654 6.34791 14.5648 6.68895 14.375 6.98491Z"
                                        fill="#C00F24" />
                                    <path
                                        d="M8 2.78973C7.34097 2.78973 6.69675 2.97801 6.14879 3.33076C5.60082 3.68351 5.17374 4.18488 4.92154 4.77148C4.66934 5.35808 4.60336 6.00356 4.73193 6.62629C4.8605 7.24903 5.17785 7.82104 5.64385 8.27001C6.10985 8.71897 6.70358 9.02472 7.34994 9.14859C7.9963 9.27246 8.66628 9.20889 9.27514 8.96591C9.884 8.72293 10.4044 8.31146 10.7705 7.78353C11.1367 7.25561 11.3321 6.63493 11.3321 6C11.331 5.1489 10.9796 4.33294 10.355 3.73112C9.73032 3.1293 8.8834 2.79075 8 2.78973ZM8 7.92617C7.60458 7.92617 7.21805 7.8132 6.88927 7.60155C6.56049 7.3899 6.30424 7.08907 6.15293 6.73711C6.00161 6.38515 5.96201 5.99786 6.03916 5.62422C6.1163 5.25059 6.30671 4.90738 6.58631 4.638C6.86591 4.36862 7.22215 4.18517 7.60996 4.11085C7.99778 4.03653 8.39977 4.07467 8.76508 4.22046C9.1304 4.36624 9.44264 4.61313 9.66232 4.92988C9.882 5.24664 9.99926 5.61904 9.99926 6C9.99926 6.51085 9.78862 7.00078 9.41369 7.362C9.03876 7.72323 8.53024 7.92617 8 7.92617Z"
                                        fill="#C00F24" />
                                </svg>
                            </div>
                            <span class="text-gray-200 sm:text-base text-sm font-medium">{{ getPostViewCount($postDetail->id) . ' ' . __('messages.details.views') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-3 pt-10 gap-8">
                <div class="col-span-2 sm:mb-0">
                    <p class="sm:text-lg text-base mb-10 text-justify break-all">
                        {!! $postDetail->description !!}
                    </p>
                    <div class="w-full sm:h-[548px] h-[405px] rounded-xl overflow-hidden relative mb-10">
                        @if (!empty($postDetail->postVideo->uploaded_video))
                            <video controls class="w-full sm:h-[548px] h-[405px] rounded-xl overflow-hidden relative mb-10">
                                <source src="{{ $postDetail->postVideo->uploaded_video }}">
                            </video>
                        @else
                            <iframe src="{{ $postDetail->postVideo->video_embed_code }}" frameborder="1"
                                id="embed_video_i_frame"
                                class="w-full sm:h-[548px] h-[405px] rounded-xl overflow-hidden relative mb-10"></iframe>
                        @endif
                        <a href="{{ route('categoryPage', $postDetail->category->slug) }}"
                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5">{{ $postDetail->category->name }}</a>
                    </div>
                    <div class="mb-10">
                        <p class="sm:text-lg text-base text-justify break-all">
                            @if (isset($postDetail->postVideo))
                                {!! $postDetail->postVideo->video_content !!}
                            @endif
                        </p>
                        @if ($postDetail->rss_id != null)
                            @if ($postDetail->rssFeed->show_btn == \App\Models\RssFeed::YES)
                                <div class="flex flex-row-reverse">
                                    <a href="{{ $postDetail->rss_link }}" target="_blank"
                                        class="text-primary font-semibold text-base">{{ __('messages.read_more') }}</a>
                                </div>
                            @endif
                        @endif
                        @if ($postDetail->optional_url != null)
                            <div class="flex flex-row-reverse">
                                <a href="{{ $postDetail->optional_url }}" target="_blank"
                                    class="text-primary font-semibold text-base">{{ __('messages.read_more') }}</a>
                            </div>
                        @endif
                    </div>
                    @if ($postDetail->additional_image)
                        <div class="mb-10">
                            <h3 class="text-2xl font-semibold mb-5">{{ __('messages.common.images') }}</h3>
                            <div class="image-slider">
                                @foreach ($postDetail->additional_image as $image)
                                    <div class="px-2">
                                        <div class="w-full h-72 rounded-lg overflow-hidden">
                                            <img src="{{ $image }}" class="w-full h-full object-fill" loading="lazy"/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($postDetail->post_file) && count($postDetail->post_file))
                        <div class="mb-10 border-b">
                            <h3 class="text-2xl font-semibold mb-5">{{ __('messages.common.files') }}</h3>
                            @foreach ($postDetail->post_file as $file)
                                <div class="px-2 text-primary hover:opacity-80 ">
                                    <a href="{{ $file }}" class="tag-link">{{ basename($file) }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="sm:flex justify-between items-center relative">
                        @if (!empty($postDetail->tags))
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $postDetail->tags) as $tags)
                                    <a href="{{ route('popularTagPage', $tags) }}"
                                        class="text-sm font-medium text-gray-300 py-2 px-5 rounded-full border border-gray-50 text-center">{!! $tags !!}</a>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex gap-6 px-2 sm:pt-0 pt-4">
                            <div @click.away="open = false" x-data="{ open: false }" class>
                                <div class="relative flex flex-col items-center group">
                                    <a @click="open = !open" class="cursor-pointer"><svg width="20" height="20"
                                            viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.3998 13.5968C19.8214 13.074 20.0236 12.5136 19.9978 11.9364C19.972 11.3007 19.6794 10.803 19.4385 10.4977C19.7181 9.82016 19.8257 8.75366 18.8921 7.92555C18.208 7.31911 17.0463 7.04726 15.4372 7.12254C14.3057 7.17273 13.3591 7.37767 13.3204 7.38603H13.3161C13.101 7.42367 12.8729 7.46968 12.6406 7.51987C12.6234 7.2522 12.6707 6.5872 13.1784 5.08992C13.7808 3.30824 13.7463 1.94479 13.0666 1.03304C12.3523 0.0752824 11.2122 0 10.8766 0C10.5539 0 10.2571 0.129653 10.0462 0.368047C9.56866 0.90757 9.62459 1.90297 9.68482 2.36303C9.1169 3.84358 7.52499 7.47386 6.17832 8.48181C6.15251 8.49854 6.131 8.51945 6.10948 8.54036C5.71366 8.94605 5.44691 9.38519 5.2662 9.76997C5.01236 9.63614 4.72409 9.56085 4.41432 9.56085H1.78982C0.800257 9.56085 0 10.343 0 11.3007V18.097C0 19.059 0.804559 19.8369 1.78982 19.8369H4.41432C4.79724 19.8369 5.15434 19.7198 5.44691 19.519L6.45798 19.6361C6.61287 19.657 9.36644 19.9958 12.1932 19.9414C12.7051 19.9791 13.187 20 13.6345 20C14.4046 20 15.0758 19.9414 15.6351 19.8243C16.9517 19.5525 17.8509 19.0088 18.3069 18.21C18.6554 17.5993 18.6554 16.9929 18.5995 16.6081C19.4557 15.8553 19.6063 15.023 19.5762 14.4375C19.559 14.0987 19.4815 13.8101 19.3998 13.5968ZM1.78982 18.7077C1.44132 18.7077 1.16166 18.4316 1.16166 18.097V11.2965C1.16166 10.9578 1.44562 10.6859 1.78982 10.6859H4.41432C4.76282 10.6859 5.04248 10.9619 5.04248 11.2965V18.0928C5.04248 18.4316 4.75851 18.7035 4.41432 18.7035H1.78982V18.7077ZM18.2983 13.1075C18.1176 13.2915 18.0832 13.5717 18.2209 13.7892C18.2209 13.7934 18.3973 14.0862 18.4188 14.4877C18.4489 15.0355 18.1779 15.5207 17.6099 15.9348C17.4077 16.0853 17.326 16.3446 17.412 16.5788C17.412 16.583 17.597 17.1351 17.2959 17.6579C17.0076 18.1598 16.3665 18.5194 15.3942 18.7202C14.6154 18.8833 13.557 18.9126 12.2577 18.8122C12.2405 18.8122 12.219 18.8122 12.1975 18.8122C9.43098 18.8708 6.63438 18.5194 6.60427 18.5153H6.59996L6.16542 18.4651C6.19123 18.348 6.20414 18.2225 6.20414 18.097V11.2965C6.20414 11.1167 6.17402 10.941 6.12239 10.7779C6.19984 10.4977 6.41496 9.87453 6.92265 9.34337C8.85445 7.85445 10.7432 2.83145 10.825 2.61397C10.8594 2.52614 10.868 2.42995 10.8508 2.33375C10.7776 1.86533 10.8035 1.29235 10.9067 1.12087C11.1348 1.12505 11.75 1.18779 12.12 1.68549C12.5589 2.2752 12.5417 3.32915 12.0684 4.72606C11.3456 6.85487 11.2853 7.97574 11.8576 8.46926C12.1415 8.71602 12.5201 8.72857 12.7955 8.63237C13.0579 8.57382 13.3075 8.52363 13.5441 8.48599C13.5613 8.48181 13.5828 8.47762 13.6001 8.47344C14.9209 8.19322 17.2873 8.02175 18.109 8.74948C18.806 9.36846 18.3112 10.1882 18.2553 10.276C18.0961 10.5102 18.1434 10.8156 18.3586 11.0038C18.3629 11.0079 18.8146 11.422 18.8361 11.9783C18.8534 12.3505 18.6727 12.7311 18.2983 13.1075Z"
                                                fill="#181D27" />
                                        </svg>
                                    </a>
                                    <div class="absolute bottom-0 flex flex-col items-center hidden mb-6 group-hover:flex">
                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">{{ __('messages.reaction.like') }}</span>
                                        <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                    </div>
                                </div>
                                @if (getSettingValue()['emoji_system'])
                                    <div :class="{ 'showpopup': open, 'hidden': !open }"
                                        class="p-4 pt-1 absolute bottom-8 right-0 sm:left-auto left-0 border bg-white shadow-lg rounded-xl w-full max-w-min">
                                        <div class="flex pt-3 gap-3 popup-scrollbar overflow-auto">
                                            @foreach ($emojis as $emoji)
                                                <a href="javascript:void(0);" class="flex flex-col items-center px-1.5">
                                                    <div class="text-4xl relative emoji-id"
                                                        data-emoji="{{ $emoji->id }}"
                                                        data-post="{{ $postDetail->id }}">
                                                        {{ html_entity_decode($emoji->emoji) }}
                                                        <span
                                                            class="bg-black rounded-full text-white text-[10px] absolute -top-1 -right-1 w-4 h-4 flex justify-center items-center post-reaction-count  like-reaction"
                                                            id="{{ $emoji->id }}">{{ isset($countEmoji[$emoji->id]) ? count($countEmoji[$emoji->id]) : 0 }}</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] font-medium">{{ __('messages.reaction.' . $emoji->name) }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                        <button :class="{ 'showpopup': open, 'hidden': !open }"
                                            class="close absolute -top-1.5 -right-1.5 text-xs font-bold p-0.5 border bg-white shadow-lg rounded-full w-5 h-5"
                                            @click="open = false">
                                            X
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="relative flex flex-col items-center group">
                                <a id="commentInputFocus" class="cursor-pointer"><svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.125 6.73936C15.8844 6.73936 16.5 7.3428 16.5 8.08723C16.5 8.83166 15.8844 9.4351 15.125 9.4351C14.3656 9.4351 13.75 8.83166 13.75 8.08723C13.75 7.3428 14.3656 6.73936 15.125 6.73936Z"
                                            fill="#181D27" />
                                        <path
                                            d="M12.375 8.08723C12.375 7.3428 11.7594 6.73936 11 6.73936C10.2406 6.73936 9.625 7.3428 9.625 8.08723C9.625 8.83166 10.2406 9.4351 11 9.4351C11.7594 9.4351 12.375 8.83166 12.375 8.08723Z"
                                            fill="#181D27" />
                                        <path
                                            d="M6.875 6.73936C7.63441 6.73936 8.25 7.3428 8.25 8.08723C8.25 8.83166 7.63441 9.4351 6.875 9.4351C6.11559 9.4351 5.5 8.83166 5.5 8.08723C5.5 7.3428 6.11559 6.73936 6.875 6.73936Z"
                                            fill="#181D27" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.5625 0C20.461 0 22 1.50866 22 3.36968V12.8048C22 14.6658 20.461 16.1745 18.5625 16.1745H18.5542L18.5478 19.3274C18.5472 19.603 18.3756 19.8504 18.1143 19.9523C17.8531 20.0541 17.555 19.9898 17.3615 19.7898L13.8629 16.1745H3.4375C1.53904 16.1745 0 14.6658 0 12.8048V3.36968C0 1.50866 1.53904 0 3.4375 0H18.5625ZM20.625 3.36968C20.625 2.25307 19.7016 1.34787 18.5625 1.34787H3.4375C2.29838 1.34787 1.375 2.25307 1.375 3.36968V12.8048C1.375 13.9214 2.29838 14.8266 3.4375 14.8266H14.1584C14.347 14.8266 14.5274 14.9025 14.6572 15.0367L17.1762 17.6399L17.1805 15.4992C17.1813 15.1275 17.4889 14.8266 17.868 14.8266H18.5625C19.7016 14.8266 20.625 13.9214 20.625 12.8048V3.36968Z"
                                            fill="#181D27" />
                                    </svg>
                                </a>
                                <div class="absolute bottom-0 flex flex-col items-center hidden mb-6 group-hover:flex">
                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Comment</span>
                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                </div>
                            </div>
                            <div @click.away="open = false" x-data="{ open: false }">
                                <div class="relative flex flex-col items-center group">
                                    <a @click="open = !open" class="cursor-pointer"><svg width="18" height="20"
                                            viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.6149 13.4529C13.6241 13.4529 12.7313 13.8667 12.1117 14.525L6.53867 11.187C6.68746 10.8186 6.76998 10.4185 6.76998 10C6.76998 9.5813 6.68746 9.18121 6.53867 8.81302L12.1117 5.47485C12.7313 6.13312 13.6241 6.54709 14.6149 6.54709C16.4815 6.54709 18 5.07858 18 3.27347C18 1.46835 16.4815 0 14.6149 0C12.7484 0 11.2299 1.46851 11.2299 3.27362C11.2299 3.69217 11.3125 4.09225 11.4612 4.4606L5.88829 7.79861C5.26868 7.14035 4.37594 6.72638 3.38507 6.72638C1.5185 6.72638 0 8.19504 0 10C0 11.8051 1.5185 13.2736 3.38507 13.2736C4.37594 13.2736 5.26868 12.8598 5.88829 12.2014L11.4612 15.5394C11.3125 15.9077 11.2299 16.3078 11.2299 16.7265C11.2299 18.5315 12.7484 20 14.6149 20C16.4815 20 18 18.5315 18 16.7265C18 14.9214 16.4815 13.4529 14.6149 13.4529ZM12.4642 3.27362C12.4642 2.12677 13.429 1.1937 14.6149 1.1937C15.8008 1.1937 16.7657 2.12677 16.7657 3.27362C16.7657 4.42047 15.8008 5.35355 14.6149 5.35355C13.429 5.35355 12.4642 4.42047 12.4642 3.27362ZM3.38507 12.0799C2.19902 12.0799 1.23418 11.1469 1.23418 10C1.23418 8.85315 2.19902 7.92007 3.38507 7.92007C4.57096 7.92007 5.53565 8.85315 5.53565 10C5.53565 11.1469 4.57096 12.0799 3.38507 12.0799ZM12.4642 16.7264C12.4642 15.5795 13.429 14.6465 14.6149 14.6465C15.8008 14.6465 16.7657 15.5795 16.7657 16.7264C16.7657 17.8732 15.8008 18.8063 14.6149 18.8063C13.429 18.8063 12.4642 17.8732 12.4642 16.7264Z"
                                                fill="#181D27" />
                                        </svg>
                                    </a>
                                    <div class="absolute bottom-0 flex flex-col items-center hidden mb-6 group-hover:flex">
                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Share</span>
                                        <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                    </div>
                                </div>
                                <div :class="{ 'showpopup': open, 'hidden': !open }"
                                    class="p-4 absolute bottom-8 right-0 sm:left-auto left-0 border bg-white shadow-lg rounded-xl w-full max-w-min">
                                    <button :class="{ 'showpopup': open, 'hidden': !open }"
                                        class="close absolute -top-1.5 -right-1.5 text-xs font-bold p-0.5 border bg-white shadow-lg rounded-full w-5 h-5"
                                        @click="open = false">
                                        X
                                    </button>
                                    <div class="flex gap-3 popup-scrollbar overflow-auto pb-1">
                                        @if (getSettingValue()['facebook'])
                                            <a href="https://www.facebook.com/sharer.php?u={{ getUrl() }}"
                                                class="bg-blue-600 p-1.5 rounded-lg">
                                                <svg class="svg-inline--fa fa-facebook-f w-5 h-5 text-white"
                                                    aria-hidden="true" focusable="false" data-prefix="fab"
                                                    data-icon="facebook-f" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                    data-fa-i2svg>
                                                    <path fill="currentColor"
                                                        d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if (getSettingValue()['twitter'])
                                            <a href="https://www.twitter.com/share?url={{ getUrl() }}"
                                                class="bg-sky-400 p-1.5 rounded-lg">
                                                <svg class="svg-inline--fa fa-twitter w-5 h-5 text-white"
                                                    aria-hidden="true" focusable="false" data-prefix="fab"
                                                    data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512" data-fa-i2svg>
                                                    <path fill="currentColor"
                                                        d="M459.4 151.7c.325 4.548 .325 9.097 .325 13.65 0 138.7-105.6 298.6-298.6 298.6-59.45 0-114.7-17.22-161.1-47.11 8.447 .974 16.57 1.299 25.34 1.299 49.06 0 94.21-16.57 130.3-44.83-46.13-.975-84.79-31.19-98.11-72.77 6.498 .974 12.99 1.624 19.82 1.624 9.421 0 18.84-1.3 27.61-3.573-48.08-9.747-84.14-51.98-84.14-102.1v-1.299c13.97 7.797 30.21 12.67 47.43 13.32-28.26-18.84-46.78-51.01-46.78-87.39 0-19.49 5.197-37.36 14.29-52.95 51.65 63.67 129.3 105.3 216.4 109.8-1.624-7.797-2.599-15.92-2.599-24.04 0-57.83 46.78-104.9 104.9-104.9 30.21 0 57.5 12.67 76.67 33.14 23.72-4.548 46.46-13.32 66.6-25.34-7.798 24.37-24.37 44.83-46.13 57.83 21.12-2.273 41.58-8.122 60.43-16.24-14.29 20.79-32.16 39.31-52.63 54.25z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if (getSettingValue()['linkedin'])
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ getUrl() }}"
                                                class="bg-sky-600 p-1.5 rounded-lg">
                                                <svg class="svg-inline--fa fa-linkedin w-5 h-5 text-white"
                                                    aria-hidden="true" focusable="false" data-prefix="fab"
                                                    data-icon="linkedin" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    data-fa-i2svg>
                                                    <path fill="currentColor"
                                                        d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if (getSettingValue()['reddit'])
                                            <a href="https://reddit.com/submit?url={{ getUrl() }}"
                                                class="bg-green-600 p-1.5 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="svg-inline--fa w-5 h-5 text-white" viewBox="0 0 448 512">
                                                    <path fill="currentColor"
                                                        d="M64 32l320 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32zM305.9 166.4c20.6 0 37.3-16.7 37.3-37.3s-16.7-37.3-37.3-37.3c-18 0-33.1 12.8-36.6 29.8c-30.2 3.2-53.8 28.8-53.8 59.9l0 .2c-32.8 1.4-62.8 10.7-86.6 25.5c-8.8-6.8-19.9-10.9-32-10.9c-28.9 0-52.3 23.4-52.3 52.3c0 21 12.3 39 30.1 47.4c1.7 60.7 67.9 109.6 149.3 109.6s147.6-48.9 149.3-109.7c17.7-8.4 29.9-26.4 29.9-47.3c0-28.9-23.4-52.3-52.3-52.3c-12 0-23 4-31.9 10.8c-24-14.9-54.3-24.2-87.5-25.4l0-.1c0-22.2 16.5-40.7 37.9-43.7l0 0c3.9 16.5 18.7 28.7 36.3 28.7zM155 248.1c14.6 0 25.8 15.4 25 34.4s-11.8 25.9-26.5 25.9s-27.5-7.7-26.6-26.7s13.5-33.5 28.1-33.5zm166.4 33.5c.9 19-12 26.7-26.6 26.7s-25.6-6.9-26.5-25.9c-.9-19 10.3-34.4 25-34.4s27.3 14.6 28.1 33.5zm-42.1 49.6c-9 21.5-30.3 36.7-55.1 36.7s-46.1-15.1-55.1-36.7c-1.1-2.6 .7-5.4 3.4-5.7c16.1-1.6 33.5-2.5 51.7-2.5s35.6 .9 51.7 2.5c2.7 .3 4.5 3.1 3.4 5.7z" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if (getSettingValue()['whatsapp'])
                                            <a href="https://wa.me/?text={{ getUrl() }}"
                                                class="bg-green-600 p-1.5 rounded-lg">
                                                <svg class="svg-inline--fa fa-whatsapp w-5 h-5 text-white"
                                                    aria-hidden="true" focusable="false" data-prefix="fab"
                                                    data-icon="whatsapp" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    data-fa-i2svg>
                                                    <path fill="currentColor"
                                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
                        <div class="container" id="postComments">
                            <div class="grid lg:grid-cols-3 gap-8">
                                <div class="comment-container lg:col-span-3 light-gray-bg rounded-xl sm:p-8 p-5">
                                    <h5 class="font-semibold xl:text-[22px] sm:text-xl text-lg text-black mb-4">
                                        {{ __('messages.comment.post_a_comment') }}
                                    </h5>
                                    <form class="" id="commentFormTailwind">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $postDetail->id }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ isset(getLogInUser()->id) ? getLogInUser()->id : null }}">
                                        @if (!Auth::check())
                                            <div class="sm:grid sm:grid-cols-2 gap-6">
                                                <div class="sm:mb-5 mb-4">
                                                    <input type="text" id="name" name="name"
                                                        class="w-full p-3.5 text-sm text-gray-300 border rounded-lg focus:outline-none"
                                                        placeholder="{{ __('messages.comment.enter_your_name') }}" id="commentInputField"
                                                        required />
                                                </div>

                                                <div class="sm:mb-5 mb-4">
                                                    <input type="email" id="email" name="email"
                                                        class="w-full p-3.5 text-sm text-gray-300 border rounded-lg focus:outline-none"
                                                        placeholder="{{ __('messages.comment.enter_your_email') }}"
                                                        required />
                                                </div>
                                            </div>
                                        @endif
                                        <div class="sm:mb-7 mb-5">
                                            <textarea id="comment" name="comment"
                                                class="w-full p-3.5 text-sm text-gray-300 border rounded-lg focus:outline-none" rows="4"
                                                placeholder="{{ __('messages.comment.type_your_comments') }}" required></textarea>
                                        </div>

                                        <div class="col-12 mb-2">
                                            @if ($showCaptcha == '1')
                                                <input type="hidden" value="{{ $settings['show_captcha'] }}"
                                                    id="googleCaptch">
                                                <div class="form-group mb-1">
                                                    <div class="g-recaptcha" id="gRecaptchaContainerPostDetails" style="transform:scale(0.82);-webkit-transform:scale(0.82);transform-origin:0 0;-webkit-transform-origin:0 0;"
                                                        data-sitekey="{{ $settings['site_key'] }}"></div>
                                                    <div id="g-recaptcha-error"></div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="">
                                            <button class="bg-primary text-white rounded-lg font-bold text-sm py-3 px-10">
                                                {{ __('messages.comment.post_comment') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 comment-tailwind">
                        <h5
                            class="font-semibold xl:text-[22px] comment-data sm:text-xl text-lg text-black mb-4 @if (empty($totalComments)) hidden @endif">
                            {{ __('messages.comments') }}
                            <span class="count-data">
                                {{ $totalComments }}
                            </span>
                        </h5>
                        <div class="max-h-[250px] custom-scrollbar overflow-auto justify-between comment-view">
                            @foreach ($comments as $comment)
                                <div class="xs:flex flex sm:flex card-view-{{ $comment->id }} border-b py-5">
                                    <div class="flex">
                                        <div
                                            class="w-20 h-20 min-w-[80px] rounded-full overflow-hidden xs:mr-5 xs:mb-0 mb-4">
                                            <img src="{{ isset($comment->users->profile_image) ? $comment->users->profile_image : asset('web/media/avatars/150-2.jpg') }}"
                                                class="w-full h-full object-cover" loading="lazy"/>
                                        </div>
                                        <div class="">
                                            <p class="text-base font-semibold mb-1 line-clamp-1">
                                                {{ $comment->name }}
                                            </p>
                                            <span
                                                class="text-gray-200 text-xs font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                            <p class="text-gray-200 text-sm font-medium line-clamp-2">
                                                {!! $comment->comment !!}
                                            </p>
                                        </div>
                                    </div>
                                    @if (Auth::check() && $comment->user_id == getLogInUser()->id)
                                    <div class="ml-auto pr-5">
                                        <button class="delete-btn fs-14 text-danger delete-comment-btn-tailwind text-red-500"
                                            data-id="{{ $comment['id'] }}">
                                            <i class="fa fa-trash-can"></i> {{ __('messages.delete') }}
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="">
                    <!-- advertiesment -->
                    <div class="rounded-xl mb-7">
                        @include('theme1.advertiesment.detail-side')
                    </div>
                    <!-- most read -->
                    <div class="light-gray-bg rounded-xl mb-7">
                        @if (!empty(array_filter(getPopularNews())))
                            @include('theme1.most_read', ['popularNews' => array_slice(getPopularNews(), 0, 4)])
                        @endif
                    </div>
                    <!-- popular tags -->
                    <div class="light-gray-bg rounded-xl xs:p-5 p-4 mb-7">
                        @include('theme1.popular_tag')
                    </div>
                    <!-- Recommended -->
                    @if (count(getRecommendedPost()) > 0)
                      <div class="light-gray-bg rounded-xl xs:p-5 p-4">
                           @include('theme1.recommended', ['getRecommendedPost' => getRecommendedPost()->take(5)])
                       </div>
                    @endif
                    <!-- advertiesment -->
                    <div class="pt-10">
                        @include('theme1.advertiesment.detail-side')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prev-next post -->
    <div class="pt-10">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="border rounded-xl sm:px-5 px-4 sm:py-7 py-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="md:max-w-[486px]">
                        @if (!empty($previousPost))
                            <div class="flex">
                                <div class="sm:mr-5 mr-4">
                                    <a href="{{ route('detailPage', $previousPost->slug) }}"
                                        class="flex items-center text-primary sm:text-base text-sm font-medium pb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="#c00f24" class="w-3.5 h-3.5 sm:mr-3 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5"></path>
                                        </svg>
                                        {{ __('messages.details.previous_post') }}</a>
                                    <a href="{{ route('detailPage', $previousPost->slug) }}">
                                        <p class="text-base font-semibold line-clamp-2">
                                            {!! \Illuminate\Support\Str::limit($previousPost['title'], 40, '...') !!}
                                        </p>
                                    </a>
                                </div>
                                <div
                                    class="sm:w-[150px] w-[115px] sm:h-[100px] h-[90px] sm:min-w-[150px] min-w-[115px] rounded-lg overflow-hidden">
                                    <a href="{{ route('detailPage', $previousPost->slug) }}">
                                        <img src="{{ $previousPost->post_image }}" class="w-full h-full object-cover" loading="lazy"/>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="md:max-w-[486px] ms-auto">
                        @if (!empty($nextPost))
                            <div class="flex">
                                <div
                                    class="sm:w-[150px] w-[115px] sm:h-[100px] h-[90px] sm:min-w-[150px] min-w-[115px] rounded-lg overflow-hidden sm:mr-5 mr-4">
                                    <a href="{{ route('detailPage', $nextPost->slug) }}">
                                        <img src="{{ $nextPost->post_image }}" class="w-full h-full object-cover" loading="lazy"/>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="{{ route('detailPage', $nextPost->slug) }}"
                                        class="flex items-center justify-end text-primary sm:text-base text-sm font-medium pb-3">
                                        {{ __('messages.details.next_post') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="#c00f24" class="w-3.5 h-3.5 sm:ml-3 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('detailPage', $nextPost->slug) }}">
                                        <p class="text-base font-semibold line-clamp-2">
                                            {!! \Illuminate\Support\Str::limit($nextPost['title'], 80, '...') !!}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- related posts -->
    @if ($relatedPosts->count() > 0)
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="">
                    <div class="flex flex-wrap justify-between items-center border-b">
                        <h4 class="text-[28px] font-semibold mb-2 mr-3">{{ __('messages.details.related_post') }}</h4>
                        <div class="ms-auto">
                            <a href="{{ route('allPosts') }}"
                                class="text-primary font-semibold text-base">{{ __('messages.details.view_more') }}</a>
                        </div>
                    </div>
                    <div class="grid xs:grid-cols-2 lg:grid-cols-3 xl:gap-8 gap-6 pt-10">
                        @foreach ($relatedPosts as $relatedPost)
                            <div class="">
                                <div class="w-full h-[215px] rounded-lg overflow-hidden relative">
                                    {{-- <a href="{{ route('detailPage', $relatedPost->slug) }}">
                                        <img src="{{ $relatedPost['post_image'] }}" class="w-full h-full object-cover" loading="lazy"/>
                                        <a href=""
                                            class="bg-primary rounded-tr-md rounded-br-md text-white font-bold text-xs py-1.5 pl-4 pr-2.5 absolute left-0 top-5">{{ $relatedPost['category']['name'] }}</a> --}}

                                            <a href="{{ route('detailPage', $relatedPost->slug) }}">
                                                @if ($relatedPost['post_types'] == \App\Models\Post::AUDIO_TYPE_ACTIVE)
                                                    <div class="image-container">
                                                        <img src="{{ $relatedPost['post_image'] }}" loading="lazy"
                                                            class="blurred-image w-full h-[205px] object-fill" alt="post-img" />
                                                        <button class="common-music-icon slider-music-icon highlight-button"
                                                            type="button">
                                                            <i class="icon fa-solid fa-music text-white"></i>
                                                        </button>
                                                    </div>
                                                @elseif($relatedPost['post_types'] == \App\Models\Post::VIDEO_TYPE_ACTIVE)
                                                    @php
                                                        $thumbUrl = !empty($relatedPost['postVideo']) && !empty($relatedPost['postVideo']->thumbnail_image_url) ? $relatedPost['postVideo']->thumbnail_image_url : null;
                                                        $thumbImage = !empty($relatedPost['postVideo']) && !empty($relatedPost['postVideo']->uploaded_thumb) ? $relatedPost['postVideo']->uploaded_thumb : asset('front_web/images/default.jpg');
                                                    @endphp
                                                    <div class="image-container">
                                                        <img src="{{ !empty($thumbUrl) ? $thumbUrl : $thumbImage }}"
                                                            loading="lazy" class="blurred-image w-full h-[205px] object-cover"
                                                            alt="thumb-img" />
                                                        <button class="common-music-icon slider-music-icon highlight-button"
                                                            type="button">
                                                            <i class="icon fa-solid fa-play text-white"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    <img src="{{ $relatedPost['post_image'] }}" loading="lazy"
                                                        class="w-full h-full object-cover" alt="post-img" />
                                                @endif
                                            </a>
                                </div>
                                <div class="pt-5">
                                    <h2 class="font-bold xl:text-[22px] sm:text-xl text-lg text-black">
                                        <a class="text-black" href="{{ route('detailPage', $relatedPost->slug) }}">
                                            {!! $relatedPost['title'] !!}
                                        </a>
                                    </h2>
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
                                            <span
                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ ucfirst(__('messages.common.' . strtolower($relatedPost['created_at']->format('M')))) }}
                                                {{ $relatedPost['created_at']->format('d, Y') }}</span>
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
                                            <span
                                                class="text-gray-200 sm:text-base text-sm font-medium">{{ getReadingTime($postDetail->postVideo->video_content) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($loop->iteration >= 6)
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<!-- advertiesment -->
@include('theme1.advertiesment.post-details')
@include('theme1.layouts.detailPages.template.template')

<script>
    $(document).ready(function(){
        let categoryName = $('.category-name').text();

        $('.navigation-name').each(function() {
            let navigationName = $(this).text();

            if (navigationName.includes(categoryName)) {
                $(this).addClass('text-primary active');
            }
        });
    });
</script>
@endsection
