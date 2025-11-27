
$('.edit-item,.archiveItem a ,button[type=submit]').on("click", function (e) {
    e.preventDefault();
    toastr.warning('Sorry! This is demo version.');
    if ('.edit-item'){
        $(this).attr('data-target','');
    }
});
$('.archiveItem a').attr('onclick','');

