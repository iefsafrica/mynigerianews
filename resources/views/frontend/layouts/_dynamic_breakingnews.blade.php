
@foreach(breakingnews() as $breaking_news)
    <div class="swiper-slide">
        <p>
            <a href="@if($breaking_news->news_category) @if(Route::has(strtolower($breaking_news->news_categoryslug))) {{ route(strtolower($breaking_news->news_categoryslug).'.details',$breaking_news->id) }} @endif @endif ">
                {{ $breaking_news->title }}
            </a>
        </p>
    </div>

@endforeach
