@if (checkAdSpaced('post_details'))
    @if (isset(getAdImageDesktop(\App\Models\AdSpaces::POST_DETAILS_THEME_1)->code))
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
            <div class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
                {!! getAdImageDesktop(\App\Models\AdSpaces::POST_DETAILS_THEME_1)->code !!}
            </div>
        </div>
    @elseif ($adsDesktop = getAdImageDesktop(\App\Models\AdSpaces::POST_DETAILS_THEME_1))
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 px-4 index-top-desktop">
            <div class="container max-w-7xl mx-auto bg-gray-100 rounded-xl">
                <a href="{{ $adsDesktop->ad_url }}" target="_blank">
                    <img src="{{ asset($adsDesktop->ad_banner) }}" loading="lazy" class="rounded-xl w-full h-full object-fill">
                </a>
            </div>
        </div>
    @endif
    @if (isset(getAdImageMobile(\App\Models\AdSpaces::POST_DETAILS_THEME_1)->code))
        <div class="index-top-mobile mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
            {!! getAdImageMobile(\App\Models\AdSpaces::POST_DETAILS_THEME_1)->code !!}
        </div>
    @elseif ($adRecord = getAdImageMobile(\App\Models\AdSpaces::POST_DETAILS_THEME_1))
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-mobile">
            <div class="container xl:px-10 md:px-8 px-4 mx-auto">
                <div class="lg:flex lg:gap-8 gap-10">
                    <div class="rounded-xl mx-auto flex justify-center items-center">
                        <a href="{{ $adRecord->ad_url }}" target="_blank">
                            <img src="{{ asset($adRecord->ad_banner) }}" class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl" loading="lazy">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
