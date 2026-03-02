"use strict";

document.addEventListener("turbo:load", loadEmojiData);

function loadEmojiData() {
    $("#loadEmoji").emojioneArea({
        pickerPosition: "bottom",
    });
}

listen("click", "#addEmoji", function () {
    $("#createEmojiModal").modal("show").appendTo("body");
});

listen("hidden.bs.modal", "#createEmojiModal", function () {
    resetModalForm("#createEmojiForm");
});

listen("submit", "#createEmojiForm", function (e) {
    console.log("form submitted");
    e.preventDefault();
    $.ajax({
        url: route("emoji.store"),
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#createEmojiModal").modal("hide");
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listen("click", ".delete-emoji-btn", function (event) {
    let deleteEmojiId = $(event.currentTarget).data("id");
    deleteItem(route("emoji.destroy", deleteEmojiId), "Emoji");
});

listenChange(".emoji-active", function (e) {
    e.preventDefault();
    let id = $(this).attr("data-id");
    $.ajax({
        url: route("emoji.status", { id: id }),
        type: "get",
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            Livewire.dispatch("refresh");
        },
    });
});
