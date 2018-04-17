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

// chosen hints
$('.hints').on('click', 'ul > li', function(){

    var hint = $(this)[0].textContent;
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

    var topic = generateHint(hint, true);

    chosen_hints_container.append(topic);
    $('.hints').hide();
});

function generateHint(hint, isHintExisted){

    var new_hint_class = (isHintExisted) ? '' : 'new-hint';
    return  "<span class='" + new_hint_class + "'>" + hint +
              "<span class='close-chosen-hint'>&times</span>" +
            "</span>";
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
