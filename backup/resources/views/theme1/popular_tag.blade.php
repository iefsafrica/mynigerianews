@if (count(getPopularTags()))
    <div class="light-gray-bg xl:col-auto md:col-span-2 rounded-xl xs:p-3 p-2">
        <div class="font-semibold xl:text-[22px] sm:text-xl text-lg text-black mb-4">
            {{ __('messages.details.popular_tags') }}
        </div>
        <div class="flex flex-wrap gap-1.5">
            @foreach (getPopularTags() as $tag)
                <a href="{{ route('popularTagPage', $tag) }}"
                    class="text-sm font-medium text-gray-300 py-2 px-5 rounded-full border border-gray-50 text-center">{!! $tag !!}</a>
                @if ($loop->iteration >= ($maxIterations ?? 15))
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
