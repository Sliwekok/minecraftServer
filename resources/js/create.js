// that file mostly takes care of validating and working around on file views/settings/create
$(function (){
    // add some animations while creating new server
    // animate 'add' button to show 1st part of form
    $('#create > #add').on('click', function(){

        $('#create > #add, #messageNoServers')
            .animate({
                opacity: 0,
                left: "-500",
                queue: false,

            }, 500)
            .hide(0);

        $("#create > #dataAboutServer").fadeIn(500);
    });
    // animate 'next' button to slide to 2nd part of form
    $('#create').find("#generalData > .next").on('click', function(){

        // sprawdzanie czy nazwa serwera, wersja i jego opis jest uzupełniony poprawnie
        if( $('#serverName').val().length == 0 || $('#serverName').val().length > 64 ){
            
            $('#errorServerName').text('Wprowadź poprawną długość znaków').show(0);
            return;
        }
        else{
            $('#errorServerName').hide(0);
        }

        if( $('#serverDescription').val().length > 128 ){
            
            $('#errorServerDescription').text('Wprowadź poprawną długość znaków').show(0);
            return;
        }

        if( $('#version').val().length == 0 || $('#version').val().length > 10 ){
            $('#errorVersion').text('Podaj poprawną wersję serwera').show(0);
            return;
        }

        else{
            $('#errorServerDescription').hide(0);
        }

        $('#create').find('#generalData')
            .animate({
                opacity: 0,
                left: "-500",
                queue: false,

            }, 500)
            .hide(0);

        $('#create').find('#serverSettings')
            .animate({
                opacity: 1,
                left: "0",
                queue: false,
            }, 500)
            .css("display", "block");
    });
    //animate button 'previous' to slide back to previous part of form
    $('#create').find("#serverSettings > .previous").on('click', function(){
        $('#create').find('#serverSettings')
            .animate({
                opacity: 0,
                left: "500",
                queue: false,
            }, 500)
            .hide(0)

        $('#create').find('#generalData')
            .animate({
                opacity: 1,
                left: "0",
                queue: false,

            }, 500)
            .css("display", "block");
    });

    // show current amount of characters, to prevent too long names
    $('#create').find("#serverName").keyup(function(){
        var chars = $(this).val().length;
        $('#maxNameLength > .currentAmount').text(chars);
        if(chars > 64){
            $('#maxNameLength').attr("style", "color: rgb(255, 104, 104) !important");
        }
        if(chars <= 64){
            $('#maxNameLength').attr("style", "color: rgb(104, 180, 255) !important");
        }
    });

    $('#create').find('#serverDescription').keyup(function(){
        var chars = $(this).val().length;
        $('#maxDescriptionLength > .currentAmount').text(chars);
        if(chars > 128){
            $('#maxDescriptionLength').attr("style", "color: rgb(255, 104, 104) !important");
        }
        if(chars <= 128){
            $('#maxDescriptionLength').attr("style", "color: rgb(104, 180, 255) !important");
        }
    });
});