document.addEventListener("turbo:load", loadCategorySlickSlider);

listen("submit", "#pollVoteForm", function (event) {
    event.preventDefault();
    let audioPostSlug = $(".audioPostSlug").val();
    if (audioPostSlug == null) {
        Amplitude.stop();
    }
    if (!$(this).find("input:radio").is(":checked")) {
        return false;
    }
    $.ajax({
        type: "POST",
        url: route("vote.poll"),
        data: $(this).serialize(),
        success: function (result) {
            if (result.data) {
                $(".poll-vote-form").trigger("reset");
                let pollIdSuccess = result.data.pollId;
                let styleCss = "style";
                $("#voteSuccess" + pollIdSuccess).css("display", "block");
                $("#pollOption" + result.data.pollId).addClass("d-none");
                $("#pollStatistic" + result.data.pollId).removeClass("d-none");
                let statisticAttr = $("#pollStatistic" + result.data.pollId);
                statisticAttr.empty();

                $.each(result.data.optionAns, function (key, val) {
                    statisticAttr.append(
                        `<p class="mt-0 mb-2 fs-14">${key}</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped " role="progressbar"
                                         aria-valuenow="${val}" aria-valuemin="0" aria-valuemax="100"
                                    ${styleCss}="width: ${val}%;">
                                       <span>${val}%</span>
                                    </div>
                                </div>`
                    );
                });
                statisticAttr.append(
                    `<div class="vote d-flex justify-content-between align-items-center pt-2 mb-md-2 mb-1">
                            <span class="text-black fs-14 fw-6">` +
                        Lang.get("js.total_vote") +
                        `:${result.data.totalPollResults}</span>
                            <a href="javascript:void(0);" class="view-option fs-14 text-gray fw-6"
                               data-id="${result.data.pollId}">` +
                        Lang.get("js.view_option") +
                        `</a>
                        </div>
                        <span id='voteSuccess${pollIdSuccess}'><p class="text-success">${result.message}</p></span>`
                );
                $("#voteSuccess" + pollIdSuccess)
                    .delay(3000)
                    .slideUp(300);
            }
        },
        error: function (result) {
            let pollId = result.responseJSON.data.poll_id;
            $("#voteError" + pollId).css("display", "block");
            $("#voteError" + pollId)
                .html(
                    `<p class="text-danger">${result.responseJSON.message}</p>`
                )
                .delay(3000)
                .slideUp(300);
            $(".poll-vote-form").trigger("reset");
        },
    });
});

listen("click", ".view-option", function () {
    let pollId = $(this).attr("data-id");
    $("#pollStatistic" + pollId).addClass("d-none");
    $("#pollOption" + pollId).removeClass("d-none");
});

listen("click", ".view-statistic", function () {
    let pollId = $(this).attr("data-id");
    $("#pollOption" + pollId).addClass("d-none");
    $("#pollStatistic" + pollId).removeClass("d-none");
});

listen("submit", "#pollVoteFormTailwind", function (event) {
    event.preventDefault();
    let audioPostSlug = $(".audioPostSlug").val();
    if (audioPostSlug == null) {
        Amplitude.stop();
    }
    if (!$(this).find("input:radio").is(":checked")) {
        return false;
    }
    $.ajax({
        type: "POST",
        url: route("vote.poll"),
        data: $(this).serialize(),
        success: function (result) {
            if (result.data) {
                $(".poll-vote-form").trigger("reset");
                let pollIdSuccess = result.data.pollId;
                let styleCss = "style";
                $("#voteSuccess" + pollIdSuccess).css("display", "block");
                $("#pollOption" + result.data.pollId).addClass("hidden");
                $("#pollStatistic" + result.data.pollId).removeClass("hidden");
                let statisticAttr = $("#pollStatistic" + result.data.pollId);
                statisticAttr.empty();

                $.each(result.data.optionAns, function (key, val) {
                    statisticAttr.append(
                        `<div class="xs:grid-cols-2 gap-4 mb-7">
                        <div class="">
                        <div class="flex mb-1 items-center justify-between">
                        <div> <span class="font-medium text-sm"> "${key}"
                        </span> </div>
                        <div class="text-right"> <span
                        class="text-primary font-semibold text-xs">
                        ${val}
                    </span> </div>
                        </div>
                        <div class="bg-[#dde0e5] h-1.5 w-full rounded-full"
                                                        x-data="{ val: ${val}, start: 1 }" x-init="setTimeout(() => start = val, 100)">
                                                        <div class="bg-gray-200 h-1.5 w-1 rounded-full transition-all"
                                                        ${styleCss}="width: ${val}%; transition: 3s;"></div>
                                                    </div>
                                </div>
                                </div>`
                    );
                });
                statisticAttr.append(
                    `<span class="text-primary" id="voteSuccess${pollIdSuccess}"><p>${result.message}</p></span>
                    <div class="flex xs:gap-5 gap-3">
                        <div class="w-1/2">
                            <a href=""
                                class="block text-primary font-semibold p-2.5 text-sm rounded-full text-center">` +
                        Lang.get("js.total_vote") +
                        `:${result.data.totalPollResults}</a>
                        </div>
                        <div class="w-1/2">
                            <a href="javascript:void(0);"
                                class="view-option-tailwind block w-full text-black font-semibold p-2.5 text-sm rounded-full border border-gray-200 text-center"
                                data-id="${result.data.pollId}">` +
                        Lang.get("js.view_option") +
                        `
                            </a>
                        </div>
                    </div>`
                );
                $("#voteSuccess" + pollIdSuccess)
                    .delay(3000)
                    .slideUp(300);
            }
        },
        error: function (result) {
            let pollId = result.responseJSON.data.poll_id;
            $("#voteError" + pollId).css("display", "block");
            $("#voteError" + pollId)
                .html(
                    `<p class="text-danger">${result.responseJSON.message}</p>`
                )
                .delay(3000)
                .slideUp(300);
            $(".poll-vote-form").trigger("reset");
        },
    });
});

listen("click", ".view-option-tailwind", function () {
    let pollId = $(this).attr("data-id");
    $("#pollStatistic" + pollId).addClass("hidden");
    $("#pollOption" + pollId).removeClass("hidden");
});

listen("click", ".view-statistic-tailwind", function () {
    let pollId = $(this).attr("data-id");
    $("#pollOption" + pollId).addClass("hidden");
    $("#pollStatistic" + pollId).removeClass("hidden");
});

listenClick(".js-cookie-consent-agree", function () {
    $(".js-cookie-consent").addClass("d-none");
    $(".js-cookie-consent").addClass("hidden");
});
listenClick(".js-cookie-consent-declined", function () {
    $(".js-cookie-consent").addClass("d-none");
    $(".js-cookie-consent").addClass("hidden");
    $.ajax({
        url: route("declineCookie"),
        type: "GET",
        success: function success(result) {},
        error: function error(result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

function loadCategorySlickSlider() {
    if (!$(".category-slider").length) {
        return false;
    }
    $(".category-slider").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 300,
        infinite: true,
        autoplaySpeed: 3000,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 5,
                    dots: true,
                },
            },
            {
                breakpoint: 1299,
                settings: {
                    slidesToShow: 4,
                    dots: true,
                },
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    dots: true,
                },
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 2,
                    dots: true,
                },
            },
            {
                breakpoint: 475,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                },
            },
        ],
    });
    $(".trending-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        speed: 300,
        infinite: true,
        autoplaySpeed: 3000,
        autoplay: true,
        prevArrow:
            '<button class="slide-arrow prev-arrow" aria-label="slide-arrow"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#838997" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg></button>',
        nextArrow:
            '<button class="slide-arrow next-arrow" aria-label="slide-arrow"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#838997" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg></button>',
    });
}
