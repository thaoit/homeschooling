@extends('master.master')

@section('content')

<div class="container">
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
    <div class="filter-group">
      <button class="filter-control filter-ok" type="button" name="filter_ok" title="Start filter">OK</button>
      <button class="filter-control" type="button" name="filter_cancel" title="Close filter pane" data-dismiss="filter-container">Cancel</button>
      <button class="filter-control filter-clear" type="button" style="display: none">Clear</button>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="lesson-container">

    @foreach($lessons as $lesson)
    <div class="lesson">
      <div class="head">
        <div class="col-xs-12 col-sm-9">
          <h4 class="title"><a href="{{ action('LessonController@view', $lesson['general']->id) }}">{{ $lesson['general']->title }}</a></h4>
          <div class="topics">
            @foreach($lesson['topics'] as $topic)
            <span>{{ $topic->name }}</span>
            @endforeach
          </div>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h4 class="likes">
            <span>{{ $lesson['general']->no_of_love }}</span>
            <button class="like-btn" type="button" name="" title="Like if this is useful!">
              <span class="glyphicon glyphicon-heart-empty"></span>
            </button>
          </h4>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="content">
        <div>
          <p>Outlines</p>
          <ul class="outlines">
            @for( $i = 0; $i < count($lesson['outlines']); $i++ )
            <li><span class="index">Step {{ $i + 1 }} -</span>{{ $lesson['outlines'][$i]->name }}</li>
            @endfor
          </ul>
        </div>
        <div>
          <p>References</p>
          <ul class="references">

            @foreach( Config::get('constants.media_type') as $type )
              @foreach( $lesson['media'][$type] as $media )
                <li class="col-xs-12 col-sm-4 col-md-3">

                @switch($type)

                  @case( Config::get('constants.media_type.image') )
                    <span class="glyphicon glyphicon-picture"></span>
                    @break
                  @case( Config::get('constants.media_type.video') )
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
          <!--<li class="col-xs-12 col-sm-4 col-md-3">

            <span class="glyphicon glyphicon-file"></span>
            <a href="#">$media->origin_name</a>
          </li>-->
          </ul>
        </div>
      </div>
    </div>
    @endforeach
    <!--<div class="lesson">
      <div class="head">
        <div class="col-xs-12 col-sm-9">
          <h4 class="title"><a href="">Animals around the world</a></h4>
          <div class="topics">
            <span>Science</span>
            <span>Art</span>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h4 class="likes">
            <span>921</span>
            <button class="like-btn" type="button" name="" title="Like if this is useful!">
              <span class="glyphicon glyphicon-heart-empty"></span>
            </button>
          </h4>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="content">
        <div>
          <p>Outlines</p>
          <ul class="outlines">
            <li><span class="index">Step 1 -</span>What is the Earth?</li>
            <li><span class="index">Step 2 -</span>Which benefit does the Earth give us?</li>
            <li><span class="index">Step 3 -</span>How can we save the Earth?</li>
            <li><span class="index">Step 4 -</span>Alert yourself!</li>
          </ul>
        </div>
        <div>
          <p>References</p>
          <ul class="references">
            <li class="col-xs-12 col-sm-4 col-md-3">
              <span class="glyphicon glyphicon-file"></span>
              <a href="#">How does the Earth work?</a>
            </li>
            <li class="col-xs-12 col-sm-4 col-md-3">
              <span class="glyphicon glyphicon-file"></span>
              <a href="#">Dig deeper into the Earth</a>
            </li>
          </ul>
        </div>
      </div>
    </div>-->
  </div>

</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/lesson-resource.css') }}">
<link rel="stylesheet" href="{{ asset('css/filter.css') }}">

@endsection

@section('scripts')

<script src="{{ asset('js/filter.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>

  $(document).ready(function(){

      $('.lesson-container').on('click', '.lesson .likes .like-btn', function(){

          var icon = $(this).children('span');

          if(icon.hasClass('glyphicon-heart-empty')){

              icon.removeClass('glyphicon-heart-empty');
              icon.addClass('glyphicon-heart');

              $(this).attr('title', 'Remove this from my favourite lessons');
          }
          else{

              icon.removeClass('glyphicon-heart');
              icon.addClass('glyphicon-heart-empty');

              $(this).attr('title', 'Like if this is useful!');
          }
      })

      $('#filter-lesson .filter-ok').on('click', function(){

          var lesson_container = $('.lesson-container');
          var chosen_topic_elements = $('#filter-lesson input[name="filter_topics"]:checked');
          var chosen_topic_values = [];

          for(var i = 0; i < chosen_topic_elements.length; i++){
              chosen_topic_values.push(chosen_topic_elements.eq(i).val());
          }

          ajaxFilterLessons(
              chosen_topic_values,
              lesson_container,
              '{{ action('LessonController@findLessonsByTopics') }}',
              '{{ action('MediaController@getDefaultTypes') }}',
              '{{ action('MediaController@viewMediaReference', ':name') }}'
          );

          // show button for clearing filter results
          $(this).parents('.filter-container').find('.filter-clear').show();
      })

      $('.filter-container .filter-clear').on('click', function(){

          $(this).hide();
      })
  });

</script>

@endsection
