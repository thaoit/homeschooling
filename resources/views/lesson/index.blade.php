@extends('master.master')


@section('content')

<div class="content-page">
  <div class="container">

  <h3 class="text-center">Your journal</h3>
  <div class="col-xs-12 form-group">
    <!--<form action="" method="get" class="col-xs-12 col-sm-10 search-container">
      <div class="input-group">
        <input class="form-control" type="text" name="search" placeholder="Search here">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-search"></span>
        </span>
      </div>
    </form>-->

    <div class="col-xs-12 col-sm-10 search-container">
      <form action="{{ action('LessonController@searchNameInLesson') }}" method="get" class="">
          <input class="form-control" type="text" name="q" value="{{ isset($search) ? $search : '' }}" placeholder="Search here" required>
      </form>
      <input class="search-input" type="hidden" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}">
    </div>

    <div class="col-xs-12 col-sm-2 filter-create-container">
      <button type="button" name="filter" title="Filter lesson" class="filter-btn" data-toggle="filter-container" data-target="#filter-lesson">
        <span class="glyphicon glyphicon-filter"></span>
      </button>
      <button type="button" name="creating_lesson" title="Create new lesson" class="btn">
        <a href="{{ action('LessonController@create') }}"><span class="glyphicon glyphicon-plus"></span></a>
      </button>
    </div>
  </div>

  <div id="filter-lesson" class="filter-container">
    <div class="filter-group">
      <p class="filter-name">Topics</p>
      <div class="filter-options">
        @foreach( $topics as $topic )
        <label class="col-xs-6 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="filter_topics" value="{{ $topic->name }}">
          <span class="checkmark"></span>
          {{ $topic->name }}
        </label>
        @endforeach
        <!--<label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
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
        </label>-->
      </div>
    </div>
    <!--<div class="filter-group">
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
    </div>-->

    <div class="alert alert-danger alert-dismissible" style="display: none">
      <a href="#" class="close" aria-label="close">&times;</a>
        You need to choose at least 1 topic for fiter!
    </div>

    <div class="filter-group text-center">
      <button class="filter-control filter-ok" type="button" name="filter_ok" title="Start filter">OK</button>
      <button class="filter-control" type="button" name="filter_cancel" title="Close filter pane" data-dismiss="filter-container">Cancel</button>
      <button class="filter-control filter-clear" type="button" title="Clear filter results" style="display: none">Clear</button>
    </div>
  </div>

  <!--<div class="lesson-road">
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
    </div>
  </div>-->

  <!--<div id="lesson-modal" class="modal fade" role="dialog">
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
  </div>-->

  <div class="clearfix"></div>

  <div class="lesson-container">

    @foreach($lessons as $lesson)
    <div class="lesson" data-id="{{ $lesson['general']->id }}">
      <div class="head">
        <div class="col-xs-10">
          <h4 class="title"><a href="{{ action('LessonController@view', $lesson['general']->id) }}">{{ $lesson['general']->title }}</a></h4>
          <div class="topics">
            @foreach($lesson['topics'] as $topic)
            <span>{{ $topic->name }}</span>
            @endforeach
          </div>
        </div>
        @if( Auth::user()->role != Config::get('constants.role.child') )
        <div class="col-xs-2 control-container">
          <button type="button">
            <a href="{{ action('LessonController@edit', $lesson['general']->id) }}"  title="Edit this lesson"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button class="delete-btn" type="button" data-toggle="modal" data-target="#delete-confirmation" title="Delete this lesson">
            &times;
          </button>
        </div>
        @endif
        <div class="clearfix"></div>
      </div>
      <div class="content">
        @if( count($lesson['outlines']) > 0 )
        <div>
          <p>Outlines</p>
          <ul class="outlines">
            @for( $i = 0; $i < count($lesson['outlines']); $i++ )
            <li><span class="index">Step {{ $i + 1 }} -</span>{{ $lesson['outlines'][$i]->name }}</li>
            @endfor
          </ul>
        </div>
        @endif
        @if( $lesson['media']['num_of_media'] > 0 )
        <div>
          <p>References</p>
          <ul class="references">

            @foreach( Config::get('constants.media_type') as $type )
              @foreach( $lesson['media']['types'][$type] as $media )
                <li class="col-xs-12 col-sm-4 col-md-3">

                @switch($type)

                  @case( Config::get('constants.media_type.image') )
                    <span class="glyphicon glyphicon-picture"></span>
                    @break
                  @case( Config::get('constants.media_type.audio_video') )
                    <span class="glyphicon glyphicon-film"></span>
                    @break
                  @case( Config::get('constants.media_type.document') )
                    <span class="glyphicon glyphicon-file"></span>
                    @break
                  @default
                    <span class="glyphicon glyphicon-question-sign"></span>

                @endswitch

                @if( $media->name == null )
                    <a target="_blank" href="{{ $media->url }}">
                      {{$media->origin_name}}
                    </a>
                @else
                  <a target="_blank" href="{{ action('MediaController@viewMediaReference', $media->name) }}">
                    {{$media->origin_name}}
                  </a>
                @endif
                </li>
              @endforeach
            @endforeach
          </ul>
        </div>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <div class="text-center">
    <button class="border-wrapper more-lesson-btn" type="button" name="">More</button>
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
</div>

@endsection

@section('styles')
  <!--<link rel="stylesheet" href="{{ asset('css/roadlist.css') }}">
  <link rel="stylesheet" href="{{ asset('css/search.css') }}">-->
  <link rel="stylesheet" href="{{ asset('css/filter.css') }}">

  <style media="screen">

    h3{
      margin-bottom: 30px;
    }

    .lesson .control-container .delete-btn{
      font-size: 1.5em;
    }

  </style>
@endsection

@section('scripts')
  <script src="{{ asset('js/filter.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  <script>
    $(document).ready(function(){
      /*var step = 2;

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
      })*/

      // lesson-road

      /*$('.lesson-road .bottom .control-view').on('mouseenter', function(){

          $(this).siblings('.control-container').show();
      })

      $('.lesson-road .bottom .control-container').on('mouseleave', function(){

          $(this).hide();
      })*/


      $('.lesson-container').on('click', '.lesson .delete-btn', function(){

          var delete_lesson_id = $(this).parents('.lesson').attr('data-id');

          var url = '{{ action('LessonController@delete', 'id') }}';
          url = url.replace('id', delete_lesson_id);

          $('.delete-confirmation-btn a').attr('href', url);
      });

      $('.alert .close').on('click', function(){

          $(this).parent('.alert').hide();
      });

      // Start to filter lessons by current search and chosen topics
      $('#filter-lesson .filter-ok').on('click', function(){

          var chosen_topic_elements = $('#filter-lesson input[name="filter_topics"]:checked');
          var chosen_topic_values = [];

          // Check number of chosen topics
          if(chosen_topic_elements.length == 0){
              $('.alert').show();
              return;
          }

          // set chosen topics
          for(var i = 0; i < chosen_topic_elements.length; i++){
              chosen_topic_values.push(chosen_topic_elements.eq(i).val());
          }

          // data for filtering
          var data = [];
          data['chosen_topic_values'] = chosen_topic_values;
          data['search_text'] = $('.search-container .search-input').val();
          data['is_from_resource'] = false;

          // elements for completing filtering
          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['filter_button'] = $(this);
          elements['filter_clear_button'] = $(this).siblings('.filter-clear');

          // url for processing
          var urls = [];
          urls['find_lessons_by_topics'] = '{{ action('LessonController@filterLessonsByTopics') }}';
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}'
          urls['edit_lesson'] = '{{ action('LessonController@edit', ':id') }}';

          // call function filter
          ajaxFilterLessons(
              data,
              urls,
              elements
          );
      })

      // Start to clear the last filter results
      $('.filter-container .filter-clear').on('click', function(){

          // data for filterting
          var data = [];
          data['search_text'] = $('.search-container .search-input').val();
          data['is_from_resource'] = false;

          // elements
          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['filter_button'] = $(this).siblings('.filter-ok');
          elements['filter_clear_button'] = $(this);

          // urls
          var urls = [];
          urls['clear_filter_result'] = '{{ action('LessonController@filterLessonsByName') }}';
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}';
          urls['edit_lesson'] = '{{ action('LessonController@edit', ':id') }}';

          // process
          ajaxClearFilterLessons(
              data,
              urls,
              elements
          );
      })

      $('.more-lesson-btn').on('click', function(){

          // request data
          var data = [];
          data['offset'] = $('.lesson-container .lesson').length;
          data['is_from_resource'] = false;
          data['last_status'] = $(this)[0].innerText;

          // elements
          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['status_element'] = $(this);

          // urls
          var urls = [];
          urls['load'] = '{{ action('LessonController@loadMoreFromLesson') }}'
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}'
          urls['edit_lesson'] = '{{ action('LessonController@edit', ':id') }}';

          // process
          ajaxLoadMoreFromLesson(data, urls, elements);
      })

    });
  </script>

@endsection
