<footer class="news10-footer-section maan-travel-news-footer news10-data-background" data-background="{{ asset('frontend/img/footer/img1.png') }}">
    <a href="{{ URL('/') }}" class="footer-logo">
        <img src="{{ asset('images/logo.png') }}" alt="footer-logo">
    </a>
    <div class="news10-footer-social-link">
        <ul>
            @foreach(socials() as $social)
                <li><a href="{{$social->url}}"><i class="{{$social->icon_code}}"></i></a></li>
            @endforeach
        </ul>
    </div>
     <div class="col-lg-4">
                    <span class="copy_right text-center"><strong>{{ date('Y') }} All rights reserved <a href=""> Walpberry </a></strong></span>
                    <!--<span class="copy_right text-center">{{__('©')}}{!! $companyInfo->copyright !!}</span>-->
                </div>
</footer>
