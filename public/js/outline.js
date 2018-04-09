$(document).ready(function(){

    // variables
    var step = 2;
    // store outline data in form of select tag
    var outline_select_option='';

    // events

    $('.outline-container').on('keypress', '.outline', function(e){

      // pressing Enter or not
      if(e.which == 13 || e.keyCode == 13){
        e.preventDefault();

        var new_outline = "<div class='input-group'>" +
                            "<span class='input-group-addon step-index'>Step " + step + " - </span>" +
                            "<input class='form-control outline' type='text' >" +
                            "<span class='input-group-addon close-outline'>&times;</span>" +
                          "</div>";

        $('.outline-container').append(new_outline);
        $('.outline-container .outline').last().focus();
        step++;
      }
    });

    $('.outline-container').on('click', '.close-outline', function(){
        var num_of_outline = $('.outline-container .outline').length;

        if(num_of_outline > 1){

            var current_outline_index = $(this).parent().index();

            // change name of steps following the current outline
            for(var i = current_outline_index; i < num_of_outline; i++){
              $('.outline-container .step-index')[i].textContent = 'Step ' + i + ' - ';
            }

            // remove the outline and decrease step
            $(this).parent().remove();
            step--;
        }
    })

    // convert outline data to html tag: select option
    $('.test-modal-btn').on('click', function(){

        var data = getOutlineData($('.outline-container'));
        outline_select_option = generateOutlineDataToHTML(data);

        // bind data to the existed chosen tests
        rebindOutlineData();

    })

    $('.test-hints').on('click', 'ul li', function(){

        var from = $(this).children('.from')[0].innerText;
        var name = $(this)[0].innerText;
        var test_name = name.substring(0, name.length - from.length);

        var chosen_test = generateChosenTest(from, test_name);

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

    function generatePositionOtion(){

        return outline_select_option;
    }

    function generateChosenTest(from, test_name){

        return '<li>' +
                  '<p class="col-xs-12 col-sm-8">' +
                    test_name +
                    '<span class="from">'+ from + '</span>' +
                  '</p>' +
                  generatePositionOtion() +
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
              'id': 1,
              'name': outline[i].value
            };
        }

        return data;
    }

    // rebind outline data
    function rebindOutlineData(){

        var tests = $('.tests-chosen-container .tests li');

        for(var i = 0; i < tests.length; i++){

            // assign new section to the first
            tests.eq(i).children('select').before(generatePositionOtion);

            // remove the old section
            tests.eq(i).children('select').last().remove();
        }
    }
})
