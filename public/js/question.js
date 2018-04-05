$(document).ready(function(){

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
        new_question += '<div class="content '+  content_border + '">' +
                          '<div class="head">' +
                            '<h4><strong>'+ (no_of_question + 1) + '</strong>' +
                              '<span class="glyphicon glyphicon-remove"></span>' +
                            '</h4>' +
                          '</div>' +
                          '<div class="title">' +
                            '<textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>' +
                          '</div>' +
                          '<div class="suggestion"></div>' +
                          '<div class="foot"></div>' +
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

        return '<div class="question">' + new_question + '</div>';
    }

    
});
