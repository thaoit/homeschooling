@extends('master.master')


@section('content')

<div class="container">


  <h3>Your journal</h3>
  <div class="col-xs-12 form-group">
    <form action="" method="get" class="col-xs-12 col-sm-10 search-container">
      <div class="input-group">
        <input class="form-control" type="text" name="search" placeholder="Search here">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-search"></span>
        </span>
      </div>
    </form>

    <div class="col-xs-12 col-sm-2 filter-create-container">
      <button type="button" name="filter" title="Filter lesson" class="filter-btn" data-toggle="filter-container" data-target="#filter-lesson">
        <span class="glyphicon glyphicon-filter"></span>
      </button>
      <button type="button" name="creating_lesson" title="Create new lesson" class="btn btn-default" data-toggle="modal" data-target="#lesson-modal">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
    </div>
  </div>

  <div id="filter-lesson" class="filter-container">
    <div class="filter-group">
      <p class="filter-name">Topics</p>
      <div class="filter-options">
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="science">
          <span class="checkmark"></span>
          Science
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="art">
          <span class="checkmark"></span>
          Art
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="skill">
          <span class="checkmark"></span>
          Skill
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="ecosystem">
          <span class="checkmark"></span>
          Ecosystem
        </label>
      </div>
    </div>
    <div class="filter-group">
      <p class="filter-name">Time</p>
      <div class="filter-options">
        <label class="col-xs-12 col-sm-3 col-md-2 radio-option">
          <input type="radio" name="time" value="lastly">
          <span class="checkmark"></span>
          Lastly
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 radio-option">
          <input type="radio" name="time" value="oldest">
          <span class="checkmark"></span>
          Oldest
        </label>
      </div>
    </div>
    <div class="filter-group">
      <button class="filter-control" type="button" name="filter_ok" title="Start filter">OK</button>
      <button class="filter-control" type="button" name="filter_cancel" title="Close filter pane" data-dismiss="filter-container">Cancel</button>
    </div>
  </div>

  <div class="lesson-road">
    @for($i = 0; $i < count($lessons); $i++)
    <div class="lesson" data-id="{{ $lessons[$i]->id }}">

      <div class="top">
        <div class="viewed">

          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="{{ action('LessonController@view', $lessons[$i]->id) }}" class="btn btn-default control-view" title="View">
          {{ count($lessons) - $i }}
        </a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="{{ action('LessonController@edit', $lessons[$i]->id) }}">Edit</a></p>
                <p><a href="" class="delete-btn" data-toggle="modal" data-target="#delete-confirmation">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>{{ $lessons[$i]->title }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endfor
    <!--<div>

      <div class="top">
        <div class="viewed" style="display: none;">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View" >14</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">

          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">15</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">16</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed" style="display: none;">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">14</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">

          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">15</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">16</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed" style="display: none;">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">14</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">

          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">15</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>

      <div class="top">
        <div class="viewed">
          <img src="{{ asset('img/flag-filled.png') }}" alt="Viewed">
        </div>
        <div class="not-viewed" style="display: none;">
          <p>New</p>
          <img src="{{ asset('img/arrow-up.png') }}" alt="New">
        </div>
      </div>

      <div class="lesson-progress">
        <div>
          <div class="col-xs-6 one"></div>
          <div class="col-xs-6 two"></div>
        </div>
        <div>
          <div class="col-xs-6 three"></div>
          <div class="col-xs-6 four"></div>
        </div>
      </div>

      <div class="bottom">
        <a href="" class="btn btn-default control-view" title="View">16</a>
        <div class="flipper-container">
          <div class="flipper">
            <div class="control-container">
              <p>Have fun with this!</p>
              <div class="control-others">
                <p><a href="">Edit</a></p>
                <p><a href="">Delete</a></p>
              </div>
            </div>
            <div class="content">
              <p>Research on dilemma with two dangers in ECA, South 13th, Africa</p>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </div>

  <div id="lesson-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <form action="" method="post">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <input class="form-control" id="title" type="text" name="title" placeholder="Title here" required>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" type="text" name="intro" placeholder="Intro here">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="topic" placeholder="Topic here" required>
            </div>

            <div class="form-group" id="outline-container">
              <p>Outline</p>
              <div class="input-group">
                <span class="input-group-addon step-index">Step 1 - </span>
                <input class="form-control outline" type="text">
                <span class='input-group-addon close-outline'>&times;</span>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <div class="">
              <input class="btn btn-default" type="submit" name="submit" value="OK">
              <input class="btn btn-default" type="button" name="cancel" value="Cancel" data-dismiss="modal">
            </div>
          </div>

        </form>
      </div>

    </div>
  </div>

  <div id="delete-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this lesson?</p>
          <p>All the content and attached files will be also delete?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default delete-confirmation-btn" type="button" name=""><a>OK</a></button>
          <button class="btn btn-default delete-cancel-btn" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/roadlist.css') }}">
  <link rel="stylesheet" href="{{ asset('css/search.css') }}">
  <link rel="stylesheet" href="{{ asset('css/filter.css') }}">

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

    .modal-header > #title{
      font-size: 2em;
      font-weight: bold;
      border: none;
      box-shadow: none;
      border-bottom: 1px solid #ccc;
    }
    /* search + others*/
    .container{
      text-align: center;
    }

    h3{
      margin-bottom: 30px;
    }

    .search-container{
      margin-bottom: 10px;
    }

    button a{
      color: #000;
    }

    button a:hover, button a:active{
      color: #000;
      text-decoration: none;
    }

    /* Add - Filter */
    .filter-create-container{

    }

    .filter-create-container button{
      border: none;
    }

  </style>
@endsection

@section('scripts')
  <script src="{{ asset('js/filter.js') }}"></script>

  <script>
    $(document).ready(function(){
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

      // lesson-road

      /*$('.lesson-road .bottom .control-view').on('mouseenter', function(){

          $(this).siblings('.control-container').show();
      })

      $('.lesson-road .bottom .control-container').on('mouseleave', function(){

          $(this).hide();
      })*/


      $('.delete-btn').on('click', function(){

          var delete_lesson_id = $(this).parents('.lesson').attr('data-id');

          var url = '{{ action('LessonController@delete', 'id') }}';
          url = url.replace('id', delete_lesson_id);

          $('.delete-confirmation-btn a').attr('href', url);
      });

    });
  </script>

@endsection
