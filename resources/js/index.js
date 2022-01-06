$(function (){

    var container = $('#serverFound');

    // depending on status (given in class and data parameter) change #generalData background-color
    function changeBackgroundStatus(){
        var box = container.find('#generalData'),
            status = box.attr("data-server-status");
            color = '';
        switch (status) {
            case 'online': 
                color = 'rgb(142, 255, 90)';
                break;
            case 'offline':
                color = 'rgb(255, 104, 104)';
                break;
            case 'banned':
                color = 'rgb(255, 104, 104)';
                break;
        }
        box.find('#onlineStatus').css('background-color', color);
    }changeBackgroundStatus();

    container.find('p#copy[data-toggle="tooltip"]')
        // copy ip of server 
        .click(function(){
            // var tekst = navigator.clipboard.writeText(zmienna.val());
            alert('WIP - potrzeba HTTPS / localhosta by dzialalo, Copy:' + $(this).text());

            // let user know he has copied ip
            $(this).attr("data-original-title","Skopiowano!").tooltip('show');
        })
        // on leaving cursor change back to original title
        .mouseover(function(){
            $(this).attr("data-original-title","Kliknij aby skopiować!");
        });


    // on hover over dashboard .menuItem show arrow
    $('#dashboard').find('.menuItem').hover(function(){
        $(this).find('span.arrowRedirect').toggle();
    });

    container.find('#serverAction').click(function(){

        var caption = $(this).find('p#caption');

        caption
            .html('Szukanie diamentów ...')
            .css({
                backgroundcolor: 'rgb(128, 128, 128)',
                userselect: 'none',
            });

        $.ajax({
            url: '/settings/action',
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(error){
                caption
                    .html('nie działa :(((( <i class="icon-off"></i>')
                    .css({
                        backgroundcolor: 'rgb(142, 255, 90)',
                        userselect: 'auto',
                    });
                console.log(error);
                refreshDiv(container.find('#generalData'), '/settings/');
            },
            success: function(){
                caption
                    .html('działa!!! <i class="icon-off"></i>')
                    .css({
                        backgroundcolor: 'rgb(142, 255, 90)',
                        userselect: 'auto',
                    });
                refreshDiv(container.find('#generalData'), '/settings/');     
            }

        });

        // refresh the container with new data
        function refreshDiv(div, url){
            var parentDiv = div.parent(),
                loadedDiv = url + ' #generalData';
            // jquery .load loads into that container, so we need to go 1 div upper 
            parentDiv
                .load(loadedDiv, () => {
                    changeBackgroundStatus();
                    enableTooltips();
                });
        }

    })

});
