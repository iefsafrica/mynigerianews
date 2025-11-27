document.addEventListener("turbo:load", loadPageData);

function loadPageData() {
    let pageTableName = $("#pageTable");
    let isEdit = $('.isEdit').val();
    $("#pageLanguageId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    if ($(".visibility").length) {
    }

    if ($('#addContentQuillData').length) {
        window.addContentQuill = new Quill(
            '#addContentQuillData', {
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    keyboard: {
                        bindings: {
                            tab: 'disabled',
                        }
                    }
                },
                theme: 'snow',
                placeholder: Lang.get("js.enter_page_content"),
            });
            if(isEdit) {
                addContentQuill.root.innerHTML = $('#content_details').val();
            }
    }
}
listenSubmit('#createPage,#editPage', function (e) {
        let add_page_content = addContentQuill.root.innerHTML;
        let input = JSON.stringify(add_page_content);
        $('#content_details').val(input.replace(/"/g, ''));
});

listen("click", ".delete-page-btn", function (event) {
    let deletePagetId = $(event.currentTarget).data("id");
    deleteItem(route("pages.destroy", deletePagetId), Lang.get("js.page"));
});

listen("change", ".visibility", function (event) {
    let visibilityID = $(event.currentTarget).data("id");
    updateVisibility(visibilityID);
});

window.updateVisibility = function (id) {
    $.ajax({
        url: route("page.visibility"),
        method: "POST",
        data: { data: id },
        cache: false,
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
};
