@extends('master.master')

@section('content')

<div class="content-page">
<div class="container">
  <div class="col-xs-12 form-group">

    <div class="col-xs-12 col-sm-10 search-container">
      <form action="{{ action('LessonController@searchNameInResource') }}" method="get">
          <input class="form-control" type="text" name="q" value="{{ isset($search) ? $search : '' }}" placeholder="Search here" required>
      </form>
      <input class="search-input" type="hidden" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}">
    </div>

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
      </div>
    </div>

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

  <div class="clearfix"></div>

  <div class="lesson-container">

    @foreach($lessons as $lesson)
    <div class="lesson" data-id="{{ $lesson['general']->id }}">
      <div class="head">

        <div class="col-xs-12 col-sm-9">
          <h4 class="title"><a href="{{ action('LessonController@view', $lesson['general']->permalink) }}">{{ $lesson['general']->title }}</a></h4>
          <p>By <a href="{{ action('UserController@profile', $lesson['author']->username) }}">{{ $lesson['author']->username }}</a></p>
          <div class="topics">
            @foreach($lesson['topics'] as $topic)
            <span>{{ $topic->name }}</span>
            @endforeach
          </div>
        </div>

        <div class="col-xs-12 col-sm-3">
          <h4 class="likes">
            <span class="number">{{ $lesson['general']->no_of_love }}</span>
            @if( in_array( $lesson['general']->id, $lesson['favorite_lesson_ids'] ) )
              <button class="like-btn" type="button" name="" title="Remove this from my favourite lessons">
                  <span class="glyphicon glyphicon-heart"></span>
              </button>
            @else
              <button class="like-btn" type="button" name="" title="Like if this is useful!">
                  <span class="glyphicon glyphicon-heart-empty"></span>
              </button>
            @endif
          </h4>
        </div>

        <div class="clearfix"></div>
      </div>

      <div class="alert-container"></div>

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
          <!--<li class="col-xs-12 col-sm-4 col-md-3">

            <span class="glyphicon glyphicon-file"></span>
            <a href="#">$media->origin_name</a>
          </li>-->
          </ul>
        </div>
        @endif
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

  <div class="text-center">
    <button class="border-wrapper more-lesson-btn" type="button" name="">More</button>
  </div>
</div>
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/filter.css') }}">

@endsection

@section('scripts')

<script src="{{ asset('js/filter.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>

  $(document).ready(function(){

      $('.alert .close').on('click', function(){

          $(this).parent('.alert').hide();
      });

      // Process like or unlike lesson
      // only like / unlike 1 times
      $('.lesson-container').on('click', '.lesson .likes .like-btn', function(){

          var icon = $(this).children('span');
          var lesson = $(this).parents('.lesson');
          var lesson_id = lesson.attr('data-id');

          var elements = [];
          elements['icon'] = icon;
          elements['number'] = $(this).parents('.likes').find('.number')[0];
          elements['like-btn'] = $(this);
          elements['alert-container'] = lesson.find('.alert-container');

          if(icon.hasClass('glyphicon-heart-empty')){

              var url = '{{ action('LessonController@loveLesson') }}';

              ajaxLoveLesson(lesson_id, url, elements);
          }
          else{

              var url = '{{ action('LessonController@unloveLesson') }}';

              ajaxUnloveLesson(lesson_id, url, elements);
          }
      })

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
          data['is_from_resource'] = true;

          // elements for completing filtering
          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['filter_button'] = $(this);
          elements['filter_clear_button'] = $(this).siblings('.filter-clear');
          elements['more_lessons_button'] = $('.more-lesson-btn');

          // url for processing
          var urls = [];
          urls['find_lessons_by_topics'] = '{{ action('LessonController@filterLessonsByTopics') }}';
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}';
          urls['view_profile'] = '{{ action('UserController@profile', ':username') }}';

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
          data['is_from_resource'] = true;

          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['filter_button'] = $(this).siblings('.filter-ok');
          elements['filter_clear_button'] = $(this);
          elements['more_lessons_button'] = $('.more-lesson-btn');

          var urls = [];
          urls['clear_filter_result'] = '{{ action('LessonController@filterLessonsByName') }}';
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}';
          urls['view_profile'] = '{{ action('UserController@profile', ':username') }}';

          ajaxClearFilterLessons(
              data,
              urls,
              elements
          );
      })

      $('.more-lesson-btn').on('click', function(){

          var chosen_topic_elements = $('#filter-lesson input[name="filter_topics"]:checked');
          var chosen_topic_values = [];

          // set chosen topics
          for(var i = 0; i < chosen_topic_elements.length; i++){
              chosen_topic_values.push(chosen_topic_elements.eq(i).val());
          }

          // request data
          var data = [];
          data['chosen_topic_values'] = chosen_topic_values;
          data['search_text'] = $('.search-container .search-input').val();
          data['offset'] = $('.lesson-container .lesson').length;
          data['is_from_resource'] = true;
          data['last_status'] = $(this)[0].innerText;

          // elements
          var elements = [];
          elements['lesson_container'] = $('.lesson-container');
          elements['status_element'] = $(this);

          // urls
          var urls = [];
          urls['load'] = '{{ action('LessonController@loadMoreLessons') }}'
          urls['default_media_types'] = '{{ action('MediaController@getDefaultTypes') }}';
          urls['view_media_reference'] = '{{ action('MediaController@viewMediaReference', ':name') }}';
          urls['view_lesson'] = '{{ action('LessonController@view', ':id') }}'
          urls['view_profile'] = '{{ action('UserController@profile', ':username') }}';

          // process
          ajaxLoadMoreLessons(data, urls, elements);
      })
  });

</script>

@endsection
