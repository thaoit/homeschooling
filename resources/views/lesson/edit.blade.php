@extends('master.master')

@section('content')

  <div class="content-page">
    <div class="creating-lesson">
    <div class="container-fluid general text-center" data-lesson-id="{{ $lesson['general']->id }}">

      <div class="form-group">
        <input class="form-control title text-center" type="text" name="title" placeholder="Title here" value="{{ $lesson['general']->title }}" required>
      </div>
      <div class="form-group">
        <textarea class="intro text-center" class="col-sm-6 col-sm-offset-3 col-xs-12" name="intro" rows="3" placeholder="Intro here">
          {{ $lesson['general']->intro }}
        </textarea>
      </div>
      <div class="chosen-hints">
        @foreach( $lesson['topics'] as $topic )
        <span class="chosen-hint" data-id="{{ $topic->id }}">
          <span class="name">{{ $topic->name }}</span>
          <span class="close-chosen-hint">&times</span>
        </span>
        @endforeach
        <span>
          Add
          <span class="glyphicon glyphicon-plus" id="add-topic" data-toggle="modal" data-target="#topic-modal" title="Add more topics"></span>
        </span>

      </div>
    </div>

    <div class="col-xs-12 col-md-3">
      <div class="form-group border-wrapper outline-container" data-target="#outline-content" data-control-next="#nextstep">
        <p>Outline</p>

        @for( $i = 0; $i < count($lesson['outlines']); $i++ )
          <div class="input-group">
            <span class="input-group-addon step-index">Step {{ $i + 1 }} - </span>
            <input class="form-control outline" type="text" value="{{ $lesson['outlines'][$i]->name }}" data-id="{{ $i + 1 }}" data-outline-id="{{ $lesson['outlines'][$i]->id }}">
            <span class='input-group-addon close-outline' data-toggle="modal" data-target="#confirmation-modal">&times;</span>
          </div>
        @endfor

      </div>
      <div class="form-group border-wrapper" id="references-container">
        <p>References</p>
        <div class="content">

          @foreach( $lesson['media']['types'] as $media_type )
            @foreach( $media_type as $media )
              @if( isset($media->name) )
                <li data-id="{{ $media->id }}" >
              @else
                <li data-id="{{ $media->id }}" data-type="url">
              @endif
                  <a href="{{ $media->url }}" target="_blank">
                    {{ $media->origin_name }}
                  </a>
                  <span class="close-reference" title="Close this reference">&times;</span>
                </li>
            @endforeach
          @endforeach

        </div>
        <button class="references-modal-btn" type="button" name="" title="Add references" data-toggle="modal" data-target="#references-modal">
          <span class="glyphicon glyphicon-plus"></span>
        </button>
      </div>
      <!--<div class="form-group border-wrapper test-container">
        <p>Attached Tests</p>
        <div class="content">-->
          <!--<li>Test discovery about the Earth
            <span class="from"> - My resource</span>
          </li>
          <li>How do animals sleep in the winter? What is a greate question!
            <span class="from"> - Community</span>
          </li>-->
        <!--</div>
        <button class="test-modal-btn" type="button" name="" title="Add tests" data-toggle="modal" data-target="#test-modal">
          <span class="glyphicon glyphicon-plus"></span>
        </button>
      </div>-->
    </div>

    <div class="col-xs-12 col-md-9">
    <!--<textarea id="outline-content" name="outline-content" rows="8"></textarea>-->
    <div id="step-nav" class="top-style-border-wrapper text-center" data-outline-index=0>
      <p>
      <button class="btn" type="button" id="backstep">Back</button>
      <span>Step here</span>
      <button class="btn" type="button" id="nextstep">Next</button>
      </p>
    </div>
    <div id="outline-content">

      @foreach( $lesson['outlines'] as $outline )
        <div class="summernote"></div>
      @endforeach

    </div>
    <div class="alert-container"></div>
    <div class="form-group" id="func-buttons">
      <a id="preview" href="{{ action('LessonController@view', $lesson['general']->id) }}" target="_blank">
        <button class="btn btn-default" type="submit" name="button">Preview</button>
      </a>
      @if( $lesson['general']->status == Config::get('constants.lesson_status.draft') )
        <button id="save_as_draft" class="btn btn-default chosen-button" type="submit" name="save_as_draft">Save as Draft</button>
        <button id="publish" class="btn btn-default" type="submit" name="publish">Publish</button>
      @else
        <button id="save_as_draft" class="btn btn-default" type="submit" name="save_as_draft">Save as Draft</button>
        <button id="publish" class="btn btn-default chosen-button" type="submit" name="publish">Publish</button>
      @endif
    </div>
  </div>
  </div>
  </div>
  <!-- Topic Modal -->
  <div id="topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content hint-chosen-panel">
        <div class="modal-header">
            <div class="chosen-hints">
              @foreach( $lesson['topics'] as $topic )
              <span class="chosen-hint" data-id="{{ $topic->id }}" style="display: none">
                <span class="name">{{ $topic->name }}</span>
                <span class="close-chosen-hint">&times</span>
              </span>
              @endforeach
            </div>
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
  <!--<div id="test-modal" class="modal fade test-modal" role="dialog">
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
            <ul class="tests">-->
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
            <!--</ul>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default ok-tests" type="button" name="ok" data-dismiss="modal">OK</button>
          <button class="btn btn-default" type="button" name="cancel" data-dismiss="modal">Cancel</button>
      </div>
        </div>
      </div>
    </div>
  </div>-->

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
              <!--<li class="uploaded-ref">All in the Earth.doc</li>
              <li class="uploaded-ref">Who change your life?.pdf</li>-->
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

  .title{
    font-size: 2em;
    font-weight: bold;
    border: none;
  }

  .intro{
    margin-bottom: 30px;
  }

  .general .chosen-hints{
    clear: both;
    margin-bottom: 30px;
  }

  /*step navigation*/
  #step-nav > p{
    overflow: auto;
    margin-bottom: 0;
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

  /* references */

  .uploaded-refs .uploaded-ref{
    cursor: pointer;
    margin-bottom: 10px;
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
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/summernote.js') }}"></script>

<script>

  $(document).ready(function(){

      // set up summernote
      $('.summernote').summernote({
          height: 280
      });

      // hide all summernotes, except the first
      $('.note-editor.note-frame:not(:first)').hide();

      // pass outline contents to summernotes
      var outline_contents = $('.note-editor .note-editable');
      @for( $i = 0; $i < count($lesson['outlines']); $i++)
        @php
          //$filter_content = str_replace("'", "\'", $lesson['outlines'][$i]->content);
        @endphp
        outline_contents.eq('{{ $i }}').empty();
        outline_contents.eq('{{ $i }}').append(`{!! $lesson['outlines'][$i]->content !!}`);
      @endfor

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

      $('#references-container .content').on('click', '.close-reference', function(){

          // store delete references
          var id = $(this).parents('.content li').attr('data-id');
          var is_delete_media_completely = $(this).parents('.content li').attr('data-type');

          if(typeof id !== "undefined"){
              delete_media_refs.push(id);
          }
          if(typeof is_delete_media_completely != "undefined"){
              delete_medias.push(id);
          }

          // remove the reference
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

      // update the title for outline content
      $('.outline-container').on('keyup', '.outline', function(e){

          if(e.key !== "Enter"){

              var editing_outline_index = parseInt( $(this).attr('data-id') ) - 1;
              var current_outline_index = parseInt( $('#step-nav').attr('data-outline-index') );

              if(editing_outline_index === current_outline_index){

                  var title = $(this).val();
                  $('#step-nav > p > span')[0].textContent = title;
              }
          }
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
      $('.general .chosen-hints').on('click', '.close-chosen-hint', function(){

          var topic_id = $(this).parent('.chosen-hint').attr('data-id');

          if(typeof topic_id !== "undefined"){
              delete_topics.push(topic_id);
          }
      })

      // open References modal
      $('.references-modal-btn').on('click', function(){

          ajaxGetMediaReferencesByUser('{{ action('MediaController@getMediaReferencesByUser') }}');
      })

      // actions after closing the modal
      $('#references-modal .references-btn').on('click', function(){

          var references_container = $('#references-container .content');

          var new_media_refs = $(this).parents('#references-modal').find('.new-media-refs');
          var uploaded_refs = $(this).parents('#references-modal').find('.uploaded-refs');
          var url_media_ref = $(this).parents('#references-modal').find('.url-media-ref');

          if(new_media_refs.css('display') !== "none" && new_media_refs.length > 0){

              ajaxStoreAndAssignNewUploadMediaReferences(
                  new_media_refs[0],
                  references_container,
                  '{{ action('MediaController@storeUploadMediaReferences') }}',
                  '{{ action('MediaController@viewMediaReference', 'url') }}'
              );
          }
          else if(uploaded_refs.css('display') !== "none"){

              var uploaded_ref = uploaded_refs.children('.uploaded-ref.selected');
              var uploaded_ref_html = '';

              for(var i = 0; i < uploaded_ref.length; i++){
                  uploaded_ref_html += generateReferenceAfterChosen(
                      uploaded_ref.eq(i).attr('data-id'),
                      uploaded_ref.eq(i).attr('data-path'),
                      uploaded_ref[i].innerText,
                      true,
                      '{{ action('MediaController@viewMediaReference', 'url') }}'
                  )
              }

              references_container.append(uploaded_ref_html);
          }
          else if(url_media_ref.css('display') !== "none"){

              ajaxStoreAndAssignNewUrlMediaReferences(
                  url_media_ref,
                  references_container,
                  '{{ action('MediaController@storeUrlMediaReferences') }}',
                  '{{ action('MediaController@viewMediaReference', 'url') }}'
              );
          }
      })

      // topics
      $('.typing-hint > input').on('keyup', function(e){

        var hints = $(this).parent('.typing-hint').siblings('.hints');
        var message = $('.message');

        if(e.key !== "Enter"){
            ajaxSearchAndShowTopicsHints(
                $(this).val(),
                hints,
                message,
                'To be the first having lesson on this topic! Press Enter to add the topic.',
                '{{ action('TopicController@search') }}'
            );
        }

      });

      // save lesson
      $('#save_as_draft').on('click', function(){

          // request data
          var data = [];
          data['title'] = $('.title').val();
          data['intro'] = $('.intro').val();
          data['is-publish'] = 'false';

          // process url
          var urls = [];
          urls['save-lesson'] = '{{ action('GeneralController@saveAllRelatingLesson') }}';

          // elements
          var elements = [];
          elements['new-outline-elements'] = $('.outline-container .outline:not([data-outline-id])');
          elements['update-outline-elements'] = $('.outline-container .outline[data-outline-id]');
          elements['new-topic-elements'] = $('.general .chosen-hints .chosen-hint:not([data-id])');
          elements['update-topic-elements'] = $('.general .chosen-hints .chosen-hint[data-id]');
          elements['media-reference-elements'] = $('#references-container .content li');
          elements['general-container'] = $('.general');
          elements['main-status-element'] = $(this);
          elements['sub-status-element'] = $('#publish');
          elements['alert-container'] = $('.creating-lesson .alert-container');

          // process
          ajaxSaveAllRelatingLesson(data, elements, urls);
      })

      // publish lesson
      $('#publish').on('click', function(){

          // request data
          var data = [];
          data['title'] = $('.title').val();
          data['intro'] = $('.intro').val();
          data['is-publish'] = 'true';

          // process url
          var urls = [];
          urls['save-lesson'] = '{{ action('GeneralController@saveAllRelatingLesson') }}';

          // elements
          var elements = [];
          elements['new-outline-elements'] = $('.outline-container .outline:not([data-outline-id])');
          elements['update-outline-elements'] = $('.outline-container .outline[data-outline-id]');
          elements['new-topic-elements'] = $('.general .chosen-hints .chosen-hint:not([data-id])');
          elements['update-topic-elements'] = $('.general .chosen-hints .chosen-hint[data-id]');
          elements['media-reference-elements'] = $('#references-container .content li');
          elements['general-container'] = $('.general');
          elements['main-status-element'] = $(this);
          elements['sub-status-element'] = $('#save_as_draft');
          elements['alert-container'] = $('.creating-lesson .alert-container');

          // process
          ajaxSaveAllRelatingLesson(data, elements, urls);
      })

  });
</script>

@endsection
