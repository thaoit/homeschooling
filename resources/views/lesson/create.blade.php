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
      <!--<span>
        Science
        <span class="close-chosen-hint">&times</span>
      </span>
      <span>
        Art
        <span class="close-chosen-hint">&times</span>
      </span>-->

      <span>
        Add
        <span class="glyphicon glyphicon-plus" id="add-topic" data-toggle="modal" data-target="#topic-modal" title="Add more topics"></span>
      </span>

    </div>
  </div>

  <div class="col-xs-12 col-md-3">
    <div class="form-group border outline-container" data-target="#outline-content" data-control-next="#nextstep">
      <p>Outline</p>
      <div class="input-group">
        <span class="input-group-addon step-index">Step 1 - </span>
        <input class="form-control outline" type="text" value="Hi World" data-id="1">
        <span class='input-group-addon close-outline' data-toggle="modal" data-target="#confirmation-modal">&times;</span>
      </div>
    </div>
    <div class="form-group border" id="references-container">
      <p>References</p>
      <div class="content">
        <!--<li data-path="" data-origin-name="" title="Close this reference">Zoom_in.png<span class="close-reference">&times;</span></li>
        <li data-path="" data-origin-name="" title="Close this reference">wrox-professional-java-development-with-the-spring-framework.pdf<span class="close-reference">&times;</span></li>-->
      </div>
      <button class="references-modal-btn" type="button" name="" title="Add references" data-toggle="modal" data-target="#references-modal">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
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
    <div id="outline-content">
      <div id="summernote">

      </div>
    </div>

    <div class="form-group" id="func-buttons">
      <button id="preview" class="btn btn-default" type="submit" name="button">Preview</button>
      <button id="save_as_draft" class="btn btn-default" type="submit" name="save_as_draft">Save as Draft</button>
      <button id="publish" class="btn btn-default" type="submit" name="publish">Publish</button>
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
          <button class="btn btn-default cancel-btn" type="button" name="" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div id="references-modal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Choose 1 kind to add new media reference</h4>
        </div>
        <ul class="modal-body option-container">
          <li class="option">
            <p class="option-name">URL</p>
            <form class="option-content url-media-ref">
              <input class="form-control" type="text" name="url" placeholder="Paste URL here">
            </form>
          </li>
          <li class="option">
            <p class="option-name">Upload new reference</p>
            <form class="option-content new-media-refs" method="post">
              {{ csrf_field() }}
              <input class="" type="file" multiple name="new-media-refs[]" value="Upload">
            </form>
          </li>
          <li class="option">
            <p class="option-name">Your existed uploaded references</p>
            <ul class="option-content uploaded-refs">
              <li class="uploaded-ref">All in the Earth.doc</li>
              <li class="uploaded-ref">Who change your life?.pdf</li>
            </ul>

          </li>
        </ul>
        <div class="modal-footer">
          <button class="btn btn-default references-btn" type="button" name="" data-dismiss="modal">OK</button>
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
  .option-container{
    list-style: none;
  }

  .option-container .option{
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
  }

  .option-container .option .option-name{
    cursor: pointer;
    padding: 10px;
    margin-bottom: 0;
  }

  .option-container .option .option-name:hover{
    background-color: #ccc;
    color: #fff;
  }

  .option-container .option .option-content{
    display: none;
    margin-top: 15px;
  }

  .uploaded-refs .uploaded-ref{
    cursor: pointer;
    margin-bottom: 10px;
  }

  .option-name-clicked{
    background-color: #ccc;
    color: #fff;
  }

  .selected{
    font-weight: bold;
  }

  .close-reference{
    float: right;
    padding: 0 12px;
    color: #ccc;
    cursor: pointer;
  }

  .content li{
    margin-bottom: 10px;
  }

  #references-container .content li .name{
    cursor: pointer;
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

  .test-container button,
  #references-container button{
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

    var delete_outlines = [];
    var delete_topics = [];

    setupAjax();


    // Navigate to the first

    $('#step-nav').attr('data-outline-index', 0);
    $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[0].value;

    // Navigate next step

    $('#nextstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('.outline-container .outline').length);

        var next_index = (current_outline_index >= num_of_outline - 1) ? 0 : current_outline_index + 1;

        $('#step-nav').attr('data-outline-index', next_index);
        $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[next_index].value;

        // show the next outline content and hide the current
        var outline_content = $('#outline-content').children('.note-editor.note-frame');
        outline_content.eq(current_outline_index).hide();
        outline_content.eq(next_index).show();
    });

    // Navigate back step

    $('#backstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('.outline-container .outline').length);

        var prev_index = (current_outline_index <= 0) ? num_of_outline - 1 : current_outline_index - 1;

        $('#step-nav').attr('data-outline-index', prev_index);
        $('#step-nav > p > span')[0].textContent = $('.outline-container .outline')[prev_index].value;

        // show the next outline content and hide the current
        var outline_content = $('#outline-content').children('.note-editor.note-frame');
        outline_content.eq(current_outline_index).hide();
        outline_content.eq(prev_index).show();
    });

    // kind of adding references
    $('.option-container .option .option-name').on('click', function(){

        var parent = $(this).parent();

        parent.children().show();
        parent.siblings().children('.option-content').hide();

        $(this).addClass('option-name-clicked');
        parent.siblings().children('.option-name').removeClass('option-name-clicked');
    })

    // marked as choose this references
    $('.uploaded-refs').on('click', '.uploaded-ref', function(){

        $(this).toggleClass('selected');
    })

    // actions after closing the modal
    $('#references-modal .references-btn').on('click', function(){

        var references_container = $('#references-container .content');

        var new_media_refs = $(this).parents('#references-modal').find('.new-media-refs');
        var uploaded_refs = $(this).parents('#references-modal').find('.uploaded-refs');
        var url_media_ref = $(this).parents('#references-modal').find('.url-media-ref');

        if(new_media_refs.css('display') !== "none" && new_media_refs.length > 0){

            storeAndAssignNewUploadMediaReferences(new_media_refs[0], references_container);
        }
        else if(uploaded_refs.css('display') !== "none"){

            var uploaded_ref = uploaded_refs.children('.uploaded-ref.selected');
            var uploaded_ref_html = '';

            for(var i = 0; i < uploaded_ref.length; i++){
                uploaded_ref_html += generateReferenceAfterChosen(
                    uploaded_ref.eq(i).attr('data-id'),
                    uploaded_ref.eq(i).attr('data-path'),
                    uploaded_ref[i].innerText,
                    true
                )
            }

            references_container.append(uploaded_ref_html);
        }
        else if(url_media_ref.css('display') !== "none"){

            storeAndAssignNewUrlMediaReferences(url_media_ref, references_container);
        }
    })

    // open References modal
    $('.references-modal-btn').on('click', function(){
        // get current user id
        $user_id = 1;
        // load uploaded references by current user
        $.ajax({

            type: 'get',
            url:'{{ action('MediaController@getMediaReferencesByUser') }}',
            data: {
                'user_id': $user_id
            },
            success: function(data){

                var html_data = generateUploadReferencesBeforeChosen(data);

                $('#references-modal .uploaded-refs').children().remove();
                $('#references-modal .uploaded-refs').append(html_data);
            },
            error: function(data){
                console.log(data);
            }
        });
    })

    function storeAndAssignNewUploadMediaReferences(new_media_refs, references_container){

        var formData = new FormData(new_media_refs);
        formData.append('user_id', 1);

        $.ajax({
            type: 'post',
            url: '{{ action('MediaController@storeUploadMediaReferences') }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){

                var html_data = generateReferencesAfterChosen(data);
                references_container.append(html_data);

            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function storeAndAssignNewUrlMediaReferences(url_media_ref, references_container){

        var url = url_media_ref.children('input').val();
        var html_data = generateReferenceAfterChosen(
            '',
            url,
            url.substr(url.lastIndexOf('/') + 1),
            false
        );

        references_container.append(html_data);

        /*$.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            type: 'post',
            url: '{{ action('MediaController@storeUrlMediaReferences') }}',
            data: {
                url: url_media_ref.children('input').val(),
                user_id: 1
            },
            success: function(data){

                var html_data = generateReferenceAfterChosen(data.id, data.path, data.origin_name, false);
                references_container.append(html_data);
            },
            error: function(data){
              console.log(data);
            }
        });*/
    }

    $('#references-container .content').on('click', '.close-reference', function(){

        $(this).parent().remove();
    })

    $('#references-container .content').on('click', 'li .name', function(){

        //var link = " action('MediaController@viewMediaReference', 'url')";
        //link = link.replace('url', $(this).parent().attr('data-path'));


        /*$.ajax({

            type: 'get',
            url: " action('MediaController@viewMediaReference') ",
            data: {
                url: $(this).parent().attr('data-path')
            },
            success: function(data){
              console.log(data);
            },
            error: function(data){
              console.log(data);
            }
        });*/
        //window.open('https://www.youtube.com/watch?v=Ou6aFBiNwV8', '_blank');
    })

    function generateUploadReferencesBeforeChosen(data){

        var uploaded_refs = '';
        for(var i = 0; i < data.length; i++){

            uploaded_refs +=  '<li class="uploaded-ref" data-id=' + data[i].id + ' data-path="' + data[i].url + '" >' +
                                  data[i].origin_name +
                              '</li>';
        }

        return uploaded_refs;
    }

    function generateReferencesAfterChosen(data){

        var references = ''
        for(var i = 0; i < data.length; i++){

            references += generateReferenceAfterChosen(data[i].id, data[i].path, data[i].origin_name, true);
        }

        return references;
    }

    function generateReferenceAfterChosen(id, path, origin_name, isUploaded){

        if(isUploaded){

            var href = "{{ action('MediaController@viewMediaReference', 'url') }}";
            var name = path.substr(path.lastIndexOf('/') + 1);

            href = href.replace('url', name);

            var link =  '<a href="' + href + '" target="_blank">' +
                          origin_name +
                        '</a>';
        }
        else{
            var link =  '<a href="' + path + '">'+
                          origin_name +
                        '</a>';
        }

        var data_id = '';
        if(id.length > 0){
            data_id = 'data-id="' + id + '"';
        }

        return '<li ' + data_id + ' data-path="' + path + '" >' +
                  link +
                  '<span class="close-reference" title="Close this reference">&times;</span>' +
                '</li>';

        /*return '<li data-id=' + id + ' data-path="' + path + '" >' +
                  '<span class="name">' + origin_name + '</span>' +
                  '<span class="close-reference" title="Close this reference">&times;</span>' +
                '</li>';*/
    }

    // topics
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
          var new_topic = generateHint(hint, null);
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
            },
            error: function(data){
                console.log(data);
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

        var chosen_hints = $('#topic-modal .chosen-hints .chosen-hint').filter(function(){
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


    // create edit content of each outline
    $('.outline-container').on('keypress', '.outline', function(e){

        if(e.key === "Enter"){

            // create new content with new outline
            $('#outline-content').append("<div></div>");
            var new_content = $('#outline-content').children().last();

            new_content.summernote({
                placeholder: 'Add details for each outline',
                height: 280
            });

            new_content.next().hide();
        }
    })

    // save lesson
    $('#save_as_draft').on('click', function(){

        saveGeneralLesson(false);
    })

    // publish lesson
    $('#publish').on('click', function(){

        saveGeneralLesson(true);
    })

    // save object of deleted outlines
    $('.outline-container').on('click', '.close-outline', function(){

       var no_of_outlines = $(this).parents('.outline-container').find('.outline').length;

       if(no_of_outlines > 1){
            delete_outlines.push($(this).siblings('.outline'));
        }
    })

    $('.confirmation-modal .delete-btn').on('click', function(){

        var latest_outline = delete_outlines.pop();
        if(typeof latest_outline === "undefined"){
            return true;
        }

        var outline_id = latest_outline.attr('data-outline-id');

        // save the deleted outline id that has been saved in db
        if(typeof outline_id !== "undefined" && outline_id.length > 0){
            delete_outlines.push(outline_id);
        }
    })

    // remove the latest object
    $('.confirmation-modal .cancel-btn').on('click', function(){

        delete_outlines.pop();
    })

    // save the deleted topics which is existed in db
    $('#general .chosen-hints').on('click', '.close-chosen-hint', function(){

        var topic_id = $(this).parent('.chosen-hint').attr('data-id');

        if(typeof topic_id !== "undefined"){
            delete_topics.push(topic_id);
        }
    })

    function saveGeneralLesson(is_publish){

        var lesson_id = $('#general').attr('data-lesson-id');
        var url;
        var isNew = true;

        // check lesson is added or updated
        if(typeof lesson_id === 'undefined'){
            url = '{{ action('LessonController@store') }}';
        }
        else{
            isNew =false;
            url = '{{ action('LessonController@update') }}';
        }

        $.ajax({

            type: 'post',
            url: url,
            data:{
                'id' :        lesson_id,
                'title':      $('#title').val(),
                'intro':      $('#intro').val(),
                'author_id':  1,
                'is_publish': is_publish
            },
            success: function(data){

                if(isNew && typeof data['id'] !== "undefined"){
                    lesson_id = data['id'];
                    $('#general').attr('data-lesson-id', lesson_id);
                }

                if(is_publish){

                    $('#save_as_draft').hide();
                    $('#publish')[0].innerText = "Save";
                }

                saveOutlines(lesson_id);
                saveTopics(lesson_id);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function saveOutlines(lesson_id){

        var new_outlines = $('.outline-container .outline:not([data-outline-id])');
        var update_outlines = $('.outline-container .outline[data-outline-id]');
        var new_contents = getArrayOfObjFromOutlineContents(new_outlines, lesson_id);
        var update_contents = getArrayOfObjFromOutlineContents(update_outlines, lesson_id);

        $.ajax({

            type: 'post',
            url: '{{ action('OutlineController@doStoreUpdateDelete') }}',
            data: {
                new: new_contents,
                update: update_contents,
                delete: delete_outlines
            },
            success: function(data){

                if(data['success'] == true){

                    // update new outlines id
                    var new_outlines_id = data['new_outlines_id'];
                    for(var i = 0; i < new_outlines_id.length; i++){
                        new_outlines.attr('data-outline-id', new_outlines_id[i]);
                    }

                    // remove the deleted outlines
                    delete_outlines = [];
                }
                else{
                    alert('There are errors!');
                }
            },
            error: function(data){
                console.log(data);
            }
        })
    }

    function getArrayOfObjFromOutlineContents(outline_elements, lesson_id){

        var contents = [];
        for(var i = 0; i < outline_elements.length; i++){

            contents.push(getObjFromOutlineContent(outline_elements.eq(i), lesson_id));
        }

        return contents;
    }

    function getObjFromOutlineContent(outline_element, lesson_id){

        var outline_id = outline_element.attr('data-outline-id');
        var outline_name = outline_element.val();
        var index = parseInt(outline_element.attr('data-id')) - 1;
        var inner_html = $('#outline-content').find('.note-editor .note-editable')[index].innerHTML;

        return {
            id: outline_id,
            name: outline_name,
            content: inner_html,
            lesson_id: lesson_id
        };
    }

    function saveTopics(lesson_id){

        var new_topic_elements = $('#general .chosen-hints .chosen-hint:not([data-id])');
        var update_topic_elements = $('#general .chosen-hints .chosen-hint[data-id]');
        var new_topics = getArrayOfObjFromTopics(new_topic_elements);
        var update_topics = getArrayOfObjFromTopics(update_topic_elements);

        $.ajax({

            type: 'post',
            url: '{{ action('TopicController@doStoreUpdateDelete') }}',
            data:{
                new: new_topics,
                update: update_topics,
                delete: delete_topics,
                lesson_id: lesson_id
            },
            success: function(data){

                if(data['success'] == true){

                  var new_topics_id = data['new_topics_id'];
                  for(var i = 0; i < new_topics_id.length; i++){
                      new_topic_elements.attr('data-id', new_topics_id[i]);
                  }

                  // remove the deleted topics
                  delete_topics = [];
                }
                else{
                    alert('There are errors!');
                }
            },
            error: function(data){
                console.log(data);
            }
        });

    }

    function getArrayOfObjFromTopics(topic_elements){

        var topics = [];

        for(var i = 0; i < topic_elements.length; i++){
            topics.push(getObjFromTopic( topic_elements.eq(i) ));
        }

        return topics;
    }

    function getObjFromTopic(topic_element){

        var id = topic_element.attr('data-id');

        var name = topic_element[0].innerText;
        var close_name = topic_element.children('.close-chosen-hint')[0].innerText;
        var name = name.substr(0, name.length - close_name.length);

        return {
          id: id,
          name: name
        }
    }

    function setupAjax(){

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

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
