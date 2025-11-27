/*
* MAANNEWS CUSTOM AJAX
 * ------------------
 * You should not use this file in production.
* */
"use strict";
$(document).ready(function(){
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]') } });
// news category
    $("#newscategory_id").on("change",function (){

        var newscategory_id = $('#newscategory_id').val();
        $('#newssubcategory_id').empty();
        $.ajax({
            url:config.routes.newscategory,
            method:"get",
            dataType:"json",
            data:{
                'newscategory_id':newscategory_id,
            },
            success: function(data){

                $.each(data,function (index,element){
                    $("#newssubcategory_id").append(
                    '<option value="'+element.id+'">'+element.name+'</option>'
                );
            });
            },
            error: function () {
                alert('Error occur fetch subcategory action.....!!');
            }

        })
    });
    // blog sub-category
    $("#blogcategory_id").on("change",function (){

        var blogcategory_id = $('#blogcategory_id').val();
        $('#blogsubcategory_id').empty();
        $.ajax({
            url:config.routes.blogcategory,
            method:"get",
            dataType:"json",
            data:{
                'blogcategory_id':blogcategory_id,
            },
            success: function(data){

                $.each(data,function (index,element){
                    $("#blogsubcategory_id").append(
                    '<option value="'+element.id+'">'+element.name+'</option>'
                );
            });
            },
            error: function () {
                alert('Error occur fetch subcategory action.....!!');
            }

        })
    });
// video gallery ..

    var video_option = $('#video_option').val();
    if (video_option=='Upload Video'){

        $("#videosorucediv,#linkdiv").hide();
        $("#videodiv").show();
    }else if(video_option=='Share Link'){
        $("#videodiv").hide();
        $("#videosorucediv,#linkdiv").show();
    }else{
        $("#videosorucediv,#linkdiv,#videodiv").hide();
    }

    $("#video_option").on("change",function (){
        var video_option = $('#video_option').val();
        if (video_option=='Upload Video'){
            $("#videosorucediv,#linkdiv").hide();
            $("#videodiv").show();
        }else if(video_option=='Share Link'){
            $("#videodiv").hide();
            $("#videosorucediv,#linkdiv").show();
        }else{
            $("#videosorucediv,#linkdiv,#videodiv").hide();

        }
    });

    //user
    var permissions_box = $("#permissions_box");
    var permissions_checkbox_list = $("#permissions_checkbox_list");

    permissions_box.hide()//hide permission box

    $("#role").on("change",function (){
        var role = $(this).find(":selected");
        var role_id = role.data("role-id");
        permissions_checkbox_list.empty();

        $.ajax({
            url:"create",
            method:"GET",
            dataType:"json",
            data:{
                role_id:role_id,

            }

        }).done(function (data){
            //show permission box
            permissions_box.show();

            $.each(data,function (index,element){
                $(permissions_checkbox_list).append(
                    '<div class="form-group">'+

                    '<input type="checkbox" class="custom-control-input" name="permissions[]" id="'+element.slug+'" value="'+element.id+'" checked="checked" >'+
                    '<label class="custom-control-label" for="'+element.slug+'">'+element.name+'</label>'+
                    '</div>'
                )
            });
        });
    });

    //user edit
    var user_permissions_box = $("#user_permissions_box");
    permissions_box.hide()//hide permissions box

    $("#roleedit").on("change",function (){
        var role = $(this).find(":selected");
        var role_id = role.data("role-id");
        permissions_checkbox_list.empty();
        user_permissions_box.empty();

        $.ajax({
            url:config.routes.userrole,
            method:"get",
            dataType:"json",
            data:{
                role_id:role_id,

            }
        }).done(function (data){

            permissions_box.show();
            $.each(data,function (index,element){
                $(permissions_checkbox_list).append(
                    '<div class="form-group">'+

                    '<input type="checkbox" class="custom-control-input" name="permissions[]" id="'+element.slug+'" value="'+element.id+'" checked="checked" >'+
                    '<label class="custom-control-label" for="'+element.slug+'">'+element.name+'</label>'+
                    '</div>'
                )
            });
        });
    });

});
/** =====================**
 * blog published
 * blog unpublished
 **=======================*/
$('.status-item').each(function () {
    var container = $(this);
    var service = container.data('id');
    //publish unpublish
    $('#menu_publish_'+service).on('click',function () {
        var id = $('#menu_publish_'+service).data('id');
        var statustext = $('#menu_publish_'+service).data('status-text');
        if ($('#menu_publish_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
        ajaxFunction(id,statustext,status);

    })
    //publish unpublish
    $('#status_'+service).on('click',function () {
        var id = $('#status_'+service).data('id');
        var statustext = $('#status_'+service).data('status-text');

        if ($('#status_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }

        //call ajax function
       ajaxFunction(id,statustext,status);
    });
    $('#breakingnews_'+service).on('click',function () {
        var id = $('#breakingnews_'+service).data('idbreaking');
        var statustext = $('#breakingnews_'+service).data('status-textbreaking');

        if ($('#breakingnews_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
       ajaxFunction(id,statustext,status);

    });
    //contact us
    $('#contactus_'+service).on('click',function () {

        var id = $('#contactus_'+service).data('idcontactus');
        var statustext = $('#contactus_'+service).data('status-textcontactus');
        if ($('#contactus_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
       ajaxFunction(id,statustext,status);

    });
    // is active ...
    let is_active = '#is_active_'+service ;
    $(is_active).on('click',function () {

        var id = $(is_active).data('id-isactive');
        var statustext = $(is_active).data('status-text');

        if ($(is_active).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
       ajaxFunction(id,statustext,status);

        setTimeout(function (){
            window.location.reload(true);
            //location.reload();
        },500)

    });
    $('#theme_active_'+service).on('click',function () {
        var id = $('#theme_active_'+service).data('id');
        let is_active = $('#theme_active_'+service).data('is-active');
        var statustext = $('#theme_active_'+service).data('status-text');
        if (is_active!=1)
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
        ajaxFunction(id,statustext,status);

    });
});
//theme color change

$('.theme-color').each(function () {
    let container = $(this);
    let colorid = container.data('color');
    $('#'+colorid).on('click',function () {

        let theme_color = $('#'+colorid).data('color');
        let color_text = $('#'+colorid).data('colortext');
        if (theme_color !=null)
        {
            var status = 1;
        }else {
            var status = 0
        }
        $.ajax({
            url:'/admin/publish/theme-color/ajax',
            method:"GET",
            dataType:"json",
            data:{
                'status':status,'theme_color':theme_color,
            },
            success: function(data){

                if(data.status==1){
                    toastr.success(color_text+' Published');
                    $('.active').removeClass('active');
                    $('#'+colorid).addClass('active');
                }

            },
            error: function (data) {
                console.log(data)
                alert(data);

            }
        })

    });
})
$('.color-items').each(function () {
    let container = $(this);
    let colorid = container.data('id');
    $('#'+colorid).on('click',function () {
        let theme_color = $('#'+colorid).data('color');
        let color_text = $('#'+colorid).data('colortext');
        if (theme_color !=null)
        {
            var status = 1;
        }else {
            var status = 0

        }
        $.ajax({
            url:'/admin/publish/theme-color/ajax',
            method:"GET",
            dataType:"json",
            data:{
                'status':status,'theme_color':theme_color,
            },
            success: function(data){

                if(data.status==1){
                    toastr.success(color_text+' Published');
                    $( '#'+colorid).find( "radio" ).prop("checked", true)

                }

            },
            error: function (data) {
                console.log(data)
                alert(data);

            }
        })

    });
})

function ajaxFunction(id,statustext,status){

    $.ajax({
        url:'/admin/publish/status/ajax',
        method:"GET",
        dataType:"json",
        data:{
            'status':status,'id':id,'statustext':statustext,
        },
        success: function(data){

            if(data.status==1){
                toastr.success(statustext+' Published');
                if (statustext=='Theme Active'){
                        $('.active-btn').addClass('deactive-btn').removeClass('active-btn').text('Deactivated').attr('data-is-active',0).attr("disabled", false);

                    $('#theme_active_'+id).addClass('active-btn').removeClass('deactive-btn').text('Activated').attr("disabled", true)
                }
            }else{
                toastr.error(statustext+' Unpublished.');
            }

        },
        error: function (data) {
            console.log(data)
            alert(data);
            //alert('Error occur fetch subcategory action.....!!');
        }
    })
}
