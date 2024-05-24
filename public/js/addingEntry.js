function addEntry(routeLink){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var add_cus_modal = '#modalComponent';
    var form = '#formComponent';
    var err_message = $('#error_msg');

    var data = $(form).serialize();
    $.ajax({
        type: 'POST',
        url: routeLink,  
        data: data,
        success:function(data){
           console.log('data');
           console.log(data);
            if(data.result){
                $(add_cus_modal ).hide();
                $('.modal-backdrop').remove();                       
                location.reload();
            }else{
                err_message.text(data.message)
            }                    
        },
        error:function(e){
            console.log(e);
            var response = $.parseJSON(e.responseText);
            err_message.text(Object.values(response.errors)[0])
                    
        }
    });
            

}

