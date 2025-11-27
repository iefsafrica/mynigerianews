const { indexOf } = require("lodash");
const { default: Quill } = require("quill");

document.addEventListener("turbo:load", loadAddPostData);

// Livewire.hook("element.init", () => {
//     loadAddPostData();
// });

// listen('keyup', '#postTitle', function () {
//     console.log(123)
//     var Text = $.trim($(this).val())
//     Text = Text.toLowerCase()
//         Text = Text.replace(/[^a-zA-Z0-9-ğüşöçİĞÜŞÖÇ]+/g, '-')
//     $('#postSlug').val(Text)
//     $('#postHiddenSlug').val(Text)
// })
//
//
// listen('keyup', '#postSlug', function () {
//     var Text = $(this).val()
//     Text = Text.toLowerCase()
//     Text = Text.replace(/[^a-zA-Z0-9-ğüşöçİĞÜŞÖÇ]+/g, '-')
//     $(this).val(Text)
// })

let postLangId = "";
let postCategoryId = "";
let postSubCategoryId = "";

function loadAddPostData() {

    createTinymce();
    editTinymce();
    // createVideoTinymce()
    // editVideoTinymce()
    // createAudioTinymce()
    // editAudioTinymce()

    $('#draftPost').select2();
    $('#postView').select2();

    $("#postTitle").blur(function () {
        let text = $(this).val();
        $.ajax({
            url: route("post-slug"),
            type: "post",
            data: {
                text: text,
            },
            success: function (result) {
                if (result.success) {
                    $("#postSlug").val(result.data);
                    $("#postHiddenSlug").val(result.data);
                }
            },
        });
    });
    postLangId = $("#postEditLangId").val();
    postCategoryId = $("#postEditCategoryId").val();
    postSubCategoryId = $("#postEditSubCategoryId").val();
    let isEdit = $('.isEdit').val();

    if ($("#postTag").length) {
        new Tagify(document.querySelector("#postTag"));
    }

    let screen = $(window).width();
    if (screen >= 1470) {
        $(".post_ui").addClass("flex-column-fluid");
    } else {
        $(".post_ui").removeClass("flex-column-fluid");
    }

    $(window).on("resize", function () {
        if (screen >= 1470) {
            $(".post_ui").addClass("flex-column-fluid");
        } else {
            $(".post_ui").removeClass("flex-column-fluid");
        }
    });

    listen("click", "#scheduledPost", function () {
        if ($(this).prop("checked") == true) {
            $(".date-time").removeClass("d-none");
        } else if ($(this).prop("checked") == false) {
            $(".date-time").addClass("d-none");
        }
    });

    if ($("#scheduledPost").prop("checked") == true) {
        $(".date-time").removeClass("d-none");
    }

    if ($("#scheduledPostDelete").prop("checked") == true) {
        $(".delete-date-time").removeClass("d-none");
    }

    const dt = new Date();
    const now = dt.getHours() + ":" + dt.getMinutes();
    $("#scheduledPostTime").flatpickr({
        enableTime: true,
        minDate: "today",
        minTime: now,
        dateFormat: "Y-m-d H:i",
        locale: lang,
    });
    $("#scheduledPostDeleteTime").flatpickr({
        minDate: "today",
        minTime: now,
        dateFormat: "Y-m-d",
        locale: lang,
    });
    listen("click", "#scheduledPostDelete", function () {
        if ($(this).prop("checked") == true) {
            $(".delete-date-time").removeClass("d-none");
        } else if ($(this).prop("checked") == false) {
            $(".delete-date-time").addClass("d-none");
        }
    });
    listen("hidden.bs.modal", "#postFileModal", function () {
        $("#newPostImage").val("");
        $(".uploaded-post-img").empty();
        $(".modal-footer").addClass("d-none");
    });
    listen("click", ".btn-check", function () {
        $(".modal-footer").removeClass("d-none");
    });

    updateList = function () {
        var input = document.getElementById("file");
        var output = document.getElementById("fileList");
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += "<li>" + input.files.item(i).name + "</li>";
        }
        output.innerHTML = "<ul>" + children + "</ul>";
    };

    updateAudioList = function () {
        var input = document.getElementById("audios");
        var output = document.getElementById("audioFileList");
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += "<li>" + input.files.item(i).name + "</li>";
        }
        output.innerHTML = "<ul>" + children + "</ul>";
    };

    function previewImagesPost() {
        if (this.files) $.each(this.files, readAndPreviewPost);
    }

    // $('#postLanguageId').val('').trigger('change')
    // if (!isEmpty(postLangId)){
    //     setTimeout(function (){
    //         $('#postLanguageId').val(postLangId).trigger('change')
    //     },500)
    // }

    $("#postCategoriesId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        placeholder: Lang.get("js.select_category"),
    });
    $("#postLanguageId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        placeholder: Lang.get("js.select_language"),
    });

    $("#postSubCategoryId").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        placeholder: Lang.get("js.select_subcategory"),
    });

    $("#postTypeFilter").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });

    $("#categoryFilter").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });

    $("#subCategoryFilter").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });

    $("#languageFilter").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    $("#postCreatedBy").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });
    $("#openAi").select2({
        language: {
            noResults: function (params) {
                return Lang.get("js.no_results_found");
            },
        },
        width: "100%",
    });

    //artical content

    if ($('#addArticleContentQuillData').length) {
        window.addArticleContentQuill = new Quill(
            '#addArticleContentQuillData', {
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
            placeholder: Lang.get("js.enter_article_content"),
        });
    }

    // Initialize Tagify on a different element, assuming '#tagsInput' is used for Tagify
    if ($('#tagsInput').length) {
        var tagify = new Tagify($('#tagsInput')[0]);
    }

    if(isEdit){
        if ($('#editArticleContentQuillData').length) {
            var quill = new Quill('#editArticleContentQuillData', {
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
                placeholder: Lang.get("js.enter_article_content"),
            });

            // Set initial content from hidden input
            var initialContent = $('#editArticleContentData');
            if (initialContent.length) {
                quill.root.innerHTML = initialContent.val();
            } else {
                console.log('Initial content is empty, using placeholder.');
            }

            // Update hidden input when Quill content changes
            quill.on('text-change', function () {
                $('#editArticleContentData').val(quill.root.innerHTML);
            });
        }
    }

    //video content
    if ($('#addVideoContentQuillData').length) {
        window.addVideoContentQuill = new Quill(
            '#addVideoContentQuillData', {
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
            placeholder: Lang.get("js.enter_video_content"),
        });
    }

    if(isEdit){
        if ($('#editVideoContentQuillData').length) {
            var quill = new Quill('#editVideoContentQuillData', {
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
                placeholder: Lang.get("js.enter_video_content"),
            });

            // Set initial content from hidden input
            var initialContent = $('#editVideoContentData');
            if (initialContent.length) {
                quill.root.innerHTML = initialContent.val();
            } else {
                console.log('Initial content is empty, using placeholder.');
            }

            // Update hidden input when Quill content changes
            quill.on('text-change', function () {
                $('#editVideoContentData').val(quill.root.innerHTML);
            });
        }
    }

//audio content
    if ($('#addAudioContentQuillData').length) {
        window.addAudioContentQuill = new Quill(
            '#addAudioContentQuillData', {
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
            placeholder: Lang.get("js.enter_audio_content"),
        });
    }

    if(isEdit){
        if ($('#editAudioContentQuillData').length) {
            var quill = new Quill('#editAudioContentQuillData', {
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
                placeholder: Lang.get("js.enter_audio_content"),
            });

            // Set initial content from hidden input
            var initialContent = $('#editAudioContentData');
            if (initialContent.length) {
                quill.root.innerHTML = initialContent.val();
            } else {
                console.log('Initial content is empty, using placeholder.');
            }

            // Update hidden input when Quill content changes
            quill.on('text-change', function () {
                $('#editAudioContentData').val(quill.root.innerHTML);
            });
        }
    }

    //ai content

    if ($('#addAiContentQuillData').length) {
        window.addAiContentQuill = new Quill(
            '#addAiContentQuillData', {
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
            placeholder: Lang.get("js.enter_ai_content"),
        });
    }

    if(isEdit){
        if ($('#editAiContentQuillData').length) {
            var quill = new Quill('#editAiContentQuillData', {
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
                placeholder: Lang.get("js.enter_ai_content"),
            });

            // Set initial content from hidden input
            var initialContent = $('#editAiContentData');
            if (initialContent.length) {
                quill.root.innerHTML = initialContent.val();
            } else {
                console.log('Initial content is empty, using placeholder.');
            }

            // Update hidden input when Quill content changes
            quill.on('text-change', function () {
                $('#editAiContentData').val(quill.root.innerHTML);
            });
        }
    }

    //gallery content
    if (isEdit) {
        document.querySelectorAll('.add-gallery-content').forEach((editor) => {
            initializeQuillEditor(`#${editor.id}`);
        });
    }

    if (!isEdit) {
        if ($('#addGalleryContentData-1').length) {
            window.editor = new Quill(
                '#addGalleryContentData-1', {
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
                placeholder: Lang.get("js.enter_gallery_content"),
            });
            if(isEdit){
                editor.root.innerHTML = $(
                    '#galleryContent-1').val();
            }
        }
    }

    //sort list content
    if (isEdit) {
        document.querySelectorAll('.add-sort-list-content').forEach((addSortListContentDataQuill) => {
            sortListInitializeQuillEditor(`#${addSortListContentDataQuill.id}`);
        });
    }

    if (!isEdit) {
        if ($('#addSortListContentData-1').length) {
            window.addSortListContentDataQuill = new Quill(
                '#addSortListContentData-1', {
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
                placeholder: Lang.get("js.enter_sort_list_content"),
            });
            if(isEdit){
                addSortListContentDataQuill.root.innerHTML = $(
                    '#sortListContent-1').val();
            }
        }
    }


}

//gallery content
const quillInstances = new Map();

function initializeQuillEditor(selector) {
    const element = document.querySelector(selector);
    if (!element) {
        console.error(`Element with selector ${selector} not found.`);
        return;
    }

    const quill = new Quill(element, {
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
        placeholder: Lang.get("js.enter_gallery_content"),
    });
    const textareaId = selector.replace('addGalleryContentData-', 'galleryContent-');
    const textarea = document.getElementById(textareaId.replace('#', ''));
    if (textarea && textarea.value) {
        quill.root.innerHTML = textarea.value;
    }

    if (textarea) {
        textarea.value = quill.root.innerHTML;
    }

    quillInstances.set(selector, quill);


}



listen("click", "#postAddItem", function () {
    $(".delete-gallery-item").removeClass("d-none");
    let data = {
        i: $(".accordion").length + 1,
        styleCss: "style",
    };
    let galleryItemHtml = prepareTemplateRender("#galleryItemTemplate", data);

    $(".gallery-item-container").append(galleryItemHtml);
    initializeQuillEditor(`#addGalleryContentData-${data.i}`); // Initialize new editor
    tooltipLoad();
    IOInitImageComponent();
});

// Initialize Quill Editors on page load for existing editors
document.querySelectorAll('.add-gallery-content').forEach((editor) => {
    initializeQuillEditor(`#${editor.id}`);
});



//sort list content

const sortListContent = new Map();

function sortListInitializeQuillEditor(selector) {
    const element = document.querySelector(selector);
    if (!element) {
        console.error(`Element with selector ${selector} not found.`);
        return;
    }

    const quill = new Quill(element, {
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
        placeholder: Lang.get("js.enter_sort_list_content"),
    });

    // if (isEdit) {
        const textareaId = selector.replace('addSortListContentData-', 'sortListContent-');
        const textarea = document.getElementById(textareaId.replace('#', ''));
        if (textarea && textarea.value) {
            quill.root.innerHTML = textarea.value;
        }

        if (textarea) {
            textarea.value = quill.root.innerHTML;
        }
    // }

    sortListContent.set(selector, quill);


}

listen("click", "#addSortListItem", function () {
    $(".delete-sort_list-item").removeClass("d-none");
    let data = {
        i: $(".accordion").length + 1,
        styleCss: "style",
    };
    let sortListItemHtml = prepareTemplateRender("#sortListItemTemplate", data);
    $(".sort_list-item-container").append(sortListItemHtml);
    sortListInitializeQuillEditor(`#addSortListContentData-${data.i}`); // Initialize new editor
    tooltipLoad();
});

// Initialize Quill Editors on page load for existing editors
document.querySelectorAll('.add-sort-list-content').forEach((editor) => {
    sortListInitializeQuillEditor(`#${editor.id}`);
});



// listen('click', '.select-post-image', function () {
//     let text = $('.tox-target')
//     console.log(text[0].name)
//     let imgUrl = $('input[name="preview_img"]:checked').val()
//     console.log(imgUrl)
//     $('#postFileModal').modal('hide')
//     let oldContent = CKEDITOR.getContent()
//
//     // console.log(oldContent)
//     // CKEDITOR.instances['video_content'].setData('<img class="images" src=' + imgUrl +
//     //     ' data-mce-src=' + imgUrl + '>')
//     // tinymce.activeEditor.setContent(
//     //     oldContent + '<img class="images" src=' + imgUrl +
//     //     ' data-mce-src=' + imgUrl + '>')
// })

listen("change", "#additionalImage", previewImagesPost);

function previewImagesPost() {
    if (this.files) $.each(this.files, readAndPreviewPost);
}

// window.addEventListener('error', function (data) {
//     displayErrorMessage(data.detail)
// })
window.addEventListener("bulkDelete", function (data) {
    swal({
        title: Lang.get("js.delete"),
        text:
            Lang.get("js.delete_warning") +
            ' "' +
            Lang.get("js.post") +
            '"' +
            " ?",
        buttons: {
            confirm: Lang.get("js.delete"),
            cancel: Lang.get("js.cancel_delete"),
        },
        reverseButtons: true,
        icon: "warning",
    }).then(function (willDelete) {
        if (willDelete) {
            Livewire.dispatch("bulkPostDelete", data.detail);
        }
    });
});

function readAndPreviewPost(i, file) {
    var $preview = $("#preview").empty();
    if (!/\.(jpe?g|png|gif|webp|svg)$/i.test(file.name)) {
        $("#additionalImage").val("");
        toastr.error(Lang.get("js.allowed_types"));
        return false;
        // return alert(file.name + ' is not an image')
    }

    var reader = new FileReader();

    $(reader).on("load", function () {
        $preview.append(
            $("<img/>", { src: this.result }).addClass("border-color")
        );
    });

    reader.readAsDataURL(file);
}

const addTinyMCE = (id) => {
    // Initialize

};
const addTinyMCESortList = (id) => {
    // Initialize

};

listen("click", ".btn-add-image", function () {
    let role = $(this).attr("data-role");

    imagePostData(role);
});

function imagePostData(role) {
    let url;
    if (role == "Customer") {
        url = route("customer-post-upload-image-get");
    } else {
        url = route("post-upload-image-get");
    }
    console.log(url);
    $.ajax({
        url: url,
        type: "GET",
        success: function (result) {
            if (result.success) {
                $("#postFileModal").modal("show");
                $.each(result.data, function (key, value) {
                    let imagePostData = {
                        imageId: value.id,
                        imgUrl: value.imageUrls,
                        imgName: value.imageUrls.substring(
                            value.imageUrls.lastIndexOf("/") + 1
                        ),
                    };
                    let dataTemplate = prepareTemplateRender(
                        "#postTemplate",
                        imagePostData
                    );
                    $(".uploaded-post-img").append(dataTemplate);
                });
            }
        },
    });
}

listen("change", "#postTypeFilter", function () {
    Livewire.dispatch("filterPostType", { id: $(this).val() });
});

listen("change", "#categoryFilter", function () {
    Livewire.dispatch("filterCategory", { id: $(this).val() });
    //     Livewire.dispatch("filterSubCategory", null);
});

listen("change", "#subCategoryFilter", function () {
    Livewire.dispatch("filterSubCategory", { id: $(this).val() });
});

listen("change", "#languageFilter", function () {
    Livewire.dispatch("filterLangId", { id: $(this).val() });
});

let dropdownBtnEle = "";
let dropdownEle = "";
let dropdownOpen = false;
$(document).on("click", ".post-option", function (event) {
    dropdownBtnEle = $(this);
    dropdownEle = $(this).next();
    openDropdownManually(dropdownBtnEle, dropdownEle);
});

window.openDropdownManually = function (dropdownBtnEle, dropdownEle) {
    if (!dropdownBtnEle.hasClass("show")) {
        $(".post-option").removeClass("show");
        $(".menu-sub-dropdown").removeClass("show");
        dropdownBtnEle.addClass("show");
        dropdownEle.addClass("show");
        dropdownOpen = true;
    } else {
        hideDropdownManually(dropdownBtnEle, dropdownEle);
    }
};

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
    dropdownBtnEle.removeClass("show");
    dropdownEle.removeClass("show");
    dropdownOpen = false;
};

listen("click", ".post-item", function () {
    hideDropdownManually(dropdownBtnEle, dropdownEle);
});

listen("click", function (event) {
    let target = $(event.target);
    if (dropdownOpen && !target.closest(".post-option").length) {
        hideDropdownManually(dropdownBtnEle, dropdownEle);
    }
});

function validatePostForm() {
    let slug = $("#postSlug").val();
    let description = $("#description").val();
    let keywords = $("#keywords").val();
    let tags = $("#postTag").val();
    let postLanguageId = $("#postLanguageId").val();
    let postCategoriesId = $("#postCategoriesId").val();
    let scheduledPost = $("#scheduledPost").prop("checked");
    let datePicker = $("#scheduledPostTime").val();
    let galleryTitle = $(".gallery-title").val();
    let sortListTitle = $(".sort-list-title").val();
    let sectionType = $("#postSectionType").val();

    if (isEmpty($.trim(slug))) {
        toastr.error(Lang.get("js.required", { attribute: "slug" }));
        return false;
    } else if (slug.length > 180) {
        toastr.error(Lang.get("js.max", { attribute: "slug", max: 180 }));
        return false;
    }
    if (isEmpty($.trim(description))) {
        toastr.error(Lang.get("js.required", { attribute: "description" }));
        return false;
    }

    if (isEmpty($.trim(keywords))) {
        toastr.error(Lang.get("js.required", { attribute: "keywords" }));
        return false;
    } else if (keywords.length > 180) {
        toastr.error(Lang.get("js.max", { attribute: "keywords", max: 180 }));
        return false;
    }

    if (isEmpty($.trim(tags))) {
        toastr.error(Lang.get("js.required", { attribute: "tags" }));
        return false;
    } else if (tags.length > 180) {
        toastr.error(Lang.get("js.max", { attribute: "tags", max: 180 }));
        return false;
    }

    if (isEmpty($.trim(postLanguageId))) {
        toastr.error(Lang.get("js.required", { attribute: "language" }));
        return false;
    }

    if (isEmpty($.trim(postCategoriesId))) {
        toastr.error(Lang.get("js.required", { attribute: "category" }));
        return false;
    }

    if (scheduledPost && isEmpty(datePicker)) {
        toastr.error(Lang.get("js.required", { attribute: "date & time" }));
        return false;
    }

    if (sectionType == 2) {
        if (isEmpty($.trim(galleryTitle))) {
            toastr.error(
                Lang.get("js.required", {
                    attribute: "gallery list item title",
                })
            );
            return false;
        } else if (galleryTitle.length > 180) {
            toastr.error(
                Lang.get("js.max", {
                    attribute: "gallery list item title",
                    max: 180,
                })
            );
            return false;
        }
    }

    if (sectionType == 3) {
        if (isEmpty($.trim(sortListTitle))) {
            toastr.error(
                Lang.get("js.required", {
                    attribute: "sort list item title",
                })
            );
            return false;
        } else if (sortListTitle.length > 180) {
            toastr.error(
                Lang.get("js.max", {
                    attribute: "sort list item title",
                    max: 180,
                })
            );
            return false;
        }
    }

    function serializeQuillContent(e) {
        if (sectionType == 2) {

            quillInstances.forEach((quill, selector) => {
                const editor = document.querySelector(selector);
                const textareaId = `galleryContent-${editor.id.split('-')[1]}`;
                const textarea = document.querySelector(`textarea[id="${textareaId}"]`);

                if (textarea) {
                    textarea.value = quill.root.innerHTML;
                } else {
                    console.error(`Textarea with ID: ${textareaId} not found.`);
                }
            });
        }

        if (sectionType == 3) {

            sortListContent.forEach((quill, selector) => {
                const sorteditor = document.querySelector(selector);
                const sorttextareaId = `sortListContent-${sorteditor.id.split('-')[1]}`;
                const textarea = document.querySelector(`textarea[id="${sorttextareaId}"]`);

                if (textarea) {
                    textarea.value = quill.root.innerHTML;
                } else {
                    console.error(`Textarea with ID: ${sorttextareaId} not found.`);
                }
            });
        }
    }



    if ($("#createPostForm,#updatePostForm").length == 1) {
        serializeQuillContent();

        let hasError = false;

        if (sectionType == 2) {
            let admin_editor = editor.root.innerHTML;
            if (editor.getText().trim().length === 0) {
                displayErrorMessage('Please enter some text before saving.');
                if (e) e.preventDefault();
                $('#btnSave').attr('disabled', false);
                hasError = true;
            }
            let inputDetail = JSON.stringify(admin_editor);
            $('#galleryContent-1').val(inputDetail.replace(/"/g, ''));
        }

        if (sectionType == 3) {
            let sort_list_content = addSortListContentDataQuill.root.innerHTML;
            if (addSortListContentDataQuill.getText().trim().length === 0) {
                displayErrorMessage('Please enter some text before saving.');
                if (e) e.preventDefault();
                $('#btnSave').attr('disabled', false);
                hasError = true;
            }
            let inputDetail = JSON.stringify(sort_list_content);
            $('#sortListContent-1').val(inputDetail.replace(/"/g, ''));
        }

        if (hasError) {
            return false;
        }



        if(sectionType == 1){
            let artical_content = addArticleContentQuill.root.innerHTML;
            let input = JSON.stringify(artical_content);
            $('#articleContentData').val(input.replace(/"/g, ''));
        }

        if(sectionType == 8){
            let ai_content = addAiContentQuill.root.innerHTML;
            let input = JSON.stringify(ai_content);
            $('#aiContentData').val(input.replace(/"/g, ''));
        }

        if(sectionType == 6){
            let video_content = addVideoContentQuill.root.innerHTML;
            let input = JSON.stringify(video_content);
            $('#videoContentData').val(input.replace(/"/g, ''));
        }

        if(sectionType == 7){
            let audio_content = addAudioContentQuill.root.innerHTML;
            let input = JSON.stringify(audio_content);
            $('#audioContentData').val(input.replace(/"/g, ''));
        }

        if (sectionType == 6) {
            if (
                isEmpty($("#videoUrl").val()) &&
                isEmpty($("#uploadVideo").val())
            ) {
                toastr.error("Please enter video url or upload video");
                return false;
            }

            if ($("#videoUrl").val() && $("#uploadVideo").val()) {
                toastr.error(
                    "You can use any one of upload video or video URL option"
                );
                return false;
            }
        }
    }
    return true;
}

listen("keyup", ".sort-list-title-text", function () {
    let dataId = $(this).attr("data-id");
    $(".accordion-button-" + dataId).text(
        $(".sort-list-title-" + dataId).val()
    );
});

listen("keyup", ".gallery-list-title-text", function () {
    let dataId = $(this).attr("data-id");
    $(".accordion-button-" + dataId).text(
        $(".gallery-list-title-" + dataId).val()
    );
});

listen("click", "#postSaveBtn", function () {
    let id = $("#hiddenId").val();
    let image = $("#image").val();
    let thumbnailUrl = $(".thumbnail-image-url").val();
    let thumbnailImage = $("#thumbnailImage").val();

    if (isEmpty(thumbnailImage)) {
        if (thumbnailUrl == "") {
            if (isEmpty(id) && isEmpty(image)) {
                toastr.error(
                    Lang.get("js.required", {
                        attribute: "Thumbnail",
                    })
                );
                return false;
            }
        }
    }

    if (validatePostForm()) {
        $(".postSaveBtn").submit();
        return true;
    } else {
        return false;
    }
});
listen("change", "#categoryFilter", function () {
    $.ajax({
        url: route("posts.categoryFilter"),
        type: "POST",
        data: {
            cat_id: $(this).val(),
        },
        success: function (response) {
            $("#subCategoryFilter").empty();
            $("#subCategoryFilter").append(
                $('<option value=""></option>').text(
                    Lang.get("js.select_subcategory")
                )
            );
            $.each(response.data, function (i, v) {
                $("#subCategoryFilter").append(
                    $("<option></option>").attr("value", v).text(i)
                );
            });

            if (postSubCategoryId) {
                $("#subCategoryFilter")
                    .val(postSubCategoryId)
                    .trigger("change");
            }
        },
    });
});

function createTinymce() {
    if ($("#articleContent").length == 1) {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });
    }
    if ($("#videoContent").length == 1) {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });

    }
    if ($("#audioContent").length == 1) {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });

    }
    if ($("#AiArticleContent").length == 1) {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });
        listenClick("#OpenAiCall", function () {
            let role = $(this).attr("data-role");
            $("#OpenAiCall").prop("disabled", true);
            let postTitle = $("#postTitle").val();
            let openAiModel = $("#openAi").val();
            let Temperature = $("#Temperature").val();
            let MaximumLength = $("#MaximumLength").val();
            let InputTopPId = $("#InputTopPId").val();
            let InputBestOfId = $("#InputBestOfId").val();
            let url;
            if (role == "Customer") {
                url = route("customer-open_ai");
            } else {
                url = route("open_ai");
            }
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    postTitle: postTitle,
                    openAiModel: openAiModel,
                    Temperature: Temperature,
                    MaximumLength: MaximumLength,
                    InputTopPId: InputTopPId,
                    InputBestOfId: InputBestOfId,
                },
                success: function (result) {
                    if (result.success) {
                        console.log(result.data);
                        displaySuccessMessage(result.message);
                        let oldContent = editor.getData();
                        editor.setData(
                            oldContent + result.data.replace(/\n/g, "<br>")
                        );
                        $("#OpenAiCall").prop("disabled", false);
                        // $('html, body').
                        //     animate({
                        //         scrollTop: $('.btn-add-image').
                        //             offset().top - 100,
                        //     })
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                    $("#OpenAiCall").prop("disabled", false);
                },
            });
        });
    }

    // if($('#galleryContent').length == 0){
    $(".text-gallery-description").each(function () {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });
    });
    $(".text-sort_list-description").each(function () {
        let editor;
        listen("click", ".select-post-image", function () {
            let imgUrl = $('input[name="preview_img"]:checked').val();
            $("#postFileModal").modal("hide");
            let oldContent = editor.getData();
            console.log(oldContent);
            editor.setData(
                oldContent +
                '<img class="images" src=' +
                imgUrl +
                " data-mce-src=" +
                imgUrl +
                ">"
            );
        });
    });

    // }

    // tinymce.init({
    //     mode: 'specific_textareas',
    //     editor_selector: 'article-text-description',  // change this value according to your HTML
    //     plugin: 'a_tinymce_plugin',
    //     a_plugin_option: true,
    //     a_configuration_option: 400,
    //     relative_urls: false,
    //     remove_script_host: false,
    //     convert_urls: true,
    //     document_base_url: '{{ config(\'app.url\') }}',
    //     content_style: tinymce_textarea_coler,
    // })
    // tinymce.init({
    //     selector: '.text-gallery-description,.text-sort_list-description',
    //     themes: 'modern',
    //     height: 200,
    //     content_style: tinymce_textarea_coler,
    // })
}

function editTinymce() {
    // CKEDITOR.replace( 'article_content' );
    // CKEDITOR.replace( 'video_content' );
    // CKEDITOR.replace( 'audio_content' );
    // tinymce.init({
    //     mode: 'specific_textareas',
    //     editor_selector: 'article-text-description',  // change this value according to your HTML
    //     plugin: 'a_tinymce_plugin',
    //     a_plugin_option: true,
    //     a_configuration_option: 400,
    //     relative_urls: false,
    //     remove_script_host: false,
    //     convert_urls: true,
    //     document_base_url: '{{ config(\'app.url\') }}',
    //     content_style: tinymce_textarea_coler,
    // })
    // tinymce.init({
    //     selector: '.text-gallery-description,.text-sort_list-description',
    //     themes: 'modern',
    //     height: 200,
    //     content_style: tinymce_textarea_coler,
    // })
}

// function createVideoTinymce () {
//     tinymce.init({
//         mode: 'specific_textareas',
//         editor_selector: 'video-text-description',  // change this value according to your HTML
//         plugin: 'a_tinymce_plugin',
//         a_plugin_option: true,
//         a_configuration_option: 400,
//         relative_urls: false,
//         remove_script_host: false,
//         convert_urls: true,
//         document_base_url: '{{ config(\'app.url\') }}',
//         content_style: tinymce_textarea_coler,
//     })
//     tinymce.init({
//         selector: '.text-gallery-description,.text-sort_list-description',
//         themes: 'modern',
//         height: 200,
//         content_style: tinymce_textarea_coler,
//     })
// }
//
// function editVideoTinymce () {
//     tinymce.init({
//         mode: 'specific_textareas',
//         editor_selector: 'video-text-description',  // change this value according to your HTML
//         plugin: 'a_tinymce_plugin',
//         a_plugin_option: true,
//         a_configuration_option: 400,
//         relative_urls: false,
//         remove_script_host: false,
//         convert_urls: true,
//         document_base_url: '{{ config(\'app.url\') }}',
//         content_style: tinymce_textarea_coler,
//     })
//     tinymce.init({
//         selector: '.text-gallery-description,.text-sort_list-description',
//         themes: 'modern',
//         height: 200,
//         content_style: tinymce_textarea_coler,
//     })
// }
//
// function createAudioTinymce () {
//     tinymce.init({
//         mode: 'specific_textareas',
//         editor_selector: 'audio-text-description',  // change this value according to your HTML
//         plugin: 'a_tinymce_plugin',
//         a_plugin_option: true,
//         a_configuration_option: 400,
//         relative_urls: false,
//         remove_script_host: false,
//         convert_urls: true,
//         document_base_url: '{{ config(\'app.url\') }}',
//         content_style: tinymce_textarea_coler,
//     })
//     tinymce.init({
//         selector: '.text-gallery-description,.text-sort_list-description',
//         themes: 'modern',
//         height: 200,
//         content_style: tinymce_textarea_coler,
//     })
// }
//
// function editAudioTinymce () {
//     tinymce.init({
//         mode: 'specific_textareas',
//         editor_selector: 'audio-text-description',  // change this value according to your HTML
//         plugin: 'a_tinymce_plugin',
//         a_plugin_option: true,
//         a_configuration_option: 400,
//         relative_urls: false,
//         remove_script_host: false,
//         convert_urls: true,
//         document_base_url: '{{ config(\'app.url\') }}',
//         content_style: tinymce_textarea_coler,
//     })
//     tinymce.init({
//         selector: '.text-gallery-description,.text-sort_list-description',
//         themes: 'modern',
//         height: 200,
//         content_style: tinymce_textarea_coler,
//     })
// }

listen("click", ".image-delete-btn", function (event) {
    let role = $("#loginUserRole").val();
    let deleteImageId = $('input[name="preview_img"]:checked').attr("data-id");
    let url;
    if (role) {
        url = route("customer-post-image.destroy", deleteImageId);
    } else {
        url = route("post-image.destroy", deleteImageId);
    }
    $.ajax({
        url: url,
        type: "get",
        success: function (result) {
            let id = result.data.id;
            if (result) {
                $("#image-" + id).hide();
                $(".modal-footer").addClass("d-none");
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listen("change", "#newPostImage", function (e) {
    e.preventDefault();
    if (this.files && this.files[0]) {
        let image = this.files[0];
        let ext = image.name.split(".").pop();
        let extensions = ["png", "jpg", "jpeg", "webp", "svg"];
        if (!extensions.includes(ext)) {
            displayErrorMessage(Lang.get("js.image_error"));
            return false;
        }

        let formData = new FormData();
        formData.append("image", image);
        let role = $("#loginUserRole").val();

        let url;
        if (role) {
            url = route("customer-editor.post-image-upload");
        } else {
            url = route("editor.post-image-upload");
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                displaySuccessMessage(data.message);

                let dataTemplate = prepareTemplateRender("#postTemplate", {
                    imgUrl: data.data.data.url,
                    imgName: data.data.data.url.substring(
                        data.data.data.url.lastIndexOf("/") + 1
                    ),
                    imageId: data.data.data.mediaId,
                });
                $("#newPostImage").val("");
                $(".uploaded-post-img").append(dataTemplate);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    }
});

listen("change", "#postLanguageId", function () {
    let lang_id = $(this).val();
    $.ajax({
        url: route("posts.language"),
        type: "POST",
        data: { data: lang_id },
        success: function (response) {
            $("#postCategoriesId").empty();
            $("#postCategoriesId").append(
                $('<option value=""></option>').text(
                    Lang.get("js.select_category")
                )
            );
            $.each(response.data, function (i, v) {
                $("#postCategoriesId").append(
                    $("<option></option>").attr("value", v).text(i)
                );
            });

            if (postCategoryId) {
                $("#postCategoriesId").val(postCategoryId).trigger("change");
            }
        },
    });
});

listen("change", "#postCategoriesId", function () {
    $.ajax({
        url: route("posts.category"),
        type: "POST",
        data: {
            cat_id: $(this).val(),
            lang_id: $("#postLanguageId").val(),
        },
        success: function (response) {
            $("#postSubCategoryId").empty();
            $("#postSubCategoryId").append(
                $('<option value=""></option>').text(
                    Lang.get("js.select_subcategory")
                )
            );
            $.each(response.data, function (i, v) {
                $("#postSubCategoryId").append(
                    $("<option></option>").attr("value", v).text(i)
                );
            });

            if (postSubCategoryId) {
                $("#postSubCategoryId")
                    .val(postSubCategoryId)
                    .trigger("change");
            }
        },
    });
});

listen("click", ".delete-posts-btn", function (event) {
    let role = $("#loginUserRole").val();
    let deletePostId = $(event.currentTarget).data("id");
    let url;
    if (role) {
        url = route("customer-posts.destroy", deletePostId);
    } else {
        url = route("posts.destroy", deletePostId);
    }

    deleteItem(url, Lang.get("js.post"));
});

// listen("click", "#postAddItem", function () {
//     $(".delete-gallery-item").removeClass("d-none");
//     let data = {
//         i: $(".accordion").length + 1,
//         styleCss: "style",
//     };
//     let galleryItemHtml = prepareTemplateRender("#galleryItemTemplate", data);

//     $(".gallery-item-container").append(galleryItemHtml);
//     addTinyMCE(data.i);
//     tooltipLoad();
//     IOInitImageComponent();
// });

// listen("click", "#addSortListItem", function () {
//     $(".delete-sort_list-item").removeClass("d-none");
//     let data = {
//         i: $(".accordion").length + 1,
//     };
//     let invoiceItemHtml = prepareTemplateRender("#sortListItemTemplate", data);

//     $(".sort_list-item-container").append(invoiceItemHtml);

//     addTinyMCESortList(data.i);
//     tooltipLoad();
//     IOInitImageComponent();
// });

listen("click", ".delete-gallery-item", function () {
    $(this).parent().parent().parent().remove();
    let countGallery = $(".accordion").length - 1;
    $("#postGalleryTitle").addClass("gallery-title");
    if (countGallery == 0) {
        $(".delete-gallery-item").addClass("d-none");
        $("#postGalleryTitle").addClass("gallery-title");
    }
});

listen("click", ".delete-sort_list-item", function () {
    $(this).parent().parent().parent().remove();
    let countSort = $(".accordion").length - 1;
    $("#sortListTitle").addClass("sort-list-title");
    if (countSort == 0) {
        $(".delete-sort_list-item").addClass("d-none");
        $("#sortListTitle").addClass("sort-list-title");
    }
});

listen("change", ".image-upload", function () {
    if ($("#postTitle").length && this.files && this.files[0]) {
        let image = this.files[0];
        let ext = image.name.split(".").pop();
        let extensions = ["png", "jpg", "jpeg", "webp", "svg"];
        if (!extensions.includes(ext)) {
            displayErrorMessage(Lang.get("js.image_error"));
            $(this).val("");
            return false;
        }
    }
});

listen("keyup", ".thumbnail-image-url", function () {
    let thumbnailUrl = $(".thumbnail-image-url").val();
    $("#thumbnailInputImage").css(
        "background-image",
        "url(" + thumbnailUrl + ")"
    );
    $("#thumbnailImage").val("");
});

listen("blur", ".thumbnail-image-url", function () {
    let thumbnailUrl = $(".thumbnail-image-url").val();
    if (thumbnailUrl != "") {
        function isImage(url) {
            return /^https?:\/\/.+\.(jpg|jpeg|png|webp|svg)$/.test(url);
        }
        if (!isImage("" + thumbnailUrl + "")) {
            $("#thumbnailImage").val("");
            $(".thumbnail-image-url").val("");
            $("#thumbnailInputImage").css(
                "background-image",
                "url(" + defaultImage + ")"
            );
            displayErrorMessage(Lang.get("js.thumbnail_image"));
            return false;
        }
    }
});

listen("blur", "#videoUrl", function () {
    let videUrl = $("#videoUrl").val();
    if (videUrl === "") {
        $("#embedVideoUrl").val("");
        $(".video_i_frame").empty();
        $("#thumbnailImageUrl").val("");
        $("#thumbnailInputImage").css(
            "background-image",
            "url(" + defaultImage + ")"
        );
    }
});

listen("click", ".get-video-by-url", function (event) {
    let videoUrl = $("#videoUrl").val();
    let role = $("#loginUserRole").val();
    let url;
    if (role == "Customer") {
        url = route("customer.get-video-by-url");
    } else {
        url = route("get-video-by-url");
    }
    $.ajax({
        url: url,
        data: { videoUrl: videoUrl },
        type: "post",
        success: function (result) {
            if (result.success) {
                $(".video_i_frame").empty();
                $(".video_i_frame").append(result.data.html);
                $(".video_i_frame").css("text-align", "center");
                $("#embedVideoUrl").val(result.data.embed_url);
                $("#thumbnailImageUrl").val(result.data.thumbnail_url);
                $("#thumbnailInputImage").css(
                    "background-image",
                    "url(" + result.data.thumbnail_url + ")"
                );
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listen("change", "#uploadVideo", function () {
    if (this.files && this.files[0]) {
        let image = this.files[0];
        let ext = image.name.split(".").pop();
        let extensions = ["mp4", "mov", "mkv", "webm", "avi"];
        if (!extensions.includes(ext)) {
            displayErrorMessage(Lang.get("js.video_error"));
            $(".video-tag").addClass("d-none");
            $(this).val("");
            return false;
        }
        $(".video-tag").removeClass("d-none");
        var $source = $("#video_here");
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    }
});
// listenClick('#OpenAiCall', function () {
//     let role = $(this).attr('data-role')
//     $('#OpenAiCall').prop('disabled', true)
//     let postTitle = $('#postTitle').val()
//     let openAiModel = $('#openAi').val()
//     let Temperature = $('#Temperature').val()
//     let MaximumLength = $('#MaximumLength').val()
//     let InputTopPId = $('#InputTopPId').val()
//     let InputBestOfId = $('#InputBestOfId').val()
//     let url
//     if (role == 'Customer') {
//         url = route('customer-open_ai')
//     } else {
//         url = route('open_ai')
//     }
//     $.ajax({
//         url: url,
//         type: 'POST',
//         data:
//             {
//                 postTitle: postTitle,
//                 openAiModel: openAiModel,
//                 Temperature: Temperature,
//                 MaximumLength: MaximumLength,
//                 InputTopPId: InputTopPId,
//                 InputBestOfId: InputBestOfId,
//             },
//         success: function (result) {
//             if (result.success) {
//                 console.log(result.data)
//                 displaySuccessMessage(result.message)
//                 tinyMCE.activeEditor.setContent(
//                     result.data.replace(/\n/g, '<br>'))
//                 $('#OpenAiCall').prop('disabled', false)
//                 $('html, body').
//                     animate({
//                         scrollTop: $('.btn-add-image').
//                             offset().top - 100,
//                     })
//             }
//
//         },
//         error: function (result) {
//             displayErrorMessage(result.responseJSON.message)
//             $('#OpenAiCall').prop('disabled', false)
//         },
//     })
// })

listenKeyup("#TemperatureOutput", function () {
    let value = $(this).val();
    if (value == "") {
        $(this).val(0);
        value = 0;
    }
    if (value >= 1) {
        $(this).val(1);
    }
    $("#Temperature").val(value);
});
listenKeyup("#MaximumLengthOutput", function () {
    let value = $(this).val();
    console.log(value);
    if (value == "") {
        $(this).val(0);
        value = 0;
    }
    if (value >= 4000) {
        $(this).val(4000);
    }
    $("#MaximumLength").val(value);
});
listenKeyup("#topP", function () {
    let value = $(this).val();
    if (value == "") {
        $(this).val(0);
        value = 0;
    }
    if (value >= 1) {
        $(this).val(1);
    }
    $("#InputTopPId").val(value);
});
listenKeyup("#BestOf", function () {
    let value = $(this).val();
    if (value == "") {
        $(this).val(0);
        value = 0;
    }
    if (value >= 20) {
        $(this).val(20);
    }
    $("#InputBestOfId").val(value);
});
listenClick(".multiple-post", function () {
    let id = $(this).attr("data-id");
    let checked = $(".multiple-post").is(":checked");
    // $("input:checkbox[class=multiple-post]:checked").each(function () {
    //     allId = $(this).attr("data-id")
    //
    //     // console.log($(this).attr("data-id"))
    // });
    // console.log(allId)
    if (checked) {
        $(".delete-post-btn").removeClass("d-none");
    } else {
        $(".delete-post-btn").addClass("d-none");
    }
});
listenClick(".delete-post-btn", function () {
    let allId = [];
    let checked = $(".multiple-post");
    console.log(checked);
    $("input:checkbox[class=multiple-post]:checked").each(function () {
        let Id = $(this).attr("data-id");
        allId.push(Id);
    });
    console.log(allId);
});

listenClick(".delete-additional-img-btn", function () {
    let imageId = $(this).data("image");
    let url = route("additional-media.delete", imageId);

    swal({
        title: Lang.get("js.delete"),
        text:
            Lang.get("js.delete_warning") +
            ' "' +
            "Additional Image" +
            '"' +
            " ?",
        buttons: {
            confirm: Lang.get("js.delete"),
            cancel: Lang.get("js.cancel_delete"),
        },
        reverseButtons: true,
        icon: "warning",
    }).then(function (willDelete) {
        if (willDelete) {
            let imageDiv = $(".image-div-" + +imageId).addClass("d-none");
            deleteAdditionalThings(url, "Additional Image");
        }
    });
});

listenClick(".delete-post-file-btn", function () {
    let postId = $(this).data("file");
    let url = route("additional-media.delete", postId);

    swal({
        title: Lang.get("js.delete"),
        text: Lang.get("js.delete_warning") + ' "' + "File" + '"' + " ?",
        buttons: {
            confirm: Lang.get("js.delete"),
            cancel: Lang.get("js.cancel_delete"),
        },
        reverseButtons: true,
        icon: "warning",
    }).then(function (willDelete) {
        if (willDelete) {
            let fileDiv = $(".file-div-" + +postId).addClass("d-none");
            deleteAdditionalThings(url, "File");
        }
    });
});

function deleteAdditionalThings(url, header) {
    $.ajax({
        url: url,
        type: "DELETE",
        success: function (obj) {
            if (obj.success) {
                Livewire.dispatch("refresh");
                Livewire.dispatch("resetPage");
            }
            swal({
                icon: "success",
                title: Lang.get("js.deleted"),
                text: header + " " + Lang.get("js.delete_message"),
                buttons: {
                    confirm: Lang.get("js.ok"),
                },
                timer: 2000,
            });
        },
    });
}
listenChange("#draftPost", function () {
    Livewire.dispatch("changePostFilter", { post: $(this).val() });
});
listenChange("#postView", function () {
    Livewire.dispatch("changePostView", { view: $(this).val() });
});
listenClick("#draftPost-ResetFilter", function () {
    $("#draftPost,#postView").val(2).change();
    hideDropdownManually($('#draftPostFilterBtn'), $('.dropdown-menu'));
});
