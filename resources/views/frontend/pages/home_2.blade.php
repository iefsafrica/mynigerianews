@extends('frontend.master')
@php
    $assetBase = app()->environment('local') ? '' : 'public/';
    $fallbackImage = $assetBase.'maan/images/26.png';
@endphp
@section('meta_content')
    <meta name="keywords" content="{{ $seooptimization->keywords }}">
    <meta name="title" content="{{ $seooptimization->meta_title }}">
    <meta name="description" content="{{ $seooptimization->meta_description }}">
    <meta name="author" content="{{ $seooptimization->author }}">

    <meta property="og:keywords" content="{{ $seooptimization->keywords }}">
    <meta property="og:title" content="{{ $seooptimization->meta_title }}">
    <meta property="og:description" content="{{ $seooptimization->meta_description }}">
    <meta property="og:author" content="{{ $seooptimization->author }}">
    <meta property="og:image" content="{{ asset($settings->logo) }}" />

@endsection
@push('styles')
    <!-- home2 -->
    <link rel="stylesheet" href="{{ asset($assetBase.'frontend/css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset($assetBase.'frontend/css/swiper-bundle.min.css') }}">
@endpush
@section('main_content')
    @php
        $sportsHeadline = $latestnewssports->first();
        $weeklyReviewHeadline = $latestReviewNews->first();
    @endphp
    <!-- news10-newtop-news stat -->
    <section class="news10-newtop-news pt-0">
        <div class="container-xxl container-lg">
            <div class="news10-grid-five">
                @foreach($latestnews as $lastnews)
                    <div class="card news10-topnews-card maantop-news-card">
                        <a href="@if($lastnews->news_categoryslug) @if(Route::has(strtolower($lastnews->news_categoryslug))){{ route( strtolower($lastnews->news_categoryslug).'.details',['id'=>$lastnews->id,'slug'=>\Illuminate\Support\Str::slug($lastnews->title)]) }} @endif @endif
                            " class="new-card-thumb">
                            @php
                                $images = json_decode($lastnews->image, true) ?: [];
                                $imagePath = $images[0] ?? $fallbackImage;
                            @endphp
                            <img loading="lazy" src="{{ asset($imagePath) }}" alt="">
                        </a>
                        <div class="card-body">
                            <a href="@if($lastnews->news_categoryslug) @if(Route::has(strtolower($lastnews->news_categoryslug))){{ route( strtolower($lastnews->news_categoryslug),[$lastnews->news_category]) }} @endif @endif
                                " class="news-ctg-link">{{$lastnews->news_category}}</a>
                            <a href="@if($lastnews->news_categoryslug) @if(Route::has(strtolower($lastnews->news_categoryslug))){{ route( strtolower($lastnews->news_categoryslug).'.details',['id'=>$lastnews->id,'slug'=>\Illuminate\Support\Str::slug($lastnews->title)]) }} @endif @endif
                                " class="news-title">{{$lastnews->title}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- news10-newtop-news end -->
    <!-- TRENDING NEWS start -->
    <section class="news10-newtrending-section pt-0">
        <div class="container-xxl container-lg">
            <div class="news10-sec-title">
                <h3>{{__('TRENDING NEWS')}}</h3>
            </div>
            <div class="layout-4">
                @foreach($popularsnews as $popularnews)
                    <div class="card trending-news-card">
                        <a href=" @if($popularnews->news_categoryslug)
                        @if(Route::has(strtolower($popularnews->news_categoryslug)))
                        {{ route( strtolower($popularnews->news_categoryslug).'.details',['id'=>$popularnews->id,'slug'=>\Illuminate\Support\Str::slug($popularnews->title)]) }}
                        @endif
                        @endif" class="card-thumb">
                            @php
                                $image = json_decode($popularnews->image, true) ?: [];
                                $imagePath = $image[0] ?? $fallbackImage;
                            @endphp
                            <img loading="lazy" src="{{ asset($imagePath) }}" alt="">
                        </a>
                        <div class="card-body">
                            <div class="card-meta">
                                <a href="@if($popularnews->news_categoryslug)
                                @if(Route::has(strtolower($popularnews->news_categoryslug)))
                                {{ route( strtolower($popularnews->news_categoryslug),$popularnews->news_category) }}
                                @endif
                                @endif" class="news-ctg-link">{{$popularnews->news_category}}</a>
                                @php
                                    $wordCount = str_word_count($popularnews->description);
                                    $minutesToRead = round($wordCount / 200);
                                @endphp
                                <span>{{ $minutesToRead }}{{__(' min to Read')}}</span>
                            </div>
                            <a href=" @if($popularnews->news_categoryslug)
                            @if(Route::has(strtolower($popularnews->news_categoryslug)))
                            {{ route( strtolower($popularnews->news_categoryslug).'.details',['id'=>$popularnews->id,'slug'=>\Illuminate\Support\Str::slug($popularnews->title)]) }}
                            @endif
                            @endif" class="news-title">{{$popularnews->title}}</a>
                            <p>{{ $popularnews->summary}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- TRENDING NEWS end -->

    <!-- promotion  start -->
@if($advertisement)
    <section class="promotion-section p-0">
            <div class="container">
                {!! $advertisement->before_post_ads !!}
            </div>
    </section>
@endif
    <!-- promotion  end -->

    <!-- sports NEWS start -->
    <section class="news10-sports-section pt-0">
        <div class="container-xxl container-lg">
            <div class="news10-sec-title">
                <h3>{{__('sports')}}</h3>
                <a href="@if($sportsHeadline && $sportsHeadline->news_categoryslug)
                                @if(Route::has(strtolower($sportsHeadline->news_categoryslug)))
                                {{ route( strtolower($sportsHeadline->news_categoryslug),$sportsHeadline->news_category) }}
                                @endif
                                @endif">{{__('Show All')}} <i class="far fa-long-arrow-alt-right"></i></a>
            </div>
            <div class="layout-4">
                @foreach($latestnewssports->take(4) as $lastnewssports)
                    <div class="card trending-news-card">
                        <a href="@if($lastnewssports->news_categoryslug)
                        @if(Route::has(strtolower($lastnewssports->news_categoryslug)))
                        {{ route( strtolower($lastnewssports->news_categoryslug).'.details',['id'=>$lastnewssports->id,'slug'=>\Illuminate\Support\Str::slug($lastnewssports->title)]) }}
                        @endif
                        @endif" class="card-thumb">
                            @php
                                $image = json_decode($lastnewssports->image, true) ?: [];
                                $imagePath = $image[0] ?? $fallbackImage;
                            @endphp
                            <img loading="lazy" src="{{ asset($imagePath) }}" alt="">
                        </a>
                        <div class="card-body">
                            <div class="card-meta">
                                <a href="@if($lastnewssports->news_categoryslug)
                                @if(Route::has(strtolower($lastnewssports->news_categoryslug)))
                                {{ route( strtolower($lastnewssports->news_categoryslug),$lastnewssports->news_category) }}
                                @endif
                                @endif" class="news-ctg-link">{{$lastnewssports->news_category}}</a>
                                @php
                                    $wordCount = str_word_count($lastnewssports->description);
                                    $minutesToRead = round($wordCount / 200);
                                @endphp
                                <span>{{ $minutesToRead }}{{__(' min to Read')}}</span>
                            </div>
                            <a href="@if($lastnewssports->news_categoryslug)
                            @if(Route::has(strtolower($lastnewssports->news_categoryslug)))
                            {{ route( strtolower($lastnewssports->news_categoryslug).'.details',['id'=>$lastnewssports->id,'slug'=>\Illuminate\Support\Str::slug($lastnewssports->title)]) }}
                            @endif
                            @endif" class="news-title">{{$lastnewssports->title}}</a>
                            <p>{{$lastnewssports->summary}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- sports NEWS end -->

    <!-- Weekly Review  start -->
    <section class="news10-weekly-review-section news10-data-background" data-background="public/maan/images/bg.jpg">
        <div class="container-xxl container-lg">
            <div class="news10-sec-title">
                <h3>{{ __('Weekly Review') }} @if($weeklyReviewHeadline && $weeklyReviewHeadline->category) {{ $weeklyReviewHeadline->category->slug }} @endif</h3>
                <a href=" @if($weeklyReviewHeadline && $weeklyReviewHeadline->category && $weeklyReviewHeadline->category->slug)
                                @if(Route::has(strtolower($weeklyReviewHeadline->category->slug)))
                                {{ route( strtolower($weeklyReviewHeadline->category->slug),$weeklyReviewHeadline->category->name) }}
                                @endif
                                @endif">{{__('Show All')}} <i class="far fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="news10-weekly-review-wrapper swiper-container">
                <div class="swiper-wrapper">
                    @foreach($latestReviewNews as $reviewNews)
                        <div class="swiper-slide">
                            <div class="card trending-news-card weekly-review-card">
                                <a href="
                        @if($reviewNews->category->slug)
                                @if(Route::has(strtolower($reviewNews->category->slug)))
                                {{ route( strtolower($reviewNews->category->slug).'.details',['id'=>$reviewNews->id,'slug'=>\Illuminate\Support\Str::slug($reviewNews->title)]) }}
                                @endif
                                @endif" class="card-thumb">
                                    @php
                                        $image = json_decode($reviewNews->image, true) ?: [];
                                        $imagePath = $image[0] ?? $fallbackImage;
                                    @endphp
                                    <img loading="lazy" src="{{ asset($imagePath) }}" alt="">
                                    <span class="news-ctg-link">{{$reviewNews->category->name}}</span>
                                </a>
                                <div class="card-body">
                                    <div class="card-meta">
                                        <span>{{$reviewNews->updated_at->format('d M y')}}</span>
                                        @php
                                            $wordCount = str_word_count($reviewNews->description);
                                            $minutesToRead = round($wordCount / 200);
                                        @endphp
                                        <span>{{ $minutesToRead }}{{__(' min to Read')}}</span>
                                    </div>
                                    <a href="@if($reviewNews->category->slug)
                                    @if(Route::has(strtolower($reviewNews->category->slug)))
                                    {{ route( strtolower($reviewNews->category->slug).'.details',['id'=>$reviewNews->id,'slug'=>\Illuminate\Support\Str::slug($reviewNews->title)]) }}
                                    @endif
                                    @endif" class="news-title">{{$reviewNews->title}} </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- Weekly Review  end -->

    <!-- editor and feature  start -->
    <section class="news10-editor-feature-section">
        <div class="container-xxl container-lg">
            <div class="row">
                <div class="col-lg-8">
                    <div class="editor-area-wrapper">
                        <div class="news10-sec-title">
                            <h3>{{__('Editor’s Picks')}}</h3>
                            <a href="{{ route('photogallery') }}">{{__('Show All')}} <i class="far fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="news10-grid-five editor-area">
                            @foreach($latestphotogalleries->take(5) as $latestphotogallery)
                                <div class="card news10-topnews-card maantop-news-card">
                                    <div class="new-card-thumb">

                                        <img loading="lazy" src="{{ asset($latestphotogallery->image) }}" alt="">

                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('photogallery.details',['id'=>$latestphotogallery->id,'slug'=>\Illuminate\Support\Str::slug($latestphotogallery->title)]) }}" class="news-ctg-link">{{$latestphotogallery->title}}</a>
                                        <a href="{{ route('photogallery.details',['id'=>$latestphotogallery->id,'slug'=>\Illuminate\Support\Str::slug($latestphotogallery->title)]) }}" class="news-title">{{$latestphotogallery->user_name}}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news10-sec-title">
                        <h3>{{__('FEATURED POSTS')}}</h3>
                    </div>
                    <div class="feature-pst">
                        <ul>
                            <li>
                                @foreach($features as $feature)
                                    <div class="feature-pst-items">
                                        <a href="
                                        @if($feature->news_categoryslug)
                                        @if(Route::has(strtolower($feature->news_categoryslug)))
                                        {{ route( strtolower($feature->news_categoryslug).'.details',['id'=>$feature->id,'slug'=>\Illuminate\Support\Str::slug($feature->title)]) }}
                                        @endif
                                        @endif
                                            " class="thumb">
                                            @php
                                                $image = json_decode($feature->image, true) ?: [];
                                                $imagePath = $image[0] ?? $fallbackImage;
                                            @endphp
                                            <img loading="lazy" src="{{ asset($imagePath) }}" alt="">
                                        </a>
                                        <div class="discription">
                                            <a href="@if($feature->news_categoryslug)
                                            @if(Route::has(strtolower($feature->news_categoryslug)))
                                            {{ route( strtolower($feature->news_categoryslug),$feature->news_category) }}
                                            @endif
                                            @endif" class="news-ctg-link">{{$feature->news_category}}</a>
                                            <a href="@if($feature->news_categoryslug)
                                            @if(Route::has(strtolower($feature->news_categoryslug)))
                                            {{ route( strtolower($feature->news_categoryslug).'.details',['id'=>$feature->id,'slug'=>\Illuminate\Support\Str::slug($feature->title)]) }}
                                            @endif
                                            @endif" class="news-title">{{$feature->title}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="feature-post-slideer">
                        <div class="card news10-topnews-card maantop-news-card">
                            @if (advertisement())
                                {!! advertisement()->sidebar_ads !!}
                            @else
                                <a href="#" class="new-card-thumb">
                                    <img loading="lazy" src="{{ asset($fallbackImage) }}" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- editor and feature  end -->

    <!-- Featured video  start -->
    <section class="news10-feature-video-section">
        <div class="top-bg">
            <img loading="lazy" src="{{asset('/public/maan/images/feature-video-bg.svg')}}" alt="">
        </div>
        <div class="container-xxl container-lg">
            <div class="news10-sec-title">
                <h3>{{__('FEATURED VIDEO')}}</h3>
            </div>
            <div class="video-section-grid">
                @foreach($latestVideoGalleries as $video)
                    @if($loop->iteration==1)
                <div class="card iframe-video-wrapper">
                    <iframe src="{{asset($video->video)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                    @endif

                    <div class="card trending-news-card weekly-review-card">
                        <div class="card-thumb">
                            @if($video->image!=null)
                                <img loading="lazy" src="{{asset($video->image)}}" alt="">
                            @else
                            <img loading="lazy" src="{{asset('/public/maan/images/26.png')}}" alt="">
                            @endif
                            <a href="" class="news-ctg-link">{{$video->title}}</a>
                            <a class="venobox vbox-item" data-autoplay="true" data-vbtype="video" href="{{asset($video->video)}}"><i class="fas fa-play"></i></a>
                        </div>
                        <div class="card-body">
                            <a href="" class="news-title">{{$video->description}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured video  end -->
    <!-- promotion  start -->
    @if($advertisement)
        <section class="promotion-section p-0">
            <div class="container">
                {!! $advertisement->after_post_ads !!}
            </div>
        </section>
    @endif


    <section class="multinews-section">
        <div class="container-xxl container-lg">
            <div class="layout-3">
                @foreach ($newscategories as $newscategory)
                    <div class="layout-items">
                        <div class="news10-sec-title">
                            <h3>{{ $newscategory->name}}</h3>
                            <a href="@if(Route::has(strtolower($newscategory->slug))){{ route(strtolower($newscategory->slug),$newscategory->name) }}@endif">{{__('Show All')}} <i class="far fa-long-arrow-alt-right"></i></a>
                        </div>
                        @foreach ($newscategory->news->take(4) as $wholenews)

                            @php
                                $image = json_decode($wholenews->image, true) ?: [];
                                $imagePath = $image[0] ?? $fallbackImage;
                            @endphp
                            @if ($loop->iteration==1)
                                <div class="card trending-news-card">
                                    <a href="@if($newscategory->slug){{ route( strtolower($newscategory->slug).'.details',['id'=>$wholenews->id,'slug'=>\Illuminate\Support\Str::slug($wholenews->title)]) }} @endif" class="card-thumb">

                                        <img loading="lazy" src="{{ asset($imagePath) }}" alt="{{ $wholenews->title }}">
                                    </a>
                                    <div class="card-body">
                                        <a href="@if($newscategory->slug){{ route( strtolower($newscategory->slug).'.details',['id'=>$wholenews->id,'slug'=>\Illuminate\Support\Str::slug($wholenews->title)]) }} @endif" class="news-title">{{$wholenews->title}}</a>
                                    </div>
                                </div>
                            @else

                                <ul>

                                    <li>
                                        <div class="feature-pst-items">
                                            <a href="@if($newscategory->slug){{ route( strtolower($newscategory->slug).'.details',['id'=>$wholenews->id,'slug'=>\Illuminate\Support\Str::slug($wholenews->title)]) }} @endif" class="thumb">
                                                <img loading="lazy" src="{{ asset($imagePath) }}" alt="{{ $wholenews->title }}">
                                            </a>
                                            <div class="discription">
                                                <a href="@if($newscategory->slug){{ route( strtolower($newscategory->slug).'.details',['id'=>$wholenews->id,'slug'=>\Illuminate\Support\Str::slug($wholenews->title)]) }} @endif" class="news-title">{{$wholenews->title}}</a>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            @endif

                        @endforeach

                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <!-- home2 -->
    <script src="{{ asset($assetBase.'frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset($assetBase.'frontend/js/theme.js') }}"></script>
@endpush
