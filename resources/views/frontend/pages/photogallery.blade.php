@extends('frontend.master')

@section('main_content')

    <!-- Maan Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="maan-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Photo Gallery') }}</li>
            </ol>
        </div>
    </nav>
    <!-- Maan Breadcrumb End -->
    <!-- Maan Photo Gallery Start -->
    <section class="business maan-slide-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Photo Gallery') }}</h2>
                        </div>
                    </div>
                    <div class="maan-news-post">
                        <div class="maan-slide">
                            @foreach($photogalleries as $photogallery )
                            <div class="card maan-default-post">
                                <div class="maan-post-img">
                                    <a href="{{ route('photogallery.details',$photogallery->id) }}">
                                      <img loading="lazy" src="{{ asset($photogallery->image) }}" alt="top-news">
                                        <a/>
                                </div>
                                <div class="card-body maan-card-body">
                                    <div class="maan-text">
                                        <ul>
                                            <li>
                                                <span class="maan-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.007" height="13.414" viewBox="0 0 12.007 13.414">
                                                <g   transform="translate(-24.165)">
                                                    <g   data-name="Group 466" transform="translate(26.687)">
                                                    <g   data-name="Group 465" transform="translate(0)">
                                                        <path   data-name="Path 845" d="M114.274,0a3.483,3.483,0,1,0,3.483,3.483A3.492,3.492,0,0,0,114.274,0Z" transform="translate(-110.791)" fill="#888"/>
                                                    </g>
                                                    </g>
                                                    <g    data-name="Group 468" transform="translate(24.165 7.215)">
                                                    <g   data-name="Group 467" transform="translate(0)">
                                                        <path   data-name="Path 846" d="M36.147,250.375a3.247,3.247,0,0,0-.35-.639,4.329,4.329,0,0,0-3-1.886.641.641,0,0,0-.441.106,3.712,3.712,0,0,1-4.38,0,.571.571,0,0,0-.441-.106,4.3,4.3,0,0,0-3,1.886,3.743,3.743,0,0,0-.35.639.323.323,0,0,0,.015.289,6.067,6.067,0,0,0,.411.608,5.778,5.778,0,0,0,.7.791,9.112,9.112,0,0,0,.7.608,6.936,6.936,0,0,0,8.274,0,6.685,6.685,0,0,0,.7-.608,7.021,7.021,0,0,0,.7-.791,5.329,5.329,0,0,0,.411-.608A.26.26,0,0,0,36.147,250.375Z" transform="translate(-24.165 -247.841)" fill="#888"/>
                                                    </g>
                                                    </g>
                                                </g>
                                                </svg>

                                                </span>
                                                <span class="maan-item-text"><a href="#">{{ $photogallery->reporter_name }}</a></span>
                                            </li>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ date("d M, Y", strtotime($photogallery->created_at)) }}</span>

                                            </li>
                                        </ul>
                                        <h4><a href="{{ route('photogallery.details',$photogallery->id) }}">{{ $photogallery->title }}</a></h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        @foreach($photogalleries as $photogallery )
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                <a href="{{ route('photogallery.details',$photogallery->id) }}">
                                <img loading="lazy" src="{{ asset($photogallery->image) }}" alt="top-news">
                                    <a/>
                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <ul>
                                        <li>
                                            <span class="maan-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12.007" height="13.414" viewBox="0 0 12.007 13.414">
                                        <g   transform="translate(-24.165)">
                                            <g   data-name="Group 466" transform="translate(26.687)">
                                            <g   data-name="Group 465" transform="translate(0)">
                                                <path   data-name="Path 845" d="M114.274,0a3.483,3.483,0,1,0,3.483,3.483A3.492,3.492,0,0,0,114.274,0Z" transform="translate(-110.791)" fill="#888"/>
                                            </g>
                                            </g>
                                            <g    data-name="Group 468" transform="translate(24.165 7.215)">
                                            <g   data-name="Group 467" transform="translate(0)">
                                                <path   data-name="Path 846" d="M36.147,250.375a3.247,3.247,0,0,0-.35-.639,4.329,4.329,0,0,0-3-1.886.641.641,0,0,0-.441.106,3.712,3.712,0,0,1-4.38,0,.571.571,0,0,0-.441-.106,4.3,4.3,0,0,0-3,1.886,3.743,3.743,0,0,0-.35.639.323.323,0,0,0,.015.289,6.067,6.067,0,0,0,.411.608,5.778,5.778,0,0,0,.7.791,9.112,9.112,0,0,0,.7.608,6.936,6.936,0,0,0,8.274,0,6.685,6.685,0,0,0,.7-.608,7.021,7.021,0,0,0,.7-.791,5.329,5.329,0,0,0,.411-.608A.26.26,0,0,0,36.147,250.375Z" transform="translate(-24.165 -247.841)" fill="#888"/>
                                            </g>
                                            </g>
                                        </g>
                                        </svg>

                                            </span>
                                            <span class="maan-item-text"><a href="#">{{ $photogallery->reporter_name }}</a></span>
                                        </li>
                                        <li>
                                            <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                            <span class="maan-item-text">{{ $photogallery->created_at->format('d M, Y') }}</span>

                                        </li>
                                    </ul>
                                    <h4><a href="{{ route('photogallery.details',$photogallery->id) }}">{{ $photogallery->title }}</a></h4>
                                    <p>{{ $photogallery->summary }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Popular post') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets maan-bg-tr">
                        <div class="popular-post">
                            @foreach($popularphotogalleries as $popularnewsphotogallery)
                            <div class="card maan-default-post">
                                <div class="maan-post-img">
                                    <a href="{{ route('photogallery.details',$popularnewsphotogallery->id) }}">
                                    <img loading="lazy" src="{{ asset($popularnewsphotogallery->image) }}" alt="top-news">
                                        <a/>
                                </div>
                                <div class="card-body maan-card-body">
                                    <div class="maan-text">
                                        <h4><a href="{{ route('photogallery.details',$popularnewsphotogallery->id) }}">{{ $popularnewsphotogallery->title }}</a></h4>
                                        <ul>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ $popularnewsphotogallery->created_at->format('d M, Y') }}</span>
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
                                    $photogalleries1 = photogalleries();
                                @endphp
                                @foreach($photogalleries1 as $photogallery1)
                                    <li>
                                        <a href="{{ route('photogallery.details',$photogallery1->id) }}"><img loading="lazy" src="{{ asset($photogallery1->image) }}" alt="gallery"></a>
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
                                @foreach($recentphotogalleries as $recentnewsphotogallery)
                                <li>
                                    <div class="maan-list-img">
                                        <a href="{{ route('photogallery.details',$recentnewsphotogallery->id) }}">
                                        <img loading="lazy" src="{{ asset($recentnewsphotogallery->image) }}" alt="list-news-img">
                                        </a>
                                    </div>
                                    <div class="maan-list-text">
                                        <h4><a href="{{ route('photogallery.details',$recentnewsphotogallery->id) }}">{{ $recentnewsphotogallery->title }}</a></h4>
                                        <ul>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ $recentnewsphotogallery->created_at->format('d M, Y') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Tags') }}</h2>
                        </div>
                    </div>
                    <div class="maan-widgets">
                        <div class="widgets-tags">
                            <ul>
                                <li><a href="{{route('home')}}">{{ __('Home') }}</a></li>
                                <li><a href="{{ route('national') }}">{{ __('National') }}</a></li>
                                <li><a href="{{ route('business') }}">{{ __('Business') }}</a></li>
                                <li><a href="{{ route('world') }}">{{ __('World') }}</a></li>
                                <li><a href="{{ route('politics') }}">{{ __('Politics') }}</a></li>
                                <li><a href="{{ route('technology') }}">{{ __('Technology') }}</a></li>
                                <li><a href="{{ route('lifestyle') }}">{{ __('Lifestyle') }}</a></li>
                                <li><a href="{{ route('entertainment') }}">{{ __('Entertainment') }}</a></li>
                                <li><a href="{{ route('sports') }}">{{ __('Sports') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Maan Photo Gallery End -->
    <!-- Maan Pagination Start -->
    <nav class="maan-pagination" aria-label="Page navigation example">
        <div class="container">
            {{ $photogalleries->links() }}
        </div>
    </nav>
    <!-- Maan Pagination End -->
@endsection
