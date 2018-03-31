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
    <div class="form-group" id="outline-container">
      <p>Outline</p>
      <div class="input-group">
        <span class="input-group-addon step-index">Step 1 - </span>
        <input class="form-control outline" type="text" value="Hi World">
        <span class='input-group-addon close-outline'>&times;</span>
      </div>
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
  </div>

  <!-- Modal -->
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

@endsection


@section('styles')

<!-- summernotes: rich text editor-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

<style media="screen">

  #outline-container{
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
  }

  #outline-container > p{

  }

  #outline-container > .input-group > .input-group-addon{
    color: #ccc;
    background-color: #fff;
    border: none;
  }

  #outline-container > .input-group > input{
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
    max-height: 120px;
  }

  .topic-hints > ul{
    margin: 0;
    padding: 10px 5px;
    overflow: auto;
    max-height: 110px;
  }

  .topic-hints > ul >li{
    list-style-type: none;
    padding: 5px;
  }

  .topic-hints > ul > li:hover{
    background-color: #ccc;
  }

</style>

@endsection


@section('scripts')

<script>
  $(document).ready(function(){

    // Outline
    var step = 2;

    $('#outline-container').on('keypress', '.outline', function(e){

      // pressing Enter or not
      if(e.which == 13 || e.keyCode == 13){
        e.preventDefault();

        var new_outline = "<div class='input-group'>" +
                            "<span class='input-group-addon step-index'>Step " + step + " - </span>" +
                            "<input class='form-control outline' type='text' >" +
                            "<span class='input-group-addon close-outline'>&times;</span>" +
                          "</div>";

        $('#outline-container').append(new_outline);
        $('#outline-container .outline').last().focus();
        step++;
      }
    });

    $('#outline-container').on('click', '.close-outline', function(){
        var num_of_outline = $('#outline-container .outline').length;

        if(num_of_outline > 1){

            var current_outline_index = $(this).parent().index();

            // change name of steps following the current outline
            for(var i = current_outline_index; i < num_of_outline; i++){
              $('#outline-container .step-index')[i].textContent = 'Step ' + i + ' - ';
            }

            // remove the outline and decrease step
            $(this).parent().remove();
            step--;
        }
    })

    // Navigate to the first

    $('#step-nav').attr('data-outline-index', 0);
    $('#step-nav > p > span')[0].textContent = $('#outline-container .outline')[0].value;

    // Navigate next step

    $('#nextstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('#outline-container .outline').length);

        var next_index = (current_outline_index === num_of_outline - 1) ? 0 : current_outline_index + 1;

        $('#step-nav').attr('data-outline-index', next_index);
        $('#step-nav > p > span')[0].textContent = $('#outline-container .outline')[next_index].value;
    });

    // Navigate back step

    $('#backstep').on('click', function(){

        var current_outline_index = parseInt($('#step-nav').attr('data-outline-index'));
        var num_of_outline = parseInt($('#outline-container .outline').length);

        var next_index = (current_outline_index === 0) ? num_of_outline - 1 : current_outline_index - 1;

        $('#step-nav').attr('data-outline-index', next_index);
        $('#step-nav > p > span')[0].textContent = $('#outline-container .outline')[next_index].value;
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
