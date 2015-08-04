$('#mainReportBody').on('submit', 'form#addReport', function(e){
    e.preventDefault();
    var url = $(this).prop('action');
    $.ajax({
        type: 'POST',
        url: url,
        context: this,
        cache: false, 
        data: $(this).serialize(),
        success: function(data){
            
            if(data['status'] == 'error'){
                // $(this).find('.replyError').text(data['label']);
                // $("#errorlabel").focus();
            }
            if(data['status'] == 'success'){
                // $('textarea.txtreply').val('');
                // $(this).prepend(data['reply']);
            }
        }
    });
});