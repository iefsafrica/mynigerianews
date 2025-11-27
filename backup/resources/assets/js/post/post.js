listenClick(".post-visibility-status", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changStatus'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }else{
                displayErrorMessage(result.message);
            }
        },
    });
});

listenClick(".updateHeadline", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changHeadline'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
    });
});
listenClick(".updateFeatured", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changUpdateFeatured'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
    });
});

listenClick(".update-breaking", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changUpdateBreaking'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
    });
});

listenClick(".updateSlider", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changUpdateSlider'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
    });
});


listenClick(".updateRecommended", function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('post.changUpdateRecommended'),
        type: "get",
        data: {
            id: id,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
    });
});
