$(document).ready(function(){

    var ALPHABET = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    var HIDDEN_WORD = 'hidden-word';
    var MULTICHOICE = 'multichoice';
    var TRUE_FALSE = 'true-false';
    var MATCHING = 'matching';

    $('.add-container #add-btn').on('mouseenter', function(){

        var display = $(this).parents('.add-container').find('.question-option button').css('display');

        if(display === 'none'){
          var distance = 40;
          var this_left = $(this).position().left;
          var this_top = $(this).position().top;
          var this_width = $(this).width();
          var this_height = $(this).height();

          var left_obj_x = this_left - distance;
          var right_obj_x = this_left + this_width + distance;
          var top_bottom_obj_x = this_left + this_width / 2;

          var top_obj_y = this_top - distance;
          var bottom_obj_y = this_top + this_height + distance;
          var left_right_obj_y = this_top + this_height / 2;

          var target = $(this).parents('.add-container').find('.question-option #hidden-word');
          target.css({
              'top': left_right_obj_y - target.height() / 2 + 'px',
              'left': left_obj_x - target.width() + 'px'
          });
          target.show();

          target = $(this).parents('.add-container').find('.question-option #multichoice');
          target.css({
              'top': top_obj_y - target.height() + 'px',
              'left': top_bottom_obj_x - target.width() / 2 + 'px'
          });
          target.show();

          target = $(this).parents('.add-container').find('.question-option #true-false');
          target.css({
              'top': left_right_obj_y - target.height() / 2 + 'px',
              'left': right_obj_x + 'px'
          });
          target.show();

          target = $(this).parents('.add-container').find('.question-option #matching');
          target.css({
              'top': bottom_obj_y + 'px',
              'left': top_bottom_obj_x - target.width() / 2 + 'px'
          });
          target.show();

          // change appearance of this button
          $(this).attr('title', 'Cancel');

          var child_span = $(this).children('span');
          child_span.removeClass('glyphicon-plus');
          child_span.addClass('glyphicon-remove');

        }
        else{

        }

    });

    $('.add-container #add-btn').on('click', function(){

        var display = $(this).parents('.add-container').find('.question-option button').css('display');

        if(display !== 'none'){
          $(this).parents('.add-container').find('.question-option button').hide();

          // change appearance of this button
          $(this).attr('title', 'Choose kind of question');

          var child_span = $(this).children('span');
          child_span.removeClass('glyphicon-remove');
          child_span.addClass('glyphicon-plus');
        }
    })

    $('.add-container .question-option button').on('click', function(){

        $(this).siblings('button').hide();
        $(this).hide();

        var add_btn = $(this).parents('.add-container').find('#add-btn');
        add_btn.attr('title', 'Choose kind of question');

        var child_span = add_btn.children('span');
        child_span.removeClass('glyphicon-remove');
        child_span.addClass('glyphicon-plus');

        // create question pane
        var question_kind = $(this).attr('id');
        new_question = generateQuestionPane(question_kind);

        // append to question container
        $('.question-container').append(new_question);
    })

    $('.question-container').on('click', '.question-multichoice .content .foot .add-multichoice', function(){

        var current_suggestion_container = $(this).parents('.content').children('.suggestion-container');
        var new_signal = getNextSignal(current_suggestion_container);
        var new_suggestion = generateMultichoiceSuggestion(new_signal);

        current_suggestion_container.append(new_suggestion);
    })

    $('.question-container').on('click', '.question-multichoice .content .suggestion-container .close-suggestion', function(){

        $(this).parent().parent().remove();

        // update the signal of the rest
        /*var the_rest = $(this).parents('.content').children('div');
        for(int i = 0; i < the_rest.length; i++){
            the_rest.find('.signal').innerContent = alphabet[i];
        }*/
    })

    $('.question-container').on('click', '.question-true-false .content .foot .switch-true-false', function(){

        var current_suggestion_container = $(this).parents('.content').children('.suggestion-container');
        var suggestions = current_suggestion_container.find('.suggestion');

        var tmp = suggestions[0].textContent;
        suggestions[0].textContent = suggestions[1].textContent;
        suggestions[1].textContent = tmp;
    })

    $('.question-container').on('click', ' .question-matching .content .foot .add-matching', function(){

        var current_suggestion_container = $(this).parents('.content').children('.suggestion-container');
        var new_signal = getNextSignal(current_suggestion_container);
        var new_matching = generateMatchingSuggestion(new_signal);

        current_suggestion_container.append(new_matching);

    })

    $('.question-container').on('click', ' .question-matching .content .suggestion-container .close-suggestion', function(){

        $(this).parent().parent().remove();
    })

    $('.question-container').on('keyup', '.question-hidden-word .content .suggestion-container .suggestion', function(e){

        var current_shown = $(this).siblings('.shown');
        var text = $(this).val();

        var shown_element = generateLetterShown(text);
        current_shown.empty();
        current_shown.append(shown_element);
    })

    function generateQuestionPane(question_kind){
        // create question pane
        var no_of_question = $('.question-container .question').length;
        var random;
        var new_question = '';
        var content_border = '';
        var svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25">'+
                    '<g>' +
                      '<path stroke="#000" d="m6.166686,-0.66664c0,0 6.333331,9.154778 0.333333,11.267419c-5.999998,2.112641 -12.666663,14.084274 8.333331,13.732167c20.999993,-0.352107 15.666662,-12.675847 8.333331,-13.027954c-7.333331,-0.352107 -6.666665,-8.098458 -1,-11.619526" fill-opacity="null" stroke-opacity="null" fill="#fff"/>' +
                    '</g>' +
                   '</svg>';

        // get the latest question edge
        // add the top edge if exist
        if(no_of_question > 0){
            var latest = $('.question-container .question')[no_of_question - 1];

            if($('.question-container .question').last().children('.edge-bottom-concave').length > 0){

                new_question += '<div class="edge edge-top-convex">' +
                                  '<div class="svg-container svg-container-top-convex">' +
                                    svg +
                                  '</div>'+
                                '</div>';
            }
            else if ($('.question-container .question').last().children('.edge-bottom-convex').length > 0){

                new_question += '<div class="edge edge-top-concave">' +
                                  '<div class="svg-container svg-container-top-concave">' +
                                    svg +
                                  '</div>'+
                                '</div>';
            }
        }
        else{
            content_border = 'content-border-top';
        }

        // add content
        var suggestion_content = generateSuggestionSample(question_kind);
        var foot_content = generateFootSample(question_kind);

        new_question += '<div class="content '+  content_border + '">' +
                          '<div class="head">' +
                            '<h4><strong>'+ (no_of_question + 1) + '</strong>' +
                              '<span class="glyphicon glyphicon-remove"></span>' +
                            '</h4>' +
                          '</div>' +
                          '<div class="title">' +
                            '<textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>' +
                          '</div>' +
                          '<div class="suggestion-container">' + suggestion_content + '</div>' +
                          '<div class="foot">' + foot_content + '</div>' +
                        '</div>'

        // random: 0 - convex, 1 - cave
        random = Math.floor(Math.random() * 2);

        if(random === 0){
            new_question += '<div class="edge edge-bottom-convex">' +
                            '<div class="svg-container svg-container-bottom-convex">' +
                              svg +
                            '</div>'+
                          '</div>';
        }
        else{
            new_question += '<div class="edge edge-bottom-concave">' +
                            '<div class="svg-container svg-container-bottom-concave">' +
                              svg +
                            '</div>'+
                          '</div>';
        }

        return '<div class="question question-' + question_kind + '">' + new_question + '</div>';
    }

    function generateSuggestionSample(question_kind){

        var suggestion_content = '';

        switch (question_kind) {
          case HIDDEN_WORD:
            suggestion_content = generateHiddenWordSuggestion();
            break;
          case MULTICHOICE:
            suggestion_content = generateMultichoiceSuggestion(ALPHABET[0]) +
                                 generateMultichoiceSuggestion(ALPHABET[1]);
            break;
          case TRUE_FALSE:
            suggestion_content = generateTrueFalseSuggestion();
            break;
          case MATCHING:
            suggestion_content = generateMatchingSuggestion(ALPHABET[0]);
            break
          default:
            break;
        }

        return suggestion_content;
    }

    function generateFootSample(question_kind){

        var foot_content = '';

        switch (question_kind) {
          case HIDDEN_WORD:
            foot_content = generateHiddenWordFoot();
            break;
          case MULTICHOICE:
            foot_content = generateMultichoiceFoot();
            break;
          case TRUE_FALSE:
            foot_content = generateTrueFalseFoot();
            break;
          case MATCHING:
            foot_content = generateMatchingFoot();
            break;
          default:
            break;
        }

        return foot_content;
    }

    function getNextSignal(current_suggestion_container){

        var no_of_suggestion = current_suggestion_container.children('div').length;

        return ALPHABET[no_of_suggestion];
    }

    function generateMultichoiceSuggestion(new_signal){

        var new_multichoice = '<div class="col-xs-12 col-sm-6">' +
                                '<p>' +
                                  '<span class="signal">' + new_signal + '.</span>' +
                                  '<input class="suggestion" type="text" name="" value="">' +
                                  '<button class="close-suggestion" title="Remove this" type="button" name="">' +
                                    '<span class="glyphicon glyphicon-remove"></span>' +
                                  '</button>' +
                                '</p>' +
                              '</div>';

        return new_multichoice;
    }

    function generateMatchingSuggestion(new_signal){

        var new_matching = '<div>' +
                              '<div class="col-xs-12">' +
                                '<span class="signal">' + new_signal + '. </span>' +
                                '<button class="close-suggestion" title="Remove this matching" type="button" name="">' +
                                  '<span class="glyphicon glyphicon-remove"></span>' +
                                '</button>' +
                                '<div class="clearfix"></div>' +
                              '</div>' +
                              '<div class="col-xs-6">' +
                                '<textarea class="suggestion" name="" rows="3"></textarea>' +
                              '</div>' +
                              '<div class="col-xs-6">' +
                                '<textarea class="suggestion" name="" rows="3"></textarea>' +
                              '</div>' +
                          '</div>';

        return new_matching;
    }

    function generateHiddenWordSuggestion(){

        return '<div class="shown"></div>' +
               '<input class="suggestion" type="text" name="" placeholder="Answer here">';
    }

    function generateTrueFalseSuggestion(){

        var option_a = '<div class="col-xs-12 col-sm-6">' +
                          '<p>' +
                            '<span>A. </span>' +
                            '<span class="suggestion">True</span>' +
                          '</p>' +
                       '</div>';

        var option_b = '<div class="col-xs-12 col-sm-6">' +
                          '<p>' +
                            '<span>B. </span>' +
                            '<span class="suggestion">False</span>' +
                          '</p>' +
                        '</div>';

        return option_a + option_b;
    }

    function generateLetterShown(text){

        var shown = '';

        for(var i = 0; i < text.length; i++){

            if(text[i] === ' '){
                // close tag of the latest word
                if(i > 0 && text[i - 1] !== ' '){
                    shown += '</div>';
                }
                // add space
                shown += '<div class="wrapper-letter space"><span>_</span></div>';
            }
            else{
                // open tag of the new word
                if(i === 0 || text[i - 1] === ' '){
                    shown += '<div class="word">';
                }
                // add letter
                shown += '<div class="wrapper-letter"><span>' + text[i] + '</span></div>';
            }
        }

        return shown;
    }

    function generateHiddenWordFoot(){

        return '<p>Let your children have fun in guessing answer letter by letter.</p>';
    }

    function generateMultichoiceFoot(){

        return '<button class="add-multichoice" type="button" name="" title="Add 1 more suggestion">' +
                  '<span class="glyphicon glyphicon-plus"></span>' +
                '</button>' +
                '<p>Default correct answer is A. When test is shown, suggestion\'s positions will be changed randomly.</p>';
    }

    function generateTrueFalseFoot(){

        return '<button class="switch-true-false" type="button" name="" title="Switch correct answer">' +
                  '<span class="glyphicon glyphicon-refresh"></span>' +
                '</button>' +
                '<p>Default correct answer is A. When test is shown, suggestion\'s positions will be changed randomly.</p>';
    }

    function generateMatchingFoot(){

        return '<button class="add-matching" type="button" name="" title="Add 1 more matching">' +
                  '<span class="glyphicon glyphicon-plus"></span>' +
                '</button>' +
                '<p>Each row has 2 matched elements. When test is shown, suggestion\'s positions will be changed randomly.</p>';
    }
});
