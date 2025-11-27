/*
Theme Name: Maan News HTML5 Template
Theme URI: https://maantheme.com/maan-news
Author: Maan Theme
Author URI: https://maantheme.com
Desing by: Maan Theme
Version: 1.0
License:
Tags:
*/


(function($) {
    "use strict";
    bgImg()
    manuBar()
    breakingNews()
    topCategories()
    bigPostSlide()
    cardSlide()
    gallerySlide()
    counterUp()
    venobox()
    entertainmentSlide()
    aboutPageSlide()

    /*====== Active Plugins ======

        1 Manu Bar

        2 Breaking News

        3 Top Categories

        4 Big Post Slide

        5 Card Slide

        6 Gallery Slide

        7 Counter Up

        8 Venobox

    =============================*/

    /*=====================
        1 Manu Bar
    =======================*/

    // data background
    function bgImg() {
        $("[data-background]").each(function() {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    }

    function manuBar() {
        let topManuStor = $(".maan-top-bar").html();
        let MidBarStor = $(".maan-mid-bar").html();
        let manuBarStor = $(".maan-manu-bar").html();

        let manuShow = (`<div class="maan-hide-manu"><div class="maan-top-bar">${topManuStor}</div><div class="maan-mid-bar">${MidBarStor}</div></div><div class="maan-manu-bar">${manuBarStor} </div>`);
        $("header.sticky-manu").html(manuShow);

        let yourManu = $(".maan-hide-manu, .maan-manu-bar").height() + 99;
        let yourNavigation = $(".maan-top-bar ,.maan-manu-bar, .maan-mid-bar");
        let stickyDiv = "sticky";
        $(window).scroll(function() {
            if ($(this).scrollTop() > yourManu) {
                yourNavigation.addClass(stickyDiv);
            } else {
                yourNavigation.removeClass(stickyDiv);
            }
        });

        let manuShow2 = (`<div class="maan-top-bar">${topManuStor}</div><div class="maan-wrap-manu"><div class="maan-mid-bar">${MidBarStor}</div><div class="maan-manu-bar">${manuBarStor} </div></div>`);
        $("header.sticky-mid-manu").html(manuShow2);

        let yourManu2 = $("header.sticky-mid-manu .maan-top-bar").height() + 25;
        let yourNavigation2 = $("header.sticky-mid-manu .maan-top-bar, header.sticky-mid-manu .maan-wrap-manu");
        $(window).scroll(function() {
            if ($(this).scrollTop() > yourManu2) {
                yourNavigation2.addClass(stickyDiv);
            } else {
                yourNavigation2.removeClass(stickyDiv);
            }
        });

        let storFile = $(".maan-manu-bar").html();
        $(".maan-manu-bar").html(storFile + "<span class='overlay'></span>")

        $(".maan-manu-bar .manu-btn").on("click", function() {
            $(this).addClass("active");
            $(".maan-main-manu").addClass("active");
            $(".maan-manu-bar .overlay").addClass("active");
        });

        $(".maan-manu-bar .close-btn ,.maan-manu-bar .overlay").on("click", function() {
            $(".maan-manu-bar .manu-btn").removeClass("active");
            $(".maan-main-manu").removeClass("active");
            $(".maan-manu-bar .overlay").removeClass("active");
        });
    }

    /*=====================
        2 Breaking News
    =======================*/
    function breakingNews() {
        $(".maan-breaking-news-section .maan-slide-text").slick({
            autoplay: true,
            slidesToShow: 1,
            autoplaySpeed: 1000,
            speed: 4500,
            draggable: false,
            infinite: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            arrows: true,
            nextArrow: '<button class="btn-next"><svg viewBox="0 0 451.8 451.8"><path d="M354.7,225.9c0,8.1-3.1,16.2-9.3,22.4L151.2,442.6c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9 L106.4,54c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.7,0l194.3,194.3C351.6,209.7,354.7,217.8,354.7,225.9z"/></svg></button>',
            prevArrow: '<button class="btn-prev"><svg viewBox="0 0 451.847 451.847"> <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></svg></button>',
        });
    }
    /*=====================
        3 Top Categories
    =======================*/
    function topCategories() {
        $(".maan-top-categories-section.maan-slide .row").slick({
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplaySpeed: 900,
            speed: 1000,
            infinite: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            arrows: true,
            nextArrow: '<button class="btn-next"><svg viewBox="0 0 451.8 451.8"><path d="M354.7,225.9c0,8.1-3.1,16.2-9.3,22.4L151.2,442.6c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9 L106.4,54c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.7,0l194.3,194.3C351.6,209.7,354.7,217.8,354.7,225.9z"/></svg></button>',
            prevArrow: '<button class="btn-prev"><svg viewBox="0 0 451.847 451.847"> <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></svg></button>',
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                }, {
                    breakpoint: 577,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
    }
    /*=====================
        4 Big Post Slide
    =======================*/
    function bigPostSlide() {
        $(".maan-slide-section .maan-slide").slick({
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplaySpeed: 2500,
            speed: 1000,
            draggable: false,
            infinite: true,
            arrows: true,
            nextArrow: '<button class="btn-next"><svg viewBox="0 0 451.8 451.8"><path d="M354.7,225.9c0,8.1-3.1,16.2-9.3,22.4L151.2,442.6c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9 L106.4,54c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.7,0l194.3,194.3C351.6,209.7,354.7,217.8,354.7,225.9z"/></svg></button>',
            prevArrow: '<button class="btn-prev"><svg viewBox="0 0 451.847 451.847"> <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></svg></button>',
        });
    }

    /*=====================
        maan-entertainment-news
    =======================*/
    function entertainmentSlide() {
        $(".maan-entertainment-news .maan-entertainmentslide").slick({
            autoplay: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplaySpeed: 2500,
            speed: 1000,
            draggable: false,
            infinite: true,
            arrows: true,
            nextArrow: '<button class="btn-next"><svg viewBox="0 0 451.8 451.8"><path d="M354.7,225.9c0,8.1-3.1,16.2-9.3,22.4L151.2,442.6c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9 L106.4,54c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.7,0l194.3,194.3C351.6,209.7,354.7,217.8,354.7,225.9z"/></svg></button>',
            prevArrow: '<button class="btn-prev"><svg viewBox="0 0 451.847 451.847"> <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></svg></button>',
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 1000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    }
    /*=====================
        5 Card Slide
    =======================*/
    function cardSlide() {
        $(".maan-slide-section .maan-card-slide").slick({
            autoplay: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplaySpeed: 2500,
            speed: 1000,
            infinite: true,
            arrows: true,
            nextArrow: '<button class="btn-next"><svg viewBox="0 0 451.8 451.8"><path d="M354.7,225.9c0,8.1-3.1,16.2-9.3,22.4L151.2,442.6c-12.4,12.4-32.4,12.4-44.8,0c-12.4-12.4-12.4-32.4,0-44.7l171.9-171.9 L106.4,54c-12.4-12.4-12.4-32.4,0-44.7c12.4-12.4,32.4-12.4,44.7,0l194.3,194.3C351.6,209.7,354.7,217.8,354.7,225.9z"/></svg></button>',
            prevArrow: '<button class="btn-prev"><svg viewBox="0 0 451.847 451.847"> <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></svg></button>',

            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 1000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    }
    /*=====================
        6 Gallery Slide
    =======================*/
    function gallerySlide() {
        $(".maan-don-t-miss-section .maan-slide").slick({
            autoplay: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplaySpeed: 2500,
            speed: 1000,
            infinite: true,
            arrows: false,
            centerMode: true,
            centerPadding: '0px',
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                }, {
                    breakpoint: 577,
                    settings: {
                        slidesToShow: 2,
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
    }


    /*=====================
        7 about page slide
    =======================*/
    function aboutPageSlide (){
        $('.maan-slider-image').slick({
            dots: false,
            arrows: true,
            infinite: true,
            //autoplay:true,
            autoplaySpeed: 900,
            speed: 1000,
            autoplay:true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
            {
                breakpoint: 1300,
                settings: {
                slidesToShow: 3,
                slidesToScroll: 1
                }
            },
            {
                breakpoint: 1024,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                }
            },
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
            ]
        });
    }

    /*=====================
        7 Counter Up
    =======================*/
    function counterUp() {
        $(".counter").counterUp({
            delay: 10,
            time: 1000
        });
    }
    /*=====================
        8 Venobox
    =======================*/
    function venobox() {
        var popup = $(".venobox");
        $(popup).venobox();
    }

    /*=====================
    Password show and hide js
    =======================*/


    $(".eye-show").click(function() {
        $("#pass").attr("type", "text");
        $(".eye-show").hide();
        $(".eye-close").show();
    });
    $(".eye-close").click(function() {
        $("#pass").attr("type", "password");
        $(".eye-close").hide();
        $(".eye-show").show();
    });




    // Preloader JS
    function preloader(){
        if( $('.loader-inner').length ){
            $(window).on('load', function() {
                $('.loader-inner').fadeOut();
                $('.loader-inner').delay(50).fadeOut('slow');
            })
        }
    }
    preloader();
    /*=====================
        subscribe show message frontend
        =======================*/
    $('.subscribe').click(function() {
        var email = $('#maanEmail').val();

        if(email== ''){
            $('#email').next().show();
            toastr.warning('Must Be A Valid Email Address.');
            return false;
        }
        if(IsEmail(email)==false){
            toastr.warning('Must Be A Valid Email Address.');
            return false;
        }
        $.ajax({
            url:'/subscribe/ajax',
            method:"get",
            dataType:"json",
            data:{
                'email':email
            },
            success: function(data){
            if (data>0){
                toastr.warning('You email already exists!')
            }else{
                toastr.success('You Subscribed Successfully.')
            }


            },
            error: function (data) {
                console.log(data)
                alert('Error occur fetch subcategory action.....!!');
            }
        })
        //toastr.success('You Subscribed Successfully.')
    });


})(jQuery);
/*=====================
        validate subscribe email frontend footer
        =======================*/
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
        return false;
    }else{
        return true;
    }
}



