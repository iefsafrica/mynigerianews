@extends('frontend.master')

@section('main_content')

    <!-- Maan Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="maan-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Search') }}</li>
            </ol>
        </div>
    </nav>
    <!-- Maan Breadcrumb End -->
    <!-- Maan Search Start -->
    <section class="business maan-slide-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Search') }}</h2>
                        </div>
                    </div>
                    <div class="maan-news-post">

                        @foreach($searchnews as $search )
                            <div class="card maan-default-post">
                                <div class="maan-post-img">
                                    @if ($search->image)
                                        @php
                                            $images = json_decode($search->image);
                                        @endphp
                                        @if($images!='')
                                            @foreach ($images as $image)
                                                @if (File::exists($image))

                                                    <a href="{{ route($search->news_categoryslug.'.details',$search->id) }}"><img src="{{ asset($image) }}" alt="top-news"></a>
                                                @endif
                                            @endforeach
                                        @endif

                                    @endif

                                </div>
                                <div class="card-body maan-card-body">
                                    <div class="maan-text">
                                        <ul>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><circle cx="256" cy="114.526" r="114.526"></circle><path d="M256,256c-111.619,0-202.105,90.487-202.105,202.105c0,29.765,24.13,53.895,53.895,53.895h296.421 c29.765,0,53.895-24.13,53.895-53.895C458.105,346.487,367.619,256,256,256z"></path></svg></span>
                                                <span class="maan-item-text"><a href="#">{{ $search->reporter_name }}</a></span>
                                            </li>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($search->date))->format('d M, Y') }}</span>

                                            </li>
                                        </ul>
                                        <h4><a href="{{ route($search->news_categoryslug.'.details',$search->id) }}">{{ $search->title }}</a></h4>
                                        <p>{{ $search->summary }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Search') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets">
                        <form  action="{{ route('search') }}" class="search"  method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Search ...">
                                <button type="submit" class="d-btn"><svg viewBox="0 0 511.999 511.999"><path d="M508.874,478.708L360.142,329.976c28.21-34.827,45.191-79.103,45.191-127.309c0-111.75-90.917-202.667-202.667-202.667 S0,90.917,0,202.667s90.917,202.667,202.667,202.667c48.206,0,92.482-16.982,127.309-45.191l148.732,148.732 c4.167,4.165,10.919,4.165,15.086,0l15.081-15.082C513.04,489.627,513.04,482.873,508.874,478.708z M202.667,362.667 c-88.229,0-160-71.771-160-160s71.771-160,160-160s160,71.771,160,160S290.896,362.667,202.667,362.667z"></path></svg></button>
                            </div>
                        </form>
                    </div>
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Popular post') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets maan-bg-tr">
                        <div class="popular-post">
                            @foreach($popularsnews as $popularnews)
                                <div class="card maan-default-post">
                                    <div class="maan-post-img">
                                        @if ($popularnews->image)
                                            @php
                                                $images = json_decode($popularnews->image);
                                            @endphp
                                            @if($images!='')
                                                @foreach ($images as $image)
                                                    @if (File::exists($image))

                                                        <img src="{{ asset($image) }}" alt="top-news">
                                                    @endif
                                                @endforeach
                                            @endif

                                        @endif
                                    </div>
                                    <div class="card-body maan-card-body">
                                        <div class="maan-text">
                                            <h4><a href="{{ route($popularnews->news_categoryslug.'.details',$popularnews->id) }}">{{ $popularnews->title }}</a></h4>
                                            <ul>
                                                <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($popularnews->date))->format('d M, Y') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Gallery') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets">
                        <div class="widgets-gallery">
                            <ul>
                                @php
                                    $photogalleries = photogalleries();
                                @endphp
                                @foreach($photogalleries as $photogallery)
                                    <li>
                                        <a href="{{ route('photogallery.details',$photogallery->id) }}"><img src="{{ asset($photogallery->image) }}" alt="gallery"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Recent post') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets maan-bg-tr">
                        <div class="maan-news-list recent-post">
                            <ul>
                                @foreach($recentnews as $latestnews)
                                    <li>
                                        <div class="maan-list-img">
                                            @if ($latestnews->image)
                                                @php
                                                    $images = json_decode($latestnews->image);
                                                @endphp
                                                @if($images!='')
                                                    @foreach ($images as $image)
                                                        @if (File::exists($image))

                                                            <img src="{{ asset($image) }}" alt="list-news-img">
                                                        @endif
                                                    @endforeach
                                                @endif

                                            @endif

                                        </div>
                                        <div class="maan-list-text">
                                            <h4><a href="{{ route($latestnews->news_categoryslug.'.details',$latestnews->id) }}">{{ $latestnews->title }}</a></h4>
                                            <ul>
                                                <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($latestnews->date))->format('d M, Y') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Maan Search End -->
    <!-- Maan Pagination Start -->
    <nav class="maan-pagination" aria-label="Page navigation example">
        <div class="container">
            {{ $searchnews->links() }}
        </div>
    </nav>
    <!-- Maan Pagination End -->
@endsection
