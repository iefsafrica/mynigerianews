@if (checkAdSpaced('details_side'))
    @if (isset(getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1)->code))
        <div
            class="mx-auto flex justify-center items-center mb-7 lg:mt-0 mt-7">
            {!! getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1)->code !!}
        </div>
    @elseif ($adRecord = getAdImageMobile(\App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1))
        <div class="rounded-xl mx-auto flex justify-center items-center">
            <a href="{{ $adRecord->ad_url }}" target="_blank">
                <img src="{{ asset($adRecord->ad_banner) }}" loading="lazy"
                    class="md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px] object-fill rounded-xl">
            </a>
        </div>
    @endif
@endif
