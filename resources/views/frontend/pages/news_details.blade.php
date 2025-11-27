@extends('frontend.master')
@section('meta_content')
    @php
        $imagemeta = json_decode($getnews->image);
    @endphp
    <meta name="keywords" content="{{ $getnews->meta_keyword }}">
    <meta name="title" content="{{ $getnews->title }}">
    <meta name="description" content="{{ $getnews->meta_description }}">
    <meta name="author" content="{{ $getnews->reporter_name }}">

    <meta property="og:keywords" content="{{ $getnews->meta_keyword }}">
    <meta property="og:title" content="{{ $getnews->title }}">
    <meta property="og:description" content="{{ $getnews->meta_description }}">
    <meta property="og:author" content="{{ $getnews->reporter_name }}">
    <meta property="og:image" content="{{ asset($imagemeta[0]) }}" />

@endsection

@section('main_content')
    <main>
        <!-- Maan Breadcrumb Start -->
        <nav aria-label="breadcrumb" class="maan-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getnews->news_category }}</li>
                </ol>
            </div>
        </nav>
        <!-- Maan Breadcrumb End -->
        <!-- Maan Archive Details Start -->
        <section class="maan-archive-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="maan-title-border-none">
                            <div class="maan-title-text">
                                <h2>{{ $getnews->title }}</h2>
                            </div>
                        </div>
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                @if ($getnews->image)
                                    @php
                                        $images = json_decode($getnews->image);
                                    @endphp
                                    @if($images!='')
                                        @foreach ($images as $image)
                                            @if (File::exists($image))

                                                <img loading="lazy" src="{{ asset($image) }}" alt="top-news">
                                            @endif
                                        @endforeach
                                    @endif

                                @endif

                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <div class="row">
                                        <div class="col-md-12">
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
                                                    <span class="maan-item-text"><a href="#">{{ $getnews->reporter_name }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($getnews->date))->format('d M, Y') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="maan-post-adds">
                                            @if (advertisement())
                                                {!! advertisement()->before_post_ads !!}
                                            @else
                                                <a href="https://www.google.com/" target="_blank">
                                                    <img loading="lazy" src="{{ asset('public/frontend/img/post-add/add.jpg') }}" alt="{{ asset('public/frontend/img/post-add/add.jpg') }}">
                                                </a>
                                            @endif


                                        </div>
                                    </div>
                                    <p>{!! $getnews->description !!} </p>
                                </div>
                            </div>
                        </div>

                        <div class="maan-post-adds">
                            @if (advertisement())
                                {!! advertisement()->after_post_ads !!}
                            @else
                                <a href="https://www.google.com/" target="_blank">
                                    <img loading="lazy" src="{{ asset('public/frontend/img/post-add/add.jpg') }}" alt="{{ asset('public/frontend/img/post-add/add.jpg') }}">
                                </a>
                            @endif


                        </div>

                        <div class="social-media blog-details-social">
                            <h6>Share Now</h6>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u= {{url()->current()}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url= {{url()->current()}}"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="maan-news-form">
                            <h4>{{ __('Leave a Reply') }}</h4>
                            <p>{{ __('Your email address will not be published. Required fields are marked *') }}</p>
                            <form class="row" action="{{route('news.comment',$getnews->id)}}" method="POST">
                                @csrf
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Your Name">
                                    @error('name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Your Email">
                                    @error('email')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea name="comment" placeholder="Write Comments"></textarea>
                                    @error('comment')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit">{{ __('Post Comment') }}</button>
                                </div>
                            </form>
                            <div>

                                @foreach($newscomments as $newscomment)
                                    <div class="custom-group row">
                                        <div class=" col-md-1 col-2">
                                            <span class="icon"><svg viewBox="0 0 512 512"><path d="M333.187,237.405c32.761-23.893,54.095-62.561,54.095-106.123C387.282,58.893,328.389,0,256,0 S124.718,58.893,124.718,131.282c0,43.562,21.333,82.23,54.095,106.123C97.373,268.57,39.385,347.531,39.385,439.795 c0,39.814,32.391,72.205,72.205,72.205H400.41c39.814,0,72.205-32.391,72.205-72.205 C472.615,347.531,414.627,268.57,333.187,237.405z M164.103,131.282c0-50.672,41.225-91.897,91.897-91.897 s91.897,41.225,91.897,91.897S306.672,223.18,256,223.18S164.103,181.954,164.103,131.282z M400.41,472.615H111.59 c-18.097,0-32.82-14.723-32.82-32.821c0-97.726,79.504-177.231,177.231-177.231s177.231,79.504,177.231,177.231 C433.231,457.892,418.508,472.615,400.41,472.615z"></path></svg></span>
                                        </div>
                                        <div class="col-md-10">
                                            <h4>{{ $newscomment->name }}</h4>
                                            <p>{{ $newscomment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="container">
                                {{ $newscomments->links() }}
                            </div>

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
                                <h2>{{ __('Category') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="category-link">
                                <ul>
                                    @php
                                        $newscategories = newscategories();
                                    @endphp
                                    @foreach($newscategories as $newscategory)
                                        <li><a href="@if(Route::has(strtolower($newscategory->slug))){{ route(strtolower($newscategory->slug),$newscategory->name) }}@endif">{{ $newscategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="maan-news-side-add">
                            @if (advertisement())
                                {!! advertisement()->sidebar_ads !!}
                            @else
                                <a class=side-add-thumb href="">
                                    <img loading="lazy" src="https://towhid.maantheme.com/public/frontend/img/video-news/big-img-1.jpg" alt="add">
                                </a>
                                <div class="add-text">
                                    <span class="add-title">{{__('Awesome News & Blog Theme For Your Next Project')}}</span>
                                    <a href="" class="add-btn">{{__('Buy Now')}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.036" height="13.233" viewBox="0 0 9.036 13.233">
                                            <path id="Path_4286" data-name="Path 4286" d="M3097.58-672l5.818,5.606-5.818,5.453" transform="translate(-3096.539 673.08)" fill="none" stroke="#fff" stroke-width="3"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif

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
                                            <a href="{{ route('photogallery.details',['id'=>$photogallery->id,'slug'=>\Illuminate\Support\Str::slug($photogallery->title)]) }}"><img loading="lazy" src="{{ asset($photogallery->image) }}" alt="gallery"></a>
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
                                    @foreach(newscategories() as $newscategory)
                                        <li><a href="{{route($newscategory->slug,$newscategory->name)}}">{{ $newscategory->name }}</a></li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Social Media') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="social-media">
                                <ul>
                                    @foreach($socials as $social)
                                        <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon_code}}"></i></a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Maan Archive Details End -->
        <!-- Maan Related Posts Start -->
        <section class="maan-related-posts">
            <div class="container">
                <div class="maan-title">
                    <div class="maan-title-text">
                        <h2>{{ __('Related Posts') }}</h2>
                    </div>
                </div>
                <div class="row maan-post-groop">
                    @foreach($relatedgetsnews as $relatednews)
                    <div class="col-lg-4">
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                @if ($relatednews->image)
                                    @php
                                        $images = json_decode($relatednews->image);
                                    @endphp
                                    @if($images!='')
                                        @foreach ($images as $image)
                                            @if (File::exists($image))
                                                <a href="{{ route($relatednews->news_categoryslug.'.details',['id'=>$relatednews->id,'slug'=>\Illuminate\Support\Str::slug($relatednews->title)]) }}">
                                                    <img loading="lazy" src="{{ asset($image) }}" alt="top-news">
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif

                                @endif

                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <h4><a href="{{ route($relatednews->news_categoryslug.'.details',['id'=>$relatednews->id,'slug'=>\Illuminate\Support\Str::slug($relatednews->title)]) }}">{{ $relatednews->title }}</a></h4>
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
                                            <span class="maan-item-text"><a href="#">{{ $relatednews->reporter_name }}</a></span>
                                        </li>
                                        <li>
                                            <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                            <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($relatednews->date))->format('d M, Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Maan Related Posts End -->
    </main>

@endsection
