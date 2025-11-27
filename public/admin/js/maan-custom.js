/*
* MAANNEWS CUSTOM Js
 * ------------------
 * You should not use this file in production.
* */

"use strict";

/**
 * MAANNEWS CUSTOM previewFile()
 * ------------------
 * This function use all Uploaded Image Preview.
 * */
function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }

}
$("#description,#summary_news,#summary_blog").keyup(function(){
    var characters = $(this).val().length;
    var maxlen = 255;
    var countlast = Math.ceil(maxlen - characters) ;

    if (characters>maxlen){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'This field text is too long!',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            onOpen: function() {
                var maanlms = document.getElementById("myAudio");
                maanlms.play();
            }
        })
        $('#submit').prop("disabled",true);

        $("#count").css("color","red").css("background-color","yellow");

    }else{
        $('#submit').prop("disabled",false);
        $("#count").css("color","green");
        $("#count").css("background-color","#D4FCF6");
    }
    $("#count").text("Characters: " + countlast );

});

/**
* edit settings
 * */

$('.edit-item').each(function () {
    var container = $(this);
    var service = container.data('id');
    var id = service;
    $('#edit-item_'+service).on('click',function () {
        var title = $('#edit-item_'+service).data('title');
        var name = $('#edit-item_'+service).data('name');
        var short_name = $('#edit-item_'+service).data('short-name');
        $('#edit_title').val(title);
        $('#edit_name').val(name);
        $('#edit_short_name').val(short_name);
        $('#edit_footer_content').val($('#edit-item_'+service).data('footer-content'));
        $('#edit_play_store_url').val($('#edit-item_'+service).data('play-store-url'));
        $('#edit_app_store_url').val($('#edit-item_'+service).data('app-store-url'));
        var editactionroute = "settings/update"
        $('#editformname').attr('action', editactionroute+'/'+id);

    })
    let theme_edit = '#edit-theme_'+service;
    $(theme_edit).on('click',function () {
        let theme_id = $(theme_edit).data('id');
        $('#title').val($(theme_edit).data('title'));
        $('#author').val($(theme_edit).data('author'));
        $('#description').val($(theme_edit).data('description'));
        $('#version').val($(theme_edit).data('version'));
        $('#page').val($(theme_edit).data('page'));

        $('form[name="themeForm"]').attr('action','');

        $('form[name="themeForm"]').on('submit',function () {
            $('form[name="themeForm"]').append('<input type="hidden" name="_method" value="PUT">');
            $('form[name="themeForm"]').attr('action','/admin/theme/update/'+theme_id);

        });

    })
    //icon..
    $('#edit-item-icon_'+service).on('click',function () {
        var editactionroute = "settings/update"
        $('#editformicon').attr('action', editactionroute+'/'+id);
    })
    //logo..
    $('#edit-item-logo_'+service).on('click',function () {
        var editactionroute = "settings/update"
        $('#editformlogo').attr('action', editactionroute+'/'+id);

    })

});



