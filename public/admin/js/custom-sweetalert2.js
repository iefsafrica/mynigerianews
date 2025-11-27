/*
* MAANNEWS CUSTOM sweet2 message
 * ------------------
 * You should not use this file in production.
* */
"use strict";
/**
 * MAANNEWS CUSTOM sonSubmitInsert()
 * ------------------
 * This function use all inserted data.
 * */


function onSubmitInsert(){
    Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Data Inserted successfully!',
        showConfirmButton: false,
        timer: 1500,
        onOpen: function() {
            var maanlms = document.getElementById("myAudio");
            maanlms.play();
        }
    })
}
function onSubmitUpdate(){
    Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Data Updated successfully!',
        showConfirmButton: false,
        timer: 1500,
        onOpen: function() {
            var maanlms = document.getElementById("myAudio");
            maanlms.play();
        }
    })
}
function onSubmitDelete(any){
    var click = $(any);
    var id = click.attr("id");
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        onOpen: function() {
            var maanlms = document.getElementById("myAudio");
            maanlms.play();
        }
    }).then((result) => {
        if (result.isConfirmed) {

            $('a[id="' + id + '"]').parents(".archiveItem").submit();


        }
    })
}
