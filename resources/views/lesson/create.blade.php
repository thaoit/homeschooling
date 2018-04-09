@extends('master.master')

@section('content')

  <div class="container-fluid" id="general">

    <div class="form-group">
      <input class="form-control" id="title" type="text" name="title" placeholder="Title here" value="Title here" required>
    </div>
    <div class="form-group">
      <textarea id="intro" class="col-sm-6 col-sm-offset-3 col-xs-12" name="intro" rows="3" placeholder="Intro here"></textarea>
    </div>
    <div class="topics">
      <span>
        Science
        <span class="close-topic">&times</span>
      </span>
      <span>
        Art
        <span class="close-topic">&times</span>
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
      <div class="modal-content">
        <div class="modal-header">
            <div class="topics"></div>
        </div>

        <div class="modal-body">

          <div class="topic-chosen">
            <input class="form-control" type="text" name="topics" placeholder="Typing some topics here">
          </div>
          <div class="topic-hints">

          </div>
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
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/test-hint.css') }}">

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

  #general .topics{
    clear: both;
    margin-bottom: 30px;
  }

  .topics > span{
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 5px;
    margin: 0 3px;
  }

  .topics > span > span{
    cursor: pointer;
  }

  #outline-content{

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

  /* topics */
  .topics .close-topic{
    margin-left: 3px;
    color: #ccc;
  }

  .topics #add-topic{
    font-size: 10px;
    color: #ccc;
  }

  .topic-chosen{
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .topic-chosen > input{
    border: none;
    box-shadow: none;
  }

  .topic-hints{
    border: 1px solid #ccc;
    max-height: 180px;
  }

  .topic-hints > ul{
    margin: 0;
    padding: 10px 5px;
    overflow: auto;
    max-height: 170px;
  }

  .topic-hints > ul >li{
    list-style-type: none;
    padding: 5px;
    cursor: pointer;
  }

  .topic-hints > ul > li:hover{
    background-color: #ccc;
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

    // Remove chosen topic

    $('.topics').on('click', '.close-topic', function(){
        console.log('remove');
        $(this).parent().remove();
    });

    // Add new topic
    $('.topic-hints').hide();

    $('.topic-chosen > input').on('keyup', function(){
      if( $(this).val().length === 0 ){

        $('.topic-hints').hide();
        return true;
      }

        /*$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.get('', function(data){

        });*/

        // data sample
        var data = [
          {
            'id': 1,
            'name': 'Science',
            'num_of_lessons': 0
          },
          {
            'id': 2,
            'name': 'Art',
            'num_of_lessons': 0
          },
          {
            'id': 3,
            'name': 'Film',
            'num_of_lessons': 0
          },
          {
            'id': 4,
            'name': 'Life',
            'num_of_lessons': 0
          }
        ]

        // convert to html
        var hints = "";

        for(var i = 0; i < data.length; i++){

            hints += "<li data-id=" + data[i].id + ">" + data[i].name + "</li>";
        }

        hints = "<ul>" + hints + "</ul>";

        // remove the old and append new to topic topic-hints
        var topic_hints = $('#topic-modal .topic-hints');

        if(topic_hints.children().length > 0){
            topic_hints.children().remove();
        }

        topic_hints.append(hints);

        // show
        $('.topic-hints').show();

    });

    // chosen topic-hints
    $('.topic-hints').on('click', 'ul > li', function(){

        var topic = "<span>" + $(this)[0].textContent +
                    "<span class='close-topic'>&times</span>" +
                    "</span>";

        $('#topic-modal .topics').append(topic);
        $('.topic-hints').hide();
    });

    // get data from modal
    $('#ok').on('click', function(){

        var topics = $('#topic-modal .topics');
        if(topics.children().length > 0){

          for(var i = 0; i < topics.children().length; i++){
            var topic = topics[i].innerHTML;
            $('#add-topic').parent().before(topic);
          }

        }

        topics.children().remove();
        $('#topic-modal .topic-chosen input')[0].value = "";
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
<script>
  $(document).ready(function(){

      $('#summernote').summernote({
          placeholder: 'Add details for each outline',
          height: 280
      });
  });
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

@endsection
