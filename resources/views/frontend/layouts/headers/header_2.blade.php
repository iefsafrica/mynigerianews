<div class="news10-overlay"></div>
<header class="news10-new-header">
    <!-- news10 Top Bar Start -->
    <div class="news10-newtop-header">
        <div class="container">
            <h3>{{__('Breaking News :')}}</h3>
            <div class="news10-newbreaking-news swiper-container">
                <div class="swiper-wrapper">

                        {{--start dynamic breaking news include --}}

                        @include('frontend.layouts._dynamic_breakingnews')

                        {{--end dynamic breaking news include --}}



                </div>
            </div>
        </div>
    </div>
    <!-- news10 Top Bar End -->
    <!-- news10 Mid Bar Start -->
    <div class="news10-newmiddle-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-4 col-xl-4 date-time">
                    <div class="maan-current-date header-date">
                        <i class="fal fa-calendar-check"></i>

                        <span class="maan-current-week" id="maan-current-week-day"></span> {{ __(':') }} <span class="maan-current-day" id="maan-current-date"> </span>

                    </div>

                </div>

                <div class="col-md-4">
                    <a href="{{ URL('/') }}" class="new-header-logo"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                </div>
                <div class="col-md-4 text-right">
                    <ul>
                        @foreach(socials() as $social)
                            <li><a href="{{$social->url}}"><i class="{{$social->icon_code}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- news10 Mid Bar End -->

</header>

<script>
    var optionsWeekday = { weekday: 'long' };
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var date = new Date();
    document.getElementById("maan-current-week-day").innerHTML =date.toLocaleDateString("en-US", optionsWeekday);
    document.getElementById("maan-current-date").innerHTML =date.toLocaleDateString("en-US", options);

</script>
