document.addEventListener("turbo:load", loadStaffData);

function loadStaffData() {
    $("#staffsRole").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    let staffTableName = $("#staffTable");

}

listen("click", ".delete-staff-btn", function (event) {
    let deletePagetId = $(event.currentTarget).data("id");
    deleteItem(route("staff.destroy", deletePagetId), Lang.get("js.staff"));
});

listen("click", ".resend-email-staff-btn", function (event) {
    let staffId = $(event.currentTarget).data("id");
    $.ajax({
        url: route("resend-email", staffId),
        type: "GET",
        success: function (result) {
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
listenSubmit("#createStaffForm", function (e) {
    e.preventDefault();

    let username = $(".username").val();
    username = username.replace(/&nbsp;/gm, "");
    if (isEmpty(username.trim())) {
        displayErrorMessage(Lang.get("js.required_username"));
        return false;
    }
    $(this)[0].submit();
});
listen("change", "#staffsProfilePic", previewImagesPost);
listen("change", "#staffsCoverPic", previewImagesPost);

function previewImagesPost() {
    if (this.files) $.each(this.files, readAndPreviewPost);
}
function readAndPreviewPost(i, file) {
    var $preview = $("#preview").empty();
    if (!/\.(jpe?g|png|jpg)$/i.test(file.name)) {
        $("#additionalImage").val("");
        toastr.error(Lang.get("js.allowed_types"));
        $(".image-upload").val("");
        return false;
        // return alert(file.name + ' is not an image')

        var reader = new FileReader();

        $(reader).on("load", function () {
            $preview.append(
                $("<img/>", { src: this.result }).addClass("border-color")
            );
        });

        reader.readAsDataURL(file);
    }
}
