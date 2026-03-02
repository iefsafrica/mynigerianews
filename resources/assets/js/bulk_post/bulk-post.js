document.addEventListener('turbo:load', loadBulkPostData);

function loadBulkPostData(){

}
listen('click','#categoryIdsList',function (){
    $.ajax({
        url: route('bulk-post-ids-list'),
        type: 'GET',
        success: function (result) {
            $('#IdsModalData').html(result.data)
            $('#addIdsModalData').modal('show')
        }
    })
})
listen('click','#documentation',function (){
    $.ajax({
        url: route('bulk-post-documentation'),
        type: 'GET',
        success: function (result) {
            $('#IdsModalData').html(result.data)
            $('#addIdsModalData').modal('show')
        }
    })
})

listenChange('#bulkPost', function (){
    let ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext,['csv']) == -1){
        displayErrorMessage('The file must be a file of csv type.');
        $(this).val('');
    }
});
