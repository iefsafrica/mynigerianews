<!DOCTYPE html>
<html lang="en" {{ getFrontSelectLanguageIsoCode() == 'ar' ? 'dir=rtl' : '' }}>
@php
    $settings = getSettingValue();
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('meta_tags'),{{ !empty(getSEOTools()) ? getSEOTools()->keyword : '' }}">
    <meta name="description"
        content="@if (View::hasSection('meta_description')) @yield('meta_description')
    @else{{ !empty(getSEOTools()) ? getSEOTools()->site_description : '' }} @endif">

    <meta http-equiv="content-language" content="{{ getFrontSelectLanguageName() ?? 'en' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image"
        content="@if (View::hasSection('meta_image')) @yield('meta_image')@else{{ $settings['logo'] }} @endif" />
    <title>@yield('title') |
        {{ !empty(getSEOTools()->site_title) ? getSEOTools()->site_title : $settings['application_name'] }} </title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $settings['favicon'] }}">
    @livewireStyles
    {!! reCaptcha()->renderJs() !!}

    @php
        $langSession = Session::get('frontLanguageChange');
        $frontLanguage = !isset($langSession) ? getSettingValue()['front_language'] : $langSession;
    @endphp
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('messages.js') }}"></script>
    <script data-turbo-eval="false">
        let userProfile = '{{ asset('images/avatar.png') }}'
        let siteKey = "{{ $settings['site_key'] }}"
        let frontLanguage = "{{ App\Models\Language::find($frontLanguage)->iso_code }}"
        let lang = "{{ getFrontSelectLanguageIsoCode() ?? 'en' }}"

        Lang.setLocale(frontLanguage)
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- Montserrat -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" /> --}}
    <!-- slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/theme1/css/custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme1/front-third-party.css') }}" />
    <script type="text/javascript" src="{{ asset('assets/theme1/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/theme1/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/helpers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme1/theme1.js') }}"></script>

    <script src="//unpkg.com/alpinejs" defer></script>
    @routes
    <script type="text/javascript" src="{{ asset('assets/js/theme1/front-third-party.js') }}"></script>
    <script src="{{ mix('assets/js/theme1/front-pages.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/tailwindcss.js') }}"></script>

    {{-- .......front page pagenation js --}}
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.hook('request', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            })
        });
    </script>
    {!! !empty(getSEOTools()->google_analytics) ? getSEOTools()->google_analytics : '' !!}
    @if (getFrontSelectLanguageIsoCode() == 'ar')
        <style>
            p, span, h1, h2, h3, h4, h5, h6 {
                padding-right: 10px;
            }
        </style>
    @endif
    <style>
        ::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c00f24;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #e8e8e8;
        }

        input[type="radio"]:checked+.custom-radio-button {
            border-color: #c00f24;
            background-color: #ffffff;
        }

        input[type="radio"]:checked+.custom-radio-button .radio-dot {
            display: block !important;
        }

        .slick-arrow {
            width: 40px;
            height: 40px;
            border: 1px solid #e8e8e8;
            border-radius: 50%;
            top: 40%;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slick-arrow.next-arrow {
            /* right: 40px; */
            {{ getFrontSelectLanguageIsoCode() == 'ar' ? "left: 120px;" : "right: 40px;" }}
        }

        .slick-arrow.prev-arrow {
            /* right: 100px; */
            {{ getFrontSelectLanguageIsoCode() == 'ar' ? "left: 50px;" : "right: 100px;" }}
        }

        .trending-slider .slick-list {
            max-width: 85%;
        }

        @media (max-width: 1023px) {
            .slick-arrow.next-arrow {
                right: 15px;
            }

            .slick-arrow.prev-arrow {
                right: 65px;
            }
        }

        @media (max-width: 767px) {
            .trending-slider .slick-list {
                max-width: 100%;
            }

            .slick-arrow.next-arrow {
                right: 15px;
                top: 100%;
            }

            .slick-arrow.prev-arrow {
                right: 65px;
                top: 100%;
            }


        }

        .sub-menu {
            display: none;
        }

        .group2:hover .sub-menu {
            opacity: 1;
            visibility: visible;
            display: block;
        }

        .image-slider .slick-arrow {
            width: 35px;
            height: 35px;
            border: 1px solid #e8e8e8;
            border-radius: 50%;
            top: 43%;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .image-slider .slick-arrow.next-arrow {
            right: 20px;
        }

        .image-slider .slick-arrow.prev-arrow {
            left: 20px;
        }

        .js-cookie-consent.cookie-consent {
            animation: all .3s ease-in;
            background: whitesmoke !important;
            text-align: center;
            padding: .75em;
            font-size: 1.1em;
            color: black;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 999;
            box-shadow: 0 2px 6px #ffffff;
        }

        .header-bg,
        .footer-bg {
            background: #F6F6F6;
        }

        .light-gray-bg {
            background: #F9FAFB;
        }

        .font-bold,
        .text-black,
        .font-semibold {
            color: #181D27;
        }

        @media only screen and (max-width: 330px) {

            .g-recaptcha,
            .contact-container {
                transform: scale(0.95);
                transform-origin: 0 0;
            }
        }

        @media only screen and (max-width: 375px) {
            .comment-container {
                min-width: 288px;
            }
        }

        @media (max-width: 575px) {
            .js-cookie-consent .max-w-7xl {
                width: fit-content !important;
            }
        }

                            .news-desc + ol li {
                                list-style: auto !important;
                            }
                            .news-desc + ul li {
                                list-style: disc !important;
                            }

    </style>
    <!-- tailwind -->
    <script src="{{ asset('assets/theme1/js/custom.js') }}"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        montserrat: ["Montserrat", "sans-serif"],
                    },
                    width: {
                        328: "328px",
                        200: "200px",
                        115: "115px",
                        140: "140px",
                        150: "150px",
                    },
                    maxWidth: {
                        218: "218px",
                        486: "486px",
                    },
                    minWidth: {
                        328: "328px",
                        40: "40px",
                        115: "115px",
                        140: "140px",
                        200: "200px",
                        150: "150px",
                    },
                    screens: {
                        xs: "475px",
                    },
                    height: {
                        405: "405px",
                        135: "135px",
                        90: "90px",
                        100: "100px",
                        205: "205px",
                        215: "215px",
                        548: "548px",
                    },
                    maxHeight: {
                        665: "665px",
                        425: "425px",
                        260: "260px",
                        592: "592px",
                    },
                    fontSize: {
                        22: "22px",
                        28: "28px",
                    },
                    colors: {
                        primary: "#C00F24",
                        "gray-50": "#DDE0E5",
                        "gray-100": "#F6F6F6",
                        "gray-200": "#838997",
                        "gray-300": "#606060",
                        "gray-400": "#6B717E",
                        white: "#ffffff",
                        black: "#181d27",
                        overlay: "#2E2C2C",
                        "red-overlay": "#C00F24",
                    },
                },
            },
        };
    </script>
    <script>
        var fontLink = document.createElement('link');
        fontLink.href = 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap';
        fontLink.rel = 'stylesheet';
        fontLink.type = 'text/css';
        document.head.appendChild(fontLink);
    </script>
</head>

<body class="font-['montserrat']">
    @include('theme1.layouts.header')
    <!-- <header> -->
    <div>
        @yield('content')
    </div>

    <!-- footer -->
    @include('theme1.layouts.footer')

    @if ($settings['show_cookie'])
        @include('cookie-consent::index')
    @endif

</body>
<script>
     let lancode = "{{ getFrontSelectLanguageIsoCode() }}";
</script>
<script>
    // business tab-section
    var tabs1 = document.querySelectorAll(" .business-tab-content .tab-pane");
    var buttons1 = document.querySelectorAll(".business-tab-section:nth-child(2) button");

    buttons1.forEach((button, index) => {
        button.addEventListener("click", () => {
            tabs1.forEach((tab) => {
                tab.classList.add("hidden");
            });
            tabs1[index].classList.remove("hidden");
            buttons1.forEach((b) => {
                b.classList.remove("text-primary", "!border-b-primary");
            });
            button.classList.add("text-primary", "!border-b-primary");
        });
    });

    //featured tab section
    var tabs2 = document.querySelectorAll(" .featured-tab-content .tab-pane");
    var buttons2 = document.querySelectorAll(".featured-tab-section:nth-child(2) button");

    buttons2.forEach((button, index) => {
        button.addEventListener("click", () => {
            tabs2.forEach((tab) => {
                tab.classList.add("hidden");
            });
            tabs2[index].classList.remove("hidden");
            buttons2.forEach((b) => {
                b.classList.remove("text-primary", "!border-b-primary");
            });
            button.classList.add("text-primary", "!border-b-primary");
        });
    });
</script>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("slider", () => ({
            index: 0,
            count: 0,
            theInterval: 0,
            timeInterval: 10000,
            move(index, clearInterval = true) {
                clearInterval && this.restartInterval();
                this.index = index;
                var el = this.$refs.slider;

                if (el) {
                    if (lancode == "ar") {
                        el.style.transform = `translateX(${this.index * +100}%)`;
                    }else{
                        el.style.transform = `translateX(${this.index * -100}%)`;
                    }
                }

                if (this.$refs.progress) {
                    if (lancode == "ar") {
                        this.$refs.progress.style.left = "auto";
                        this.$refs.progress.style.right = "0";
                    }
                    this.$refs.progress.animate(
                        [{
                            width: "0%"
                        }, {
                            width: "100%"
                        }], {
                            duration: this.timeInterval
                        }
                    );
                }
            },
            restartInterval() {
                clearInterval(this.theInterval);
                this.theInterval = setInterval(() => {
                    let index = this.index + 1;

                    if (index === this.count) {
                        index = 0;
                    }

                    this.move(index);
                }, this.timeInterval);
            },
            init() {
                this.count =
                    this.$refs.slider.querySelectorAll("li").length;

                this.move(0);
                this.restartInterval();
            },
        }));
    });
</script>
<!-- voting-poll -->
<script>
    listen('click', '.view-statistic', function() {
        let pollId = $(this).attr('data-id');
        $('#pollOption' + pollId).addClass('hidden');
        $('#pollStatistic' + pollId).removeClass('hidden');
    })
</script>
<script>
    $(document).ready(function() {
        $(".image-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            speed: 300,
            infinite: true,
            autoplaySpeed: 3000,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow" aria-label="slide-arrow" ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg></button>',
            nextArrow: '<button class="slide-arrow next-arrow" aria-label="slide-arrow"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg></button>',
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 475,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    });
</script>
<script>
    $(".play-btn").click(function() {
        $(".audio-player").removeClass("hidden");
        document.getElementById("audio").play();
        $(".player-img").addClass("rotate");
    });
    $(".close-btn").click(function() {
        $(".audio-player").addClass("hidden");
        document.getElementById("audio").pause();
    });
    var audio = document.getElementById("audio");
    var image = document.getElementById("playImage");

    if (audio != null && image != null) {
        audio.onplay = function() {
            image.classList.add("rotate");
            image.classList.remove("paused");
        };

        audio.onpause = audio.onended = function() {
            image.classList.add("paused");
        };
    }
</script>

</html>
