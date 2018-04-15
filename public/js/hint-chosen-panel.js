$('.chosen-hints').on('click', '.close-chosen-hint', function(){

    $(this).parent().remove();
});

// only show when typing hint
$('.hints').hide();

$('.typing-hint > input').on('keyup', function(){

    var hints = $(this).parents('.hint-chosen-panel').find('.hints');

    if( $(this).val().length === 0 ){

      hints.hide();
      return true;
    }

    // show
    hints.show();

});

// chosen hints
$('.hints').on('click', 'ul > li', function(){

    var topic = "<span>" + $(this)[0].textContent +
                "<span class='close-chosen-hint'>&times</span>" +
                "</span>";

    $(this).parents('.hint-chosen-panel').find('.chosen-hints').append(topic);
    $('.hints').hide();
});
