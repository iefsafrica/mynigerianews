<footer class="news10-food-footer-section news10-section pb-0">
    <div class="container">
        <a href="{{ URL('/') }}" class="news10-food-footer-logo"><img src="{{ asset('images/logo.png') }}" alt=""></a>
        <div class="news10-food-footer-nav">
            <ul>
                <li><a href="{{ URL('/') }}">{{ home() }}</a></li>
                <li><a href="{{ route('contactus') }}">{{ contactus() }}</a></li>
            </ul>
        </div>
        <div class="news10-food-social-link">
            <ul>
                @foreach(socials() as $social)
                    <li><a href="{{$social->url}}"><i class="{{$social->icon_code}}"></i></a></li>
                @endforeach
            </ul>

        </div>
    </div>
     <div class="col-lg-4">
                    <span class="copy_right text-center"><strong>{{ date('Y') }} All rights reserved <a href=""> Walpberry </a></strong></span>
                    <!--<span class="copy_right text-center">{{__('©')}}{!! $companyInfo->copyright !!}</span>-->
                </div>
</footer>
