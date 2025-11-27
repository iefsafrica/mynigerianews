;(function($) {
    "use strict";  
      
    $(window).on('load', function(){
        $('.preloader').fadeOut(1000);
    }) 
    // Navbar Fixed  
    function navbarFixed(){
        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();   
            if (scroll >= 162) {
                $("header").addClass("navbar_fixed");
            } else {
                $("header").removeClass("navbar_fixed");
            }
        });
    };  


    // mobile menu 
    function MobileMenu (){
        $('.news10-nav-open, .manu-btn, .news10-h-manu-btn').click (function(){
            $(".nav-close, .news10-overlay").click(function(){
                $("body").removeClass("nav_activee");
                $(".news10-nav-open").removeClass("open");
            });
            $(this).toggleClass('open');
            $('body').toggleClass("nav_activee");
        });
        if($('.mobile-menu li.dropdown ul').length){
            $('.mobile-menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
            $('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
                $(this).prev('ul').slideToggle(500);
            });
        }
    }



    // search news10l 
    
    function searchnews10l(){
        $('.search-bar, .news10-search-btn').click( function (){
                  
            $('body').addClass('nav_activeee');  	  
        });
        
        $('.nav-close, .news10-overlay').click( function (){
              
            $('body').removeClass('nav_activeee');  
        });
    };

        
    /*=====================
    search
    =======================*/
    // $(".searchbtn").click(function(){
    //     $("section").click(function(){
    //         $(".wrapper").removeClass("search-area");
    //         $(".searchbtn").removeClass("bg-green");
    //       });
    //     $(this).toggleClass("bg-green");
    //     $(".fas").toggleClass("color-white");
        
    //     $(".wrapper").toggleClass("search-area");
        

    //     $(".input").focus().toggleClass("active-width").val('');
    // });


    
    //* nice select.js
    function niceSelect() {
        if ($('.nice-select').length) { 
            $('select').niceSelect();
        };
    };



    

    // data background 
    function bgImg() {
        $("[data-background]").each(function() {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    }

    // swiperslider 
    function swipperSlider (){
        if ($('.news10-banner-section, .news10-instagram-story-section, .news10-post-categories-section, .news10-trending-news-section, .news10-featured-story-news-section, .news10-fashion-testimonials-section, .news10-food-banner-section, .news10food-categories-section, .news10-food-instagram-follow').length){

            var swiper1 = new Swiper(".news10-banner-slider-wraper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                    navigation: {
                    nextEl: "#banner-next",
                    prevEl: "#banner-prev",
                    },
            });

            var swiper2 = new Swiper(".news10-food-banner-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + (index + 1) + "</span>";
                    },
                },
            });
            var swiper3 = new Swiper(".maaa-testimonials-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                    navigation: {
                    nextEl: "#testimonial-next",
                    prevEl: "#testimonial-prev",
                    },
            });

            var swiper4 = new Swiper(".news10-trending-news-slide-wraper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                    navigation: {
                    nextEl: "#ctgNews-next",
                    prevEl: "#ctgNews-prev",
                    },
            });

            var swiper5 = new Swiper(".news10-instagram-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                    navigation: {
                    nextEl: "#instra-next",
                    prevEl: "#instra-prev",
                    },
                breakpoints: {
                    1200: {
                        slidesPerView: 5,
                        spaceBetween: 30
                    },
                    1000: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                }
            });

            var swiper6 = new Swiper(".news10-food-instagram-follow-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                speed: 1000,
                    navigation: {
                    nextEl: "#instra-next",
                    prevEl: "#instra-prev",
                    },
                breakpoints: {
                    1200: {
                        slidesPerView: 6,
                    },
                    1000: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    400: {
                        slidesPerView: 2,
                    },
                    320: {
                        slidesPerView: 1,
                    },
                }
            });

            var swiper7 = new Swiper(".news10-food-categories-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    991: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                }
            });

            var swiper8 = new Swiper(".news10-featured-slide-wrapper", {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                speed: 1000,
                    navigation: {
                    nextEl: "#featured-next",
                    prevEl: "#featured-prev",
                    },
                breakpoints: {
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    1000: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                }
            });

            var swiper9 = new Swiper(".news10-cetegoris-top-slide", {
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                    speed: 500,
                    loop: true,
                    pagination: {
                    el: ".swiper-pagination",
                    type: "fraction"
                },
                navigation: {
                    nextEl: "#banner-next",
                    prevEl: "#banner-prev",
                },
                on: {
                init: function () {
                    $(".swiper-progress-bar").removeClass("animate");
                    $(".swiper-progress-bar").removeClass("active");
                    $(".swiper-progress-bar").eq(0).addClass("animate");
                    $(".swiper-progress-bar").eq(0).addClass("active");
                },
                slideChangeTransitionStart: function () {
                    $(".swiper-progress-bar").removeClass("animate");
                    $(".swiper-progress-bar").removeClass("active");
                    $(".swiper-progress-bar").eq(0).addClass("active");
                },
                slideChangeTransitionEnd: function () {
                    $(".swiper-progress-bar").eq(0).addClass("animate");
                }
                }
            });
            
        }
    }



        	//* Isotope js
    function isotopee(){
        if ( $('.news10-news-section').length ){ 
            // Activate isotope in container
            $(".protfoli_inner").imagesLoaded( function() {
                $(".protfoli_inner").isotope({
                    layoutMode: 'masonry',  
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                }); 
                
            });  
        };
    };


     // video popup 
     function lity (){
        if ($('.play_btn').length){
            $(document).on('click', '[data-lightbox]', lity);
        }
    };






    function news10Swiper(){
        var swiper10 = new Swiper(".news10-breaking-news-section .news10-slide-text", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
                navigation: {
                nextEl: "#breakingnews-next",
                prevEl: "#breakingnews-prev",
                },
        });

        var swiper10 = new Swiper(".news10-banner-slider .news10-banner-slider-wrapper", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
        });

        var swiper10 = new Swiper(".news-tech-breaking .news10-techheader-breaking", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
                navigation: {
                nextEl: "#breakingnews-next",
                prevEl: "#breakingnews-prev",
                },
        });

        var swiper10 = new Swiper(".news10-most-popular-section .news10-mostpopular-slide", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
                navigation: {
                nextEl: "#mostpopular-next",
                prevEl: "#mostpopular-prev",
                },
        });

        var swiper10 = new Swiper(".news10-entertainment-news .entertainment-slide-wrapper", {
            loop: true,
            autoplay: true,
            spaceBetween: 30,
            slidesPerView: 2,
            speed: 1000,
                navigation: {
                nextEl: "#entertainment-next",
                prevEl: "#entertainment-prev",
                },
                breakpoints: {
                    1200: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1000: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                },
            
        });

        var swiper10 = new Swiper(".news10-sports-news-section .sports-slide-wrapper", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
                navigation: {
                nextEl: "#entertainment-next",
                prevEl: "#entertainment-prev",
                },
        });

        var swiper11 = new Swiper(".news10-top-categories-section .news10-news-categories-slideer", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 4,
            speed: 1000,
                navigation: {
                nextEl: "#topcategories-next",
                prevEl: "#topcategories-prev",
                },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });

        var swiper11 = new Swiper(".news10-video-news-section .news10-video-news-slide", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 2,
            speed: 1000,
                navigation: {
                nextEl: "#video1-next",
                prevEl: "#video1-prev",
                },
            breakpoints: {
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });
        var swiper11 = new Swiper(".news10-don-t-miss-section .news10-miss-slide-wraper", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 6,
            speed: 1000,
            breakpoints: {
                1200: {
                    slidesPerView: 6,
                },
                1000: {
                    slidesPerView: 4,
                },
                640: {
                    slidesPerView: 3,
                },
                320: {
                    slidesPerView: 1,
                },
            }
        });

        var swiper11 = new Swiper(".news10-trending-news .news10-trading-news-slide", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 3,
            speed: 1000,
                navigation: {
                nextEl: "#Trending-next",
                prevEl: "#Trending-prev",
                },
            breakpoints: {
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });

        var swiper11 = new Swiper(".news10-latest-technology .news10-row-slide", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 3,
            speed: 1000,
                navigation: {
                nextEl: "#technology-next",
                prevEl: "#technology-prev",
                },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });

        var swiper11 = new Swiper(".news10-new-from-gadgets .news10-gadgets-slide-wraper", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 3,
            speed: 1000,
            breakpoints: {
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });
    };



    


    /*=====================
        3 Banner
    =======================*/
    function banner() {
        $("[data-background]").each(function() {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    }

    /*=====================
        3 Load more
    =======================*/
    function loadMore() {
        $(document).ready(function(){
            $(".loadcontent").slice(0, 2).show();
            $("#loadMore").on("click", function(e){
                e.preventDefault();
                $(".loadcontent:hidden").slice(0, 2).slideDown();
                if($(".loadcontent:hidden").length == 0) {
                $("#loadMore").text("No Content").addClass("noContent");
                }
            });
        })
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


    function newHome(){
        var swiper1 = new Swiper(".news10-newbreaking-news", {
            loop: true,
            spaceBetween: 0,
            slidesPerView: 1,
            speed: 1000,
            autoplay: true,
        });
        // var swiper2 = new Swiper(".feature-post-slideer", {
        //     loop: true,
        //     spaceBetween: 0,
        //     slidesPerView: 1,
        //     preloadImages: false,
        //     lazy: true,
        //     speed: 1000,
        //     autoplay: true,
        //         navigation: {
        //         nextEl: "#features-next2",
        //         prevEl: "#features-prev2",
        //         },
        // });
        var swiper2 = new Swiper(".news10-newside-slider", {
            loop: true,
            spaceBetween: 0,
            slidesPerView: 1,
            preloadImages: false,
            lazy: true,
            speed: 1000,
            autoplay: true,
                navigation: {
                nextEl: "#features-next1",
                prevEl: "#features-prev1",
                },
        });
      
        var swiper3 = new Swiper(".new-features-sldier", {
            loop: true,
            autoplay: true,
            spaceBetween: 0,
            slidesPerView: 4,
            preloadImages: false,
            lazy: true,
            speed: 1000,
                navigation: {
                nextEl: "#features-next",
                prevEl: "#features-prev",
                },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                1000: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
            }
        });
        var swiper4 = new Swiper(".news10-weekly-review-wrapper", {
            loop: true,
            spaceBetween: 0,
            slidesPerView: 5,
            preloadImages: false,
            lazy: true,
            speed: 1000,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 37
                },
                1000: {
                    slidesPerView: 4,
                    spaceBetween: 37
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 37
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 30
                },
            }
        });
    }
    newHome();

  

    
    /*Function Calls*/
    navbarFixed ();
    MobileMenu ();
    searchnews10l();
    counterUp();
     venobox();
    niceSelect();
    bgImg();
    swipperSlider ();
    news10Swiper();
    lity ();
    isotopee ();
    banner();
    loadMore();
})(jQuery); 
