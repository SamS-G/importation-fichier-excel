$(document).ready(function(){
    let id = $('#import')
    $('#import_excel_form').on('submit', function(event){
            event.preventDefault();
        $.ajax({
            url:"?p=import/file",
            method:"POST",
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                id.attr('disabled', 'disabled');
                id.val('Importing...');
            },
            success:function(data)
            {
                $('#message').html(data);
                $('#import_excel_form')[0].reset();
                id.attr('disabled', false);
                id.val('Import');
            }
        })
    });
});