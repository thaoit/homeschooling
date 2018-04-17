@extends('master.master')

@section('content')

  <div class="container-fluid" id="general">

    <div class="form-group">
      <input class="form-control" id="title" type="text" name="title" placeholder="Title here" value="Title here" required>
    </div>
    <div class="form-group">
      <textarea id="intro" class="col-sm-6 col-sm-offset-3 col-xs-12" name="intro" rows="3" placeholder="Intro here"></textarea>
    </div>
    <div class="chosen-hints">
      <span>
        Science
        <span class="close-chosen-hint">&times</span>
      </span>
      <span>
        Art
        <span class="close-chosen-hint">&times</span>
      </span>

      <span>
        Add
        <span class="glyphicon glyphicon-plus" id="add-topic" data-toggle="modal" data-target="#topic-modal"></span>
      </span>

    </div>
  </div>

  <div class="col-xs-12 col-md-3">
    <div class="form-group border outline-container">
      <p>Outline</p>
      <div class="input-group">
        <span class="input-group-addon step-index">Step 1 - </span>
        <input class="form-control outline" type="text" value="Hi World" data-id="1">
        <span class='input-group-addon close-outline' data-toggle="modal" data-target="#confirmation-modal">&times;</span>
      </div>
    </div>
    <div class="form-group border" id="references-container">
      <p>References</p>
      <textarea name="references" rows="4"></textarea>
    </div>
    <div class="form-group border test-container">
      <p>Attached Tests</p>
      <div class="content">
        <!--<li>Test discovery about the Earth
          <span class="from"> - My resource</span>
        </li>
        <li>How do animals sleep in the winter? What is a greate question!
          <span class="from"> - Community</span>
        </li>-->
      </div>
      <button class="test-modal-btn" type="button" name="" title="Add tests" data-toggle="modal" data-target="#test-modal">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
    </div>
  </div>

  <div class="col-xs-12 col-md-9">
    <!--<textarea id="outline-content" name="outline-content" rows="8"></textarea>-->
    <div id="step-nav" data-outline-index=0>
      <p>
      <button class="btn btn-default" type="button" id="backstep">Back</button>
      <span>Step here</span>
      <button class="btn btn-default" type="button" id="nextstep">Next</button>
      </p>
    </div>
    <div id="summernote">

    </div>
    <div class="form-group" id="func-buttons">
      <button class="btn btn-default" type="submit" name="button">Preview</button>
      <button class="btn btn-default" type="submit" name="save_as_draft">Save as Draft</button>
      <button class="btn btn-default" type="submit" name="publish">Publish</button>
    </div>
  </div>

  <!-- Topic Modal -->
  <div id="topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content hint-chosen-panel">
        <div class="modal-header">
            <div class="chosen-hints"></div>
        </div>

        <div class="modal-body">

          <div class="typing-hint">
            <input class="form-control" type="text" name="chosen-hints" placeholder="Typing some topics here">
          </div>
          <div class="hints">

          </div>

          <p class="message">
            <em>To be the first having lesson on this topic!
            Press <strong>Enter</strong> to add the topic.</em>
          </p>
        </div>

        <div class="modal-footer">
            <button id="ok" class="btn btn-default" type="button" name="ok" data-dismiss="modal">OK</button>
            <button class="btn btn-default" type="button" name="cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Test Modal -->
  <div id="test-modal" class="modal fade test-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Tests</h4>
        </div>
        <div class="modal-body">
          <div class="test-chosen">
            <input class="form-control" type="text" name="" placeholder="Typing some tests here">
          </div>
          <div class="test-hints">
            <ul>
              <li data-id="1">
                Test discovery about the Earth
                <span class="from"> - Your resource</span>
              </li>
              <li data-id="2">
                Test discovery about the Earth
                <span class="from"> - Your resource</span>
              </li>
              <li data-id="3">
                How do animals sleep in the winter? What is a greate question!
                <span class="from"> - MBC. Key</span>
              </li>
              <li data-id="4">
                How do animals sleep in the winter? What is a greate question!
                <span class="from"> - MBC. Key</span>
              </li>
            </ul>
          </div>
          <div class="tests-chosen-container">
            <h4>Your chosen</h4>
            <ul class="tests">
              <!--<li>
                <p class="col-xs-12 col-sm-8">Test discovery about the Earth</p>
                <select class="col-xs-6 col-sm-3" name="position" title="Choose position for this test in the lesson">
                  <option value="before_1">Before step 1</option>
                  <option value="after_1">After step 1</option>
                  <option value="after_2">After step 2</option>
                  <option value="after_3">After step 3</option>
                </select>
                <button class="col-xs-6 col-sm-1 close-test" type="button" name="" title="Remove this test">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </li>
              <li>
                <p class="col-xs-12 col-sm-8">How do animals sleep in the winter? What is a greate question!</p>
                <select class="col-xs-6 col-sm-3" name="position" title="Choose position for this test in the lesson">
                  <option value="before_1">Before step 1</option>
                  <option value="after_1">After step 1</option>
                  <option value="after_2">After step 2</option>
                  <option value="after_3">After step 3</option>
                </select>
                <button class="col-xs-6 col-sm-1 close-test" type="button" name="" title="Remove this test">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </li>-->
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default ok-tests" type="button" name="ok" data-dismiss="modal">OK</button>
          <button class="btn btn-default" type="button" name="cancel" data-dismiss="modal">Cancel</button>
      </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete confirmation -->
  <div id="confirmation-modal" class="modal fade confirmation-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this section?</p>
          <p>All the content and attached tests will be also deleted?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default delete-btn" type="button" name="" data-dismiss="modal">OK</button>
          <button class="btn btn-default" type="button" name="" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

@endsection


@section('styles')

<!-- summernotes: rich text editor-->
<!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">-->
<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('css/test-hint.css') }}">
<link rel="stylesheet" href="{{ asset('css/hint-chosen-panel.css') }}">

<style media="screen">

  .outline-container > .input-group > .input-group-addon{
    color: #ccc;
    background-color: #fff;
    border: none;
  }

  .outline-container > .input-group > input{
    border: none;
    box-shadow: none;
    border-bottom: 1px solid #ccc;
  }


  #general{
    text-align: center;
  }

  #title{
    font-size: 2em;
    font-weight: bold;
    border: none;
    box-shadow: none;
    text-align: center;
    border-radius: 0;
  }

  #intro{
    border: none;
    box-shadow: none;
    text-align: center;
    border-radius: 0;
    margin-bottom: 30px;
    resize: vertical;
  }

  #general .chosen-hints{
    clear: both;
    margin-bottom: 30px;
  }

  /*step navigation*/

  #step-nav{
    border: 1px solid #ccc;

    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    text-align: center;
  }

  #step-nav > p > button{
    border: none;
  }

  #step-nav > p > button:first-child{
    float: left;
  }

  #step-nav > p > button:last-child{
    float:right;
  }

  .chosen-hints #add-topic{
    font-size: 10px;
    color: #ccc;
    cursor: pointer;
  }

  .message{
    font-size: 0.85em;
    margin-top: 20px;
    padding-left: 5px;
    font-style: italic;
    display: none;
  }
  /* references */

  #references-container > textarea{
    border: none;
    width: 100%;
    resize: vertical;
  }

  /* */
  #func-buttons{
    float: right;
  }

  .border{
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
  }

  .test-container button{
    background-color: #fff;
    border: none;
    margin: 0 auto;
    display: block;
    font-size: 0.8em;
  }

  .test-container .content{
    margin-bottom: 15px;
  }

  /* tests */


</style>

@endsection


@section('scripts')

<script src="{{ asset('js/outline.js') }}"></script>
<script src="{{ asset('js/hint-chosen-panel.js' )}}"></script>

<script>
  $(document).ready(function(){
    //outline


    // Navigate to the first

    $('#step-nav').attr('data-outline-index', 0);
    $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[0].value;

    // Navigate next step

    $('#nextstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('.outline-container .outline').length);

        var next_index = (current_outline_index === num_of_outline - 1) ? 0 : current_outline_index + 1;

        $('#step-nav').attr('data-outline-index', next_index);
        $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[next_index].value;
    });

    // Navigate back step

    $('#backstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('.outline-container .outline').length);

        var next_index = (current_outline_index === 0) ? num_of_outline - 1 : current_outline_index - 1;

        $('#step-nav').attr('data-outline-index', next_index);
        $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[next_index].value;
    });


    $('.typing-hint > input').on('keyup', function(e){

      var hints = $(this).parent('.typing-hint').siblings('.hints');
      var message = $('.message');

      // check empty text input
      if( $(this).val().length === 0 ){

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
          var new_topic = generateHint(hint, false);
          chosen_hints_container.append(new_topic);

          // hide message and empty the input after adding new chosen topic
          message.hide();
          $(this).val('');
      }
      else{
          searchAndShowTopicsHints($(this).val(), hints, message);
      }

    });

    function searchAndShowTopicsHints(search_text, hints_container, message){

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '{{ action('TopicController@search') }}',
            data: {
                  'name': search_text
            },
            success: function(data){
                // remove the old hints
                if(hints_container.children().length > 0){
                    hints_container.children().remove();
                }

                // if has data returned, create and show data
                // if not, hide hint container and inform user
                if(data.length > 0){
                  generateTopicHints(data, hints_container);

                  hints_container.show();
                  message.hide();
                }
                else{
                  hints_container.hide();
                  message[0].innerText = 'To be the first having lesson on this topic! Press Enter to add the topic.';
                  message.show();
                }
            }
        });
    }

    function generateTopicHints(data, hints_container){
      // convert to html
      var hints = "";

      for(var i = 0; i < data.length; i++){

          hints += "<li data-id=" + data[i].id + ">" + data[i].name + "</li>";
      }

      hints = "<ul>" + hints + "</ul>";

      hints_container.append(hints);
    }

    // get data from modal
    $('#ok').on('click', function(){

        var chosen_hints = $('#topic-modal .chosen-hints > span').filter(function(){
            return $(this).css('display') !== 'none'
        });

        // remove the old hints
        //$('#add-topic').parent().siblings().remove();

        if(chosen_hints.length > 0){

          for(var i = 0; i < chosen_hints.length; i++){

            var topic = chosen_hints[i].outerHTML;

            // add the new hints
            $('#add-topic').parent().before(topic);
          }

        }

        //chosen_hints.children().remove();
        // hide all chosen hints after appeding
        chosen_hints.hide();

        $('#topic-modal .typing-hint input')[0].value = "";
    });


  });
</script>

<!-- nicedit: rich text editor
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

<script type="text/javascript">
//<![CDATA[
    bkLib.onDomLoaded(function() {
      nicEditors.editors.push(
        new nicEditor().panelInstance(
            document.getElementById('outline-content')
        )
      );
    });
  //]]>
</script>-->

<!-- summernotes: rich text editor -->

<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>-->
<script src="{{ asset('js/summernote.js') }}"></script>
<script>
  $(document).ready(function(){

      $('#summernote').summernote({
          placeholder: 'Add details for each outline',
          height: 280
      });
  });
</script>

@endsection
