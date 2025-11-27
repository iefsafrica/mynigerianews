<footer class="news10-fashion-footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="news10-fashion-footer-items">
                    <a href="{{ URL('/') }}" class="news10-fashion-footer-logo"><img src="{{ asset(settings()->logo_footer) }}" alt="footer-logo"></a>
                    <p>{{ settings()->footer_content }}</p>
                    <div class="news10-fashion-social-link">
                        <h5>{{__('Follow us :')}}</h5>
                        <ul>
                            @foreach(socials() as $social)
                                <li><a href="{{$social->url}}"><i class="{{$social->icon_code}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="news10-fashion-footer-items">
                    <h2 class="footer-title">{{__('Popular Post')}}</h2>
                    @foreach( popularsnews() as $key=>$popularnews)
                        @if($key == 2)
                            @break;
                        @endif
                    <div class="news10-single-post news10-sm-single-post news10-effect-wraper">
                        @if($popularnews->image)
                            @php
                                $images = json_decode($popularnews->image)
                            @endphp
                            @if($images !='')
                                @foreach($images as $image)
                                    <a href="@if($popularnews->news_categoryslug){{ route(strtolower($popularnews->news_categoryslug).'.details',$popularnews->id) }} @endif" class="post-thumb news10-hover-effect">
                                        <img src="{{ asset($image) }}" alt="">
                                    </a>
                                @endforeach
                            @endif
                        @endif
                        <div class="single-post-content-wrapper">
                            <div class="news10-meta-info">
                                <a href="@if($popularnews->news_categoryslug){{ route(strtolower($popularnews->news_categoryslug).'.details',$popularnews->id) }} @endif" class="fashion-ctg">{{ $popularnews->tags }}</a>
                                <div class="post-author-date">
                                    <span class="author">{{__('by :')}} {{ $popularnews->reporter_name }} |</span>
                                    <span class="date">{{  (new \Illuminate\Support\Carbon($popularnews->date))->format('d M Y') }}</span>
                                </div>
                            </div>
                            <a href="@if($popularnews->news_categoryslug){{ route(strtolower($popularnews->news_categoryslug).'.details',$popularnews->id) }} @endif" class="title">{{ $popularnews->title }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="news10-fashion-footer-items">
                    <h2 class="footer-title">{{__('Gallery')}}</h2>
                    <div class="maan-widgets">
                        <div class="widgets-gallery">
                            <ul>
                                @php
                                    $photogalleries = photogalleries();
                                @endphp
                                @foreach($photogalleries as $photogallery)
                                    <li>
                                        <a href="{{ route('photogallery.details',['id'=>$photogallery->id,'slug'=>\Illuminate\Support\Str::slug($photogallery->title)]) }}"><img src="{{ asset($photogallery->image) }}" alt="gallery"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-lg-4">
                    <span class="copy_right text-center">©2025. Powered by Walpberry Consultant</span>
                    <!--<span class="copy_right text-center">{{__('©')}}{!! $companyInfo->copyright !!}</span>-->
                </div>
</footer>
