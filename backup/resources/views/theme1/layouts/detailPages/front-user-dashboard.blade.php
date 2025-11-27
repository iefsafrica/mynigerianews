@extends('theme1.layouts.app')
@section('title')
    {!! $user->full_name !!}
@endsection
@section('content')
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
        <div class="container mx-auto max-w-7xl">
            <div class="text-center relative">
                <div class="lg:text-6xl sm:text-5xl text-4xl pb-3 text-gray-100 font-semibold">
                  {{ __('messages.author') }}
                </div>
                <h3 class="text-black font-semibold lg:text-3xl text-2xl absolute bottom-0 left-0 right-0 mx-auto">
                  {{ __('messages.author') }}
                </h3>
            </div>
            <!-- follow -->
            <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
                <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                    <div class="border rounded-xl lg:p-8 xs:p-5 p-4 ">
                    <div class="flex justify-between items-center lg:flex-row flex-col">
                        <div
                            class="flex xs:flex-row flex-col justify-center xs:items-start items-center sm:gap-7 xs:gap-5 gap-4">
                            <div
                                class="sm:w-24 w-20 sm:h-24 h-20 sm:min-w-[96px] min-w-[80px] rounded-full overflow-hidden ">
                                <img src="{{ $user->profile_image }}" class="w-full h-full object-cover" loading="lazy"/>
                            </div>
                            <div class="lg:mb-0 mb-4">
                                <div
                                    class="flex gap-y-1 gap-x-4 flex-wrap items-center xs:justify-start justify-center xs:mb-4 mb-3">
                                    <p class="sm:text-xl text-lg font-semibold  xs:text-start text-center">
                                        {{ Str::limit($user->full_name, 15) }}</p>
                                    <span class="text-gray-200 sm:text-sm text-xs ">{{(!empty($user->last_seen_at)) ?  __('messages.last_seen'). ' : '.Carbon\Carbon::parse($user->last_seen_at)->diffForHumans(null, true).' '.__('messages.ago') : '' }}</span>
                                </div>
                                <p class="text-gray-200 sm:text-base text-sm xs:text-start text-justify">
                                    {{ $user->about_us }}</p>
                            </div>
                        </div>
                        <div class="lg:w-1/3 lg:text-end ">
                            @if (getLogInUser() && getLogInUserId() != $user->id)
                                @if (empty(checkLoginUserFollow($user->id)))
                                    <a href="{{ route('followUser', $user->id) }}" type="button"
                                        class="border border-primary w-40 rounded-lg flex justify-center items-center text-primary px-3 py-2 lg:text-lg text-base font-semibold lg:ms-auto hover:bg-primary  hover:text-white focus:bg-primary focus:text-white group">
                                        <span class="me-3"><svg width="22" height="23" viewBox="0 0 22 23"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:!fill-white group-focus:!fill-white"
                                                    d="M0 19.5766C0.177013 18.9604 0.322819 18.3323 0.538032 17.7301C1.00892 16.4352 1.72502 15.2433 2.64712 14.2196C3.91333 12.7842 5.52972 11.7013 7.33876 11.0766C7.38341 11.061 7.42592 11.0379 7.48618 11.0104C5.977 9.79791 5.16726 8.24473 5.16403 6.3202C5.16134 4.72343 5.7478 3.34031 6.87605 2.20906C9.14816 -0.0685134 12.7799 -0.0642077 15.1133 2.18915C17.3155 4.31549 17.6959 8.55203 14.5328 11.0099C14.9368 11.1778 15.3398 11.3366 15.738 11.5126C16.1361 11.6885 16.347 12.0755 16.2695 12.4646C16.1619 13.0135 15.6212 13.2966 15.0832 13.098C14.501 12.8828 13.927 12.6287 13.3281 12.4775C11.0302 11.8968 8.81189 12.1546 6.70011 13.231C4.8708 14.1631 3.49559 15.5629 2.55404 17.3852C2.17857 18.1182 1.90522 18.8991 1.74161 19.7063C1.71549 19.8239 1.71392 19.9456 1.73702 20.0638C1.76011 20.182 1.80735 20.2941 1.8758 20.3932C1.94424 20.4923 2.0324 20.5761 2.13476 20.6396C2.23712 20.703 2.35147 20.7445 2.47064 20.7617C2.57758 20.7765 2.68554 20.7826 2.79346 20.78C6.20889 20.78 9.6245 20.7811 13.0403 20.7832C13.197 20.7771 13.3536 20.7984 13.503 20.8462C13.8419 20.9732 14.0243 21.238 14.0496 21.5996C14.0591 21.769 14.0175 21.9372 13.9302 22.0826C13.8429 22.228 13.7139 22.3438 13.56 22.415C13.4965 22.4451 13.4309 22.472 13.3663 22.5H2.27749C2.24698 22.4838 2.21489 22.4708 2.18172 22.4613C1.33862 22.3106 0.70536 21.859 0.310982 21.1029C0.168404 20.83 0.101688 20.5174 0 20.2224V19.5766ZM10.9974 2.21498C9.90369 2.21924 8.85618 2.65649 8.08388 3.43112C7.31158 4.20575 6.87732 5.25474 6.87605 6.34873C6.88197 8.64675 8.73979 10.4647 11.0792 10.462C13.277 10.462 15.1246 8.5784 15.1252 6.34227C15.1222 5.24828 14.6863 4.19998 13.9128 3.42656C13.1393 2.65314 12.0911 2.21753 10.9974 2.21498Z"
                                                    fill="#C00F24" />
                                                <path class="group-hover:!fill-white group-focus:!fill-white"
                                                    d="M17.7473 22.4988C17.2335 22.3239 17.0382 21.9606 17.0543 21.4262C17.0753 20.719 17.0597 20.0108 17.0597 19.2735H16.817C16.137 19.2735 15.4564 19.2735 14.7763 19.2735C14.227 19.2735 13.8439 18.922 13.838 18.4237C13.832 17.9253 14.22 17.5572 14.779 17.5556C15.5322 17.5556 16.2806 17.5556 17.0597 17.5556V17.3145C17.0597 16.6342 17.0597 15.954 17.0597 15.2732C17.0597 14.7151 17.4229 14.3276 17.9292 14.3341C18.4268 14.34 18.7755 14.7237 18.7771 15.2732C18.7771 16.0266 18.7771 16.7758 18.7771 17.5556H19.0171C19.6971 17.5556 20.3777 17.5556 21.0578 17.5556C21.6168 17.5556 22.0042 17.9178 21.9988 18.4242C21.9929 18.922 21.6098 19.2719 21.0605 19.2735C20.3073 19.2762 19.5583 19.2735 18.7771 19.2735V19.5119C18.7771 20.1491 18.761 20.7874 18.7825 21.424C18.8002 21.9563 18.6033 22.3217 18.09 22.4966L17.7473 22.4988Z"
                                                    fill="#C00F24" />
                                            </svg>
                                        </span>{{ __('messages.follow') }}
                                    </a>
                                @else
                                    <a href="{{ route('UnFollowUser', $user->id) }}" type="button"
                                        class="border border-primary w-40 rounded-lg flex justify-center items-center text-primary py-2 px-10 lg:text-lg text-base font-semibold lg:ms-auto hover:bg-primary  hover:text-white focus:bg-primary focus:text-white group">
                                        <span class="me-3"><svg width="22" height="23" viewBox="0 0 22 23"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:!fill-white group-focus:!fill-white"
                                                    d="M0 19.5766C0.177013 18.9604 0.322819 18.3323 0.538032 17.7301C1.00892 16.4352 1.72502 15.2433 2.64712 14.2196C3.91333 12.7842 5.52972 11.7013 7.33876 11.0766C7.38341 11.061 7.42592 11.0379 7.48618 11.0104C5.977 9.79791 5.16726 8.24473 5.16403 6.3202C5.16134 4.72343 5.7478 3.34031 6.87605 2.20906C9.14816 -0.0685134 12.7799 -0.0642077 15.1133 2.18915C17.3155 4.31549 17.6959 8.55203 14.5328 11.0099C14.9368 11.1778 15.3398 11.3366 15.738 11.5126C16.1361 11.6885 16.347 12.0755 16.2695 12.4646C16.1619 13.0135 15.6212 13.2966 15.0832 13.098C14.501 12.8828 13.927 12.6287 13.3281 12.4775C11.0302 11.8968 8.81189 12.1546 6.70011 13.231C4.8708 14.1631 3.49559 15.5629 2.55404 17.3852C2.17857 18.1182 1.90522 18.8991 1.74161 19.7063C1.71549 19.8239 1.71392 19.9456 1.73702 20.0638C1.76011 20.182 1.80735 20.2941 1.8758 20.3932C1.94424 20.4923 2.0324 20.5761 2.13476 20.6396C2.23712 20.703 2.35147 20.7445 2.47064 20.7617C2.57758 20.7765 2.68554 20.7826 2.79346 20.78C6.20889 20.78 9.6245 20.7811 13.0403 20.7832C13.197 20.7771 13.3536 20.7984 13.503 20.8462C13.8419 20.9732 14.0243 21.238 14.0496 21.5996C14.0591 21.769 14.0175 21.9372 13.9302 22.0826C13.8429 22.228 13.7139 22.3438 13.56 22.415C13.4965 22.4451 13.4309 22.472 13.3663 22.5H2.27749C2.24698 22.4838 2.21489 22.4708 2.18172 22.4613C1.33862 22.3106 0.70536 21.859 0.310982 21.1029C0.168404 20.83 0.101688 20.5174 0 20.2224V19.5766ZM10.9974 2.21498C9.90369 2.21924 8.85618 2.65649 8.08388 3.43112C7.31158 4.20575 6.87732 5.25474 6.87605 6.34873C6.88197 8.64675 8.73979 10.4647 11.0792 10.462C13.277 10.462 15.1246 8.5784 15.1252 6.34227C15.1222 5.24828 14.6863 4.19998 13.9128 3.42656C13.1393 2.65314 12.0911 2.21753 10.9974 2.21498Z"
                                                    fill="#C00F24" />
                                                <path class="group-hover:!fill-white group-focus:!fill-white"
                                                    d="M17.7473 22.4988C17.2335 22.3239 17.0382 21.9606 17.0543 21.4262C17.0753 20.719 17.0597 20.0108 17.0597 19.2735H16.817C16.137 19.2735 15.4564 19.2735 14.7763 19.2735C14.227 19.2735 13.8439 18.922 13.838 18.4237C13.832 17.9253 14.22 17.5572 14.779 17.5556C15.5322 17.5556 16.2806 17.5556 17.0597 17.5556V17.3145C17.0597 16.6342 17.0597 15.954 17.0597 15.2732C17.0597 14.7151 17.4229 14.3276 17.9292 14.3341C18.4268 14.34 18.7755 14.7237 18.7771 15.2732C18.7771 16.0266 18.7771 16.7758 18.7771 17.5556H19.0171C19.6971 17.5556 20.3777 17.5556 21.0578 17.5556C21.6168 17.5556 22.0042 17.9178 21.9988 18.4242C21.9929 18.922 21.6098 19.2719 21.0605 19.2735C20.3073 19.2762 19.5583 19.2735 18.7771 19.2735V19.5119C18.7771 20.1491 18.761 20.7874 18.7825 21.424C18.8002 21.9563 18.6033 22.3217 18.09 22.4966L17.7473 22.4988Z"
                                                    fill="#C00F24" />
                                            </svg>
                                        </span> {{ __('messages.unfollow') }}
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="">
                @livewire('front-user-table', ['user' => $user->id, 'user_data' => $user, 'followers' => $followers, 'following' => $following])
            </div>
        </div>
    </div>
    <!-- advertiesment -->
    @if (checkAdSpaced('categories'))
        <div class="lg:pt-10 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="bg-gray-100 rounded-xl mx-auto">
                    <a href="{{ getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                        target="_blank">
                        <img src="{{ asset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                            class="rounded-xl object-fill" loading="lazy">
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-mobile hidden">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="lg:flex lg:gap-8 gap-10">
                    <div class="flex justify-center items-center rounded-xl mx-auto">
                        <a href="{{ getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_url }}"
                            target="_blank">
                            <img src="{{ asset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->ad_banner) }}"
                                class="rounded-xl md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill" loading="lazy">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
