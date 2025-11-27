"use strict";

document.addEventListener("turbo:load", loadRssFeedCreateEditData);

let rssFeedCategoryId = "";
let rssFeedSubcategoryId = "";
let rssFeedLanguageId = "";
let isEdit = false;

function loadRssFeedCreateEditData() {
    $("#rssFeedLanguageId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    $("#rssFeedCategoryId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    $("#rssFeedSubCategoryId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    if ($("#rssPostTag").length) {
        new Tagify(document.querySelector("#rssPostTag"));
    }
    const now = new Date();

    $("#scheduledRssPostDeleteTime").flatpickr({
        minDate: "today",
        minTime: now,
        dateFormat: "Y-m-d",
        locale: lang,
    });
    isEdit = $("#rssFeedIsEdit").val();
    rssFeedCategoryId = $("#EditRssFeedCategoryId").val();
    rssFeedSubcategoryId = $("#EditRssFeedSubcategoryId").val();
    rssFeedLanguageId = $("#EditRssFeedLanguageId").val();

    $("#rssFeedLanguageId").val(rssFeedLanguageId).trigger("change");
}

listen("change", "#rssFeedLanguageId", function () {
    let lang_id = $(this).val();
    $.ajax({
        url: route("posts.language"),
        type: "POST",
        data: { data: lang_id },
        success: function (response) {
            $("#rssFeedCategoryId").empty();
            $("#rssFeedCategoryId").append(
                $('<option value=""></option>').text(
                    Lang.get("js.select_category")
                )
            );
            $.each(response.data, function (i, v) {
                $("#rssFeedCategoryId").append(
                    $("<option></option>").attr("value", v).text(i)
                );
            });
            if (isEdit) {
                $("#rssFeedCategoryId")
                    .val(rssFeedCategoryId)
                    .trigger("change");
            }
        },
    });
});
listen("change", "#rssFeedCategoryId", function () {
    $.ajax({
        url: route("posts.category"),
        type: "POST",
        data: {
            cat_id: $(this).val(),
            lang_id: $("#rssFeedLanguageId").val(),
        },
        success: function (response) {
            $("#rssFeedSubCategoryId").empty();
            $("#rssFeedSubCategoryId").append(
                $('<option value=""></option>').text(
                    Lang.get("js.select_subcategory")
                )
            );
            $.each(response.data, function (i, v) {
                $("#rssFeedSubCategoryId").append(
                    $("<option></option>").attr("value", v).text(i)
                );
            });

            if (isEdit) {
                $("#rssFeedSubCategoryId")
                    .val(rssFeedSubcategoryId)
                    .trigger("change");
            }
        },
    });
});

listen("click", ".rss-feed-manually-update", function () {
    $(".rss-feed-manually-update").attr("disabled", true);
});

listen("click", ".rss-feed-manually-update", function () {
    let id = $(this).data("id");
    var loadingButton = $(this).text(Lang.get("js.processing"));
    $.ajax({
        url: route("rss-feed.manuallyUpdate", id),
        type: "POST",
        success: function (response) {
            Livewire.dispatch("refresh");
            displaySuccessMessage(response.message);
        },
    });
});
listen("click", ".rss-feed-delete-btn", function (event) {
    let recordId = $(event.currentTarget).data("id");
    deleteItem(route("rss-feed.destroy", recordId), Lang.get("js.rss-feed"));
});
