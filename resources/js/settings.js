$(function (){

    // on click on .menuItem in dashboard.blade change current site    
    $('.redirect').click(function(){
        window.location.href = $(this).attr("data-page-redirect");
        
        if( $(this).attr("data-page-redirect") == "/settings/account" ) window.location.href = "/account";
    });

    // if alert is visible - autofade him after 15 seconds
    // wip
    setTimeout(function(){
        $('alert').alert('close');   
    }, 1500);

});
