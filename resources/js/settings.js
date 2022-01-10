$(function (){

    // on click on .menuItem in dashboard.blade change current site    
    $('.redirect').on('click', function(){
        window.location.href = $(this).attr("data-page-redirect");
        
        if( $(this).attr("data-page-redirect") == "/settings/account" ) window.location.href = "/account";
    });

    var container = $('#serverFound'),
        generalData = container.find('#generalData'),
        serverAction = container.find('#serverAction');

    // depending on status (given in class and data parameter) change background-color for 2 divs
    function changeBackgroundStatus(){
        var status = generalData.attr("data-server-status"),
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
        generalData.find('#onlineStatus').css('background-color', color);
        serverAction.css('background-color', color);
    }changeBackgroundStatus();

    container.find('p#copy[data-toggle="tooltip"]')
        // copy ip of server 
        .on('click', function(){
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

    // serverAction.on('click', function(){
    $(document).on('click', '#serverAction', function(){
        serverAction
            .css({
                'background-color': 'rgb(128, 128, 128)',
            })  
            .find('p#caption span')
                .html('Szukanie diamentów ...')
            

        $.ajax({
            url: '/settings/action',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(error){
                console.log("=========");
                console.log(error);
                // refreshDiv(serverAction.find('p#caption').parent(), '/settings/' + ' #serverAction');
                // refreshDiv(generalData.parent(), '/settings/' + ' #generalData');
                // refreshDiv(generalData, '/settings/', '#generalData');  
                // refreshDiv(serverAction, '/settings/', '#serverAction');  
            },
            success: function(data){
                // refreshDiv(serverAction.find('p#caption').parent(), '/settings/' + ' #serverAction');
                // refreshDiv(generalData.parent(), '/settings/' + ' #generalData');     
                if(data == 'error'){
                    alert(data);
                }
                console.log(data);
                refreshDiv(serverAction, '/settings/', '#serverAction');  
                refreshDiv(generalData, '/settings/', '#generalData');    

            }

        });

    });
});
// refresh the container with new data
function refreshDiv(div, url, requestedContainer){
    var parentDiv = div.parent(),
        loadedDiv = url + ' ' + requestedContainer;
    // jquery .load loads into that container, so we need to go 1 div upper 
    parentDiv
        .load(loadedDiv, () => {
            changeBackgroundStatus();
            // enableTooltips();
        });
}