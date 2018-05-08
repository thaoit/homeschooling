$('.chosen-hints').on('click', '.close-chosen-hint', function(){

    $(this).parent().remove();
});

// only show when typing hint
$('.hints').hide();

/*$('.typing-hint > input').on('keyup', function(){

    var hints = $(this).parents('.hint-chosen-panel').find('.hints');

    if( $(this).val().length === 0 ){

      hints.hide();
      return true;
    }

    // show
    hints.show();

});*/

$('.typing-hint > input').on('keyup', function(e){

    var hints = $(this).parent('.typing-hint').siblings('.hints');
    var message = $('.message');

    // check empty text input
    if( $(this).val().length === 0 ){

      hints.empty();
      hints.hide();
      message.hide();
      return true;
    }
    
    if(e.key === "Enter" && hints.children().length === 0){

        var hint = $(this).val();
        var chosen_hints_container = $(this).parents('.hint-chosen-panel').find('.chosen-hints');

        // check if this hint is existed in chosen, if not: inform user
        if(isHintChosen(hint, chosen_hints_container)){
            message[0].innerText = 'This topic has been chosen';
            return true;
        }

        // create new topic
        var new_topic = generateHint(hint, null);
        chosen_hints_container.append(new_topic);

        // hide message and empty the input after adding new chosen topic
        message.hide();
        $(this).val('');
    }

});

// chosen hints
$('.hints').on('click', 'ul > li', function(){

    var hint = $(this)[0].textContent;
    var id = $(this).attr('data-id');
    var panel = $(this).parents('.hint-chosen-panel');
    var chosen_hints_container = panel.find('.chosen-hints');
    var message = panel.find('.message');

    if(isHintChosen(hint, chosen_hints_container)){

        if(message.length > 0){
            message[0].innerText = 'This topic has been chosen';
            message.show();
        }
        return true;
    }

    var topic = generateHint(hint, id);

    chosen_hints_container.append(topic);
    $('.hints').hide();
});

function generateHint(hint, id){

    var hint_html = '';

    if(typeof id === "undefined" || id === null){
        hint_html =   "<span class='chosen-hint'>" + hint +
                        "<span class='close-chosen-hint'>&times</span>" +
                      "</span>";
    }
    else{
      hint_html =   "<span class='chosen-hint' data-id=" + id + ">" + hint +
                      "<span class='close-chosen-hint'>&times</span>" +
                    "</span>";
    }

    return hint_html;
}

function isHintChosen(hint, chosen_hints_container){

    var chosen_hints = chosen_hints_container.find('.close-chosen-hint').parent();
    for(var i = 0; i < chosen_hints.length; i++){

        var chosen_hint = chosen_hints[i].innerText;

        if(chosen_hint.length > 1){

            chosen_hint = chosen_hint.substring(0, chosen_hint.length - 1);

            if(chosen_hint === hint){
                return true;
            }
        }
    }

    return false;
}
