$(document).ready(function(){

    // variables
    var step = 2;
    // store outline data in form of select tag
    var outline_data=[];
    // store section may be deleted
    var deleted_section;

    // events

    $('.outline-container').on('keypress', '.outline', function(e){

      // pressing Enter or not
      if(e.which == 13 || e.keyCode == 13){
        e.preventDefault();

        var new_outline = "<div class='input-group'>" +
                            "<span class='input-group-addon step-index'>Step " + step + " - </span>" +
                            "<input class='form-control outline' type='text' data-id='" + step + "'>" +
                            "<span class='input-group-addon close-outline' data-toggle='modal' data-target='#confirmation-modal'>&times;</span>" +
                          "</div>";

        $('.outline-container').append(new_outline);
        $('.outline-container .outline').last().focus();
        step++;
      }
    });

    $('.outline-container').on('click', '.close-outline', function(){

        deleted_section = $(this);
    })

    $('.confirmation-modal .delete-btn').on('click', function(){

        var outline_container = deleted_section.parents('.outline-container');
        var outline = outline_container.find('.outline');
        var step_index = outline_container.find('.step-index');

        if(outline.length > 1){

            var current_outline_index = deleted_section.parent().index();

            // change name of steps following the current outline
            for(var i = current_outline_index; i < outline.length; i++){
              step_index[i].textContent = 'Step ' + i + ' - ';
            }

            // remove the outline and decrease step
            deleted_section.parent().remove();
            step--;

            // delete tests belong to outline
            deleteAttachedTests(
                outline.eq(current_outline_index - 1).attr('data-id'),
                $('.test-container')
            )
        }
        else{

            alert('There is at least 1 outline in each lesson');
        }

    })

    // convert outline data to html tag: select option
    $('.test-modal-btn').on('click', function(){

        outline_data = getOutlineData($('.outline-container'));

        // get outline_id that each test belongs to
        var tests = $(this).parents('.test-container').find('.content li');
        var outline_id_in_tests = [];

        for(var i = 0; i < tests.length; i++){

            outline_id_in_tests[i] = tests.eq(i).attr('data-outline-id');
        }

        // bind data to the existed chosen tests
        rebindOutlineData(
            outline_id_in_tests,
            $('.test-modal .tests-chosen-container')
        );

    })

    $('.test-hints').on('click', 'ul li', function(){

        var from = $(this).children('.from')[0].innerText;
        var name = $(this)[0].innerText;
        var test_name = name.substring(0, name.length - from.length);
        var id = $(this).attr('data-id');

        var chosen_test = generateChosenTest(id, from, test_name);

        // append the chosen test to container
        var tests_chosen_container = $(this).parents('.test-hints').siblings('.tests-chosen-container');
        var tests = tests_chosen_container.children('.tests');
        tests.append(chosen_test);

        // show the chosen tests if this is the first chosen test
        if(tests.children().length === 1){

            tests_chosen_container.show();
        }
    })

    $('.tests').on('click', 'li .close-test', function(){

        // hide test chosen tests chosen container if there aren't any children
        var tests = $(this).parents('.tests');
        if(tests.children().length === 1){

            tests.parent().hide();
        }

        $(this).parents('li').remove();
    })

    $('.test-chosen > input').on('keyup', function(){

        if($(this).val().length === 0){

           $('.test-hints').hide();
           return true;
        }

        $('.test-hints').show();
    })

    $('.ok-tests').on('click', function(){

        var tests = $(this).parents('.test-modal').find('.tests-chosen-container .tests li');
        var html = generateChosenTestToOutside(tests);

        var content = $('.test-container .content');
        content.children('li').remove();
        content.append(html);
    })

    $('.tests-chosen-container .tests').on('change', 'li > select', function(){

        var outline_id = $(this)[0].value;
        $(this).parent('li').attr('data-outline-id', outline_id);
    })

    function generatePositionOtion(){

        return generateOutlineDataToHTML(outline_data);
    }

    // chose test from the hints
    function generateChosenTest(id, from, test_name){

        if(outline_data.length === 0){
            return '';
        }

        var default_outline_id = outline_data[0].id;
        var position_option = generatePositionOtion();

        return '<li data-outline-id="' + default_outline_id + '" data-id="' + id + '">' +
                  '<p class="col-xs-12 col-sm-8">' +
                    test_name +
                    '<span class="from">'+ from + '</span>' +
                  '</p>' +
                  position_option +
                  '<button class="col-xs-6 col-sm-1 close-test" type="button" name="" title="Remove this test">' +
                    '<span class="glyphicon glyphicon-remove"></span>' +
                  '</button>' +
                '</li>';
    }

    // generate outline data to html tag
    function generateOutlineDataToHTML(data){

      var html_select_option = '';

      for(var i = 0; i < data.length; i++){

          html_select_option += '<option value="' + data[i].id + '">' +
                                      data[i].name +
                                    '</option>';
      }

      html_select_option = '<select class="col-xs-6 col-sm-3" name="position" title="Choose position for this test in the lesson">' +
                                  html_select_option +
                              '</select>';

      return html_select_option;
    }

    // get data from outline
    function getOutlineData(outline_container){

        var outline = outline_container.find('.outline');
        var data = [];

        for(var i = 0; i < outline.length; i++){

            data[i] = {
              'id': outline.eq(i).attr('data-id'),
              'name': outline[i].value
            };
        }

        return data;
    }

    // rebind outline data
    function rebindOutlineData(outline_ids, tests_chosen_container){

        var tests = tests_chosen_container.find('.tests li');
        var test;

        for(var i = 0; i < tests.length; i++){

            test = tests.eq(i);

            // assign new section to the first
            test.children('select').before(generatePositionOtion());

            // remove the old section
            test.children('select').last().remove();

            // assign selected outline in each test
            test.children('select')[0].value = outline_ids[i];
        }
    }

    // after approving on Chosen test, start binding data to outside
    function generateChosenTestToOutside(tests){

        var html = '';
        var p_tag, test, from, test_name;
        var id, outline_id;

        for(var i = 0; i < tests.length; i++){

            p_tag = tests.eq(i).children('p');
            test = p_tag[0].innerText;
            from = p_tag.children('.from')[0].innerText;

            test_name = test.substring(0, test.length - from.length);
            id = tests.eq(i).attr('data-id');
            outline_id = tests.eq(i).attr('data-outline-id');

            html += '<li data-outline-id="' + outline_id + '" data-id="' + id + '">' + test_name + '<span class="from">' + from + '</span></li>';
        }

        return html;
    }

    // delete tests with the asscociative outline
    function deleteAttachedTests(outline_id, test_container){

        var tests = test_container.find('.content li');
        var test;

        for(var i = tests.length - 1; i >= 0; i--){

            test = tests.eq(i);
            if(test.attr('data-outline-id') === outline_id){
                test.remove();
            }
        }
    }
})
