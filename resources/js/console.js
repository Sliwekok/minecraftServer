$(function(){

    // This file is handling console menagment as showing messages etc
    const   container = $('#console'),
            form = container.find($('form#sendCommand')),
            messages = container.find('#messages'),
            command = form.find('#command')

    // scroll to the bottom of .console div 
    function scrollToBottom(){
        messages.scrollTop($("#messages")[0].scrollHeight);
    }


    form.on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: '/settings/sendCommand',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                command: command.val(),
            },
            error: function(error){
                console.log(error);
            },
            success: function(){
                if($('#noCommandsFound').length) messages.empty();
                var message = '<div class="row"><div class="col-12 message"><span>'+command.val()+'</span></div></div>'
                messages.append(message);
                command.val('').select();
                scrollToBottom();
            }

        });

    });
});
