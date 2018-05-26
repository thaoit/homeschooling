@extends('master.master')

@section('content')

<div class="content-page">
  <div class="container group-container">
    <div class="info">
      <div class="head">
        <h4>Wanna find some partners for yours and your children?</h4>
      </div>
      <form class="content">
        <p>Children's age from
          <input class="age-from" type="number" name="age_from" min="1" value="{{ isset($input['age_from']) ? $input['age_from'] : '' }}">
          to
          <input class="age-to" type="number" name="age_to" min="1" value="{{ isset($input['age_to']) ? $input['age_to'] : '' }}">
          <div class="alert-container"></div>
        </p>
        <p>Gender
          <select name="gender">
            @foreach( Config::get('constants.gender') as $gender )
              @if( isset($input['gender']) && $input['gender'] == $gender )
                <option value="{{ $gender }}" selected>{{ $gender }}</option>
              @else
                <option value="{{ $gender }}">{{ $gender }}</option>
              @endif
            @endforeach
          </select>
        </p>
        <div class="favourite-topics hint-chosen-panel">
          <p>Favourite topics</p>

          <div class="chosen-hints">
            @if( isset($topics) )
              @foreach( $topics as $topic )
                <span class="chosen-hint">
                  {{ $topic }}
                  <span class="close-chosen-hint">&times;</span>
                </span>
              @endforeach
            @endif
          </div>
          <div class="typing-hint">
            <input class="form-control" type="text" name="topic-typing-hint" placeholder="Type some topics here">
          </div>
          <div class="hints"></div>

          <p class="message" style="display: none">
            Press <strong>Enter</strong> to add the topic.</em>
          </p>
        </div>
        <p>Family comes from
          <select id="countries" name="countries">
            <option value="All">All</option>
            @foreach( $countries as $country)
              @if( isset($input['countries']) && $input['countries'] == $country['name'] )
                <option value="{{ $country['name'] }}" selected>{{ $country['name'] }}</option>
              @else
                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
              @endif
            @endforeach
          </select>

          <select id="provinces" name="provinces">
            <option value="All">All</option>
            <option value="Ha noi">Ha Noi</option>
            <option value="Da Nang">Da Nang</option>
            <option value="Ho Chi Minh city">Ho Chi Minh city</option>
          </select>
        </p>
        <div>
          <p>Other info</p>
            <textarea class="form-control other-info" rows="4" placeholder="Type some other requirements here" name="other_info">
              @if( isset($input['other_info']) )
                {{ $input['other_info'] }}
              @endif
            </textarea>
        </div>
      </form>
      <div class="foot">
        <button class="btn btn-default search-btn" type="button" name="search" value="search">Search</button>
        <button class="btn btn-default post-btn" type="button" name="post" value="post">Post</button>
      </div>
    </div>

    @if( count($not_own_posts) > 0)
    <div class="post-container not-own-posts">
      <div class="head">
        <h4>Try to find some partners here!</h4>
      </div>
      @foreach( $not_own_posts as $post )
      <div class="post">
        <div class="head">
          <p>From. <a href="{{ action('UserController@profile', $post->user_name) }}">{{ $post->user_name }}</a></p>
          <p>Wanna find partners for his/her children with some requirements</p>
        </div>
        <div class="content">
          <div class="col-xs-12">
            <p class="col-xs-4">Age</p>
            <p class="col-xs-8">
              @if($post->age_from == null && $post->age_to == null)
                Any ages
              @elseif($post->age_from == null)
                <= {{ $post->age_to }} years old
              @elseif($post->age_to == null)
                >= {{ $post->age_from }} years old
              @else
                {{ $post->age_from }} - {{ $post->age_to }} years old
              @endif
            </p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Gender</p>
            <p class="col-xs-8">{{ $post->gender }}</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Favourite topics</p>
            <p class="col-xs-8">
              @if($post->favorite_topics == null)
                Any topics
              @else
                {{ $post->favorite_topics }}
              @endif
            </p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Living in</p>
            <p class="col-xs-8">
              @if( $post->country == 'All' )
                Anywhere
              @elseif( $post->province == 'All' )
                {{ $post->country }}
              @else
                {{ $post->province }}, {{ $post->country }}
              @endif
            </p>
          </div>

          @if( $post->other_info != null)
          <div class="col-xs-12">
            <p class="col-xs-4">Others info</p>
            <p class="col-xs-8">{{ $post->other_info }}</p>
          </div>
          @endif
        </div>
      </div>
      @endforeach
      <!--<div class="col-xs-12 col-sm-6 col-md-3 post">
        <div class="head">
          <p>From. <a href="">Anna Leo</a></p>
          <p>Wanna find partners for his/her 2 children with some requirements</p>
        </div>
        <div class="content">
          <div class="col-xs-12">
            <p class="col-xs-4">Age</p>
            <p class="col-xs-8">5 - 10 years old</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Gender</p>
            <p class="col-xs-8">Girl</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Favourite topics</p>
            <p class="col-xs-8">Science, Music</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Living in</p>
            <p class="col-xs-8">US</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Others</p>
            <p class="col-xs-8">no</p>
          </div>
        </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-3 post">
        <div class="head">
          <p>From. <a href="">Anna Leo</a></p>
          <p>Wanna find partners for his/her 2 children with some requirements</p>
        </div>
        <div class="content">
          <div class="col-xs-12">
            <p class="col-xs-4">Age</p>
            <p class="col-xs-8">5 - 10 years old</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Gender</p>
            <p class="col-xs-8">Girl</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Favourite topics</p>
            <p class="col-xs-8">Science, Music</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Living in</p>
            <p class="col-xs-8">US</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Others</p>
            <p class="col-xs-8">no</p>
          </div>
        </div>
      </div>-->

    </div>
    @endif

    @if( count($own_posts) > 0)
    <div class="post-container own-posts">
      <div class="head">
        <h4>Your posts here!</h4>
      </div>
      @foreach( $own_posts as $post )
      <div class="post" data-id="{{ $post->id }}">
        <div class="head">
          <div class="col-xs-10">
            <p>From. <a href="{{ action('UserController@profile', $post->user_name) }}">{{ $post->user_name }}</a></p>
            <p>Wanna find partners for his/her children with some requirements</p>
          </div>
          <div class="col-xs-2 delete-post-container">
            <button type="button" class="delete-post" title="Delete this post" data-toggle="modal" data-target="#delete-confirmation">&times;</button>
          </div>
        </div>
        <div class="content">
          <div class="col-xs-12">
            <p class="col-xs-4">Age</p>
            <p class="col-xs-8">
              @if($post->age_from == null && $post->age_to == null)
                Any ages
              @elseif($post->age_from == null)
                <= {{ $post->age_to }} years old
              @elseif($post->age_to == null)
                >= {{ $post->age_from }} years old
              @else
                {{ $post->age_from }} - {{ $post->age_to }} years old
              @endif
            </p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Gender</p>
            <p class="col-xs-8">{{ $post->gender }}</p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Favourite topics</p>
            <p class="col-xs-8">
              @if($post->favorite_topics == null)
                Any topics
              @else
                {{ $post->favorite_topics }}
              @endif
            </p>
          </div>
          <div class="col-xs-12">
            <p class="col-xs-4">Living in</p>
            <p class="col-xs-8">
              @if( $post->country == 'All' )
                Anywhere
              @elseif( $post->province == 'All' )
                {{ $post->country }}
              @else
                {{ $post->province }}, {{ $post->country }}
              @endif
            </p>
          </div>

          @if( $post->other_info != null)
          <div class="col-xs-12">
            <p class="col-xs-4">Others info</p>
            <p class="col-xs-8">{{ $post->other_info }}</p>
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    @endif

    <div id="delete-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content hint-chosen-panel">
        <div class="modal-header">
          <h4>Delete Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this post?</p>
          <p>Everyone will unable to see the post anymore?</p>
        </div>

        <div class="modal-footer">
            <button class="btn btn-default delete-confirmation-btn" type="button" name="ok" data-dismiss="modal">OK</button>
            <button class="btn btn-default delete-cancel-btn" type="button" name="cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/hint-chosen-panel.css') }}">
<style>

  .favourite-topics{
    margin-bottom: 15px;
  }


</style>

@endsection

@section('scripts')

<script src="{{ asset('js/hint-chosen-panel.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>

  $(document).ready(function(){

      // init
      var enable_provinces = {{ (isset($input['countries']) && $input['countries'] != 'All') ? 'true' : 'false' }};
      if(!enable_provinces){
          $('.group-container .info #provinces').hide();
      }

      $('.typing-hint > input').on('keyup', function(e){

          var hints = $(this).parent('.typing-hint').siblings('.hints');
          var message = $('.message');

          if(e.key !== "Enter"){

              ajaxSearchAndShowTopicsHints(
                  $(this).val(),
                  hints,
                  message,
                  'Press Enter to add topic',
                  '{{ action('TopicController@search') }}'
              );
          }

      });

      $('.info .post-btn').on('click', function(){

          var info = $(this).parents('.info');
          var checkInput = checkAges( info.find('.age-from'), info.find('.age-to'), info.find('.alert-container') );

          if( checkInput ){

              var form = $(this).parents('.info').find('.content').serialize();
              var other_info = '&other_info=' + $(this).parents('.info').find('.other-info').val();
              var favorite_topic_elements = $('.favourite-topics .chosen-hint');
              var favorite_topics = '';

              for(var i = 0; i < favorite_topic_elements.length; i++){

                  var text = favorite_topic_elements[i].innerText;
                  var close_text = favorite_topic_elements.eq(i).children('.close-chosen-hint')[0].innerText;

                  favorite_topics += text.substr( 0, text.length - close_text.length );

                  if(i < favorite_topic_elements.length - 1){
                      favorite_topics += ', ';
                  }
              }
              favorite_topics = '&favorite_topics=' + favorite_topics;

              url = '{{ action('PartnerPostController@post') }}'

              ajaxPartnerPost(form + other_info + favorite_topics, url);
          }
      });

      $('.info .search-btn').on('click', function(){

          var info = $(this).parents('.info');
          var checkInput = checkAges( info.find('.age-from'), info.find('.age-to'), info.find('.alert-container') );

          if( checkInput ){

              var form = $(this).parents('.info').find('.content').serialize();
              var other_info = '&other_info=' + $(this).parents('.info').find('.other-info').val();
              var favorite_topic_elements = $('.favourite-topics .chosen-hint');
              var favorite_topics = '';

              for(var i = 0; i < favorite_topic_elements.length; i++){

                  var text = favorite_topic_elements[i].innerText;
                  var close_text = favorite_topic_elements.eq(i).children('.close-chosen-hint')[0].innerText;

                  favorite_topics += text.substr( 0, text.length - close_text.length );

                  if(i < favorite_topic_elements.length - 1){
                      favorite_topics += ', ';
                  }
              }
              favorite_topics = '&favorite_topics=' + favorite_topics;

              url = '{{ action('PartnerPostController@search') }}'

              //ajaxPartnerSearch(form + other_info + favorite_topics, url);
              var query = form + other_info + favorite_topics;
              window.location.href = url + '?' + query;
          }
      });

      $('.own-posts .delete-post').on('click', function(){

          var post_id = $(this).parents('.post').attr('data-id');
          var target = $(this).attr('data-target');

          $(target).attr('data-post-id', post_id);
      })

      $('.modal .delete-confirmation-btn').on('click', function(){

          var no_of_posts = $('.own-posts .post').length;

          if(no_of_posts == 1){
              var post_element = $('.own-posts');
          }
          else{
              var post_query = '.own-posts .post[data-id=' + post_id + ']';
              var post_element = $(post_query);
          }

          var post_id = $(this).parents('.modal').attr('data-post-id');
          var url = '{{ action('PartnerPostController@delete') }}';

          ajaxDeletePartnerPost(post_id, post_element, url);
      })

      $('.info #countries').change(function(){

          var country = $(this).val();
          var provinces_element = $(this).parents('.info').find('#provinces');

          if(country === 'All'){
              provinces_element.hide();
          }
          else{
              // data
              var data = [];
              data['country_name'] = country;

              // process urls
              var urls = [];
              urls['get_provinces'] = '{{ action('ProvinceController@getAllByCountry') }}';

              // elements
              var elements = [];
              elements['provinces_element'] = provinces_element;

              // process
              ajaxLoadProvinces(data, elements, urls);
          }

      })

      $('.group-container .info input[type=number]').on('keypress', function(e){

          // only accept positive numbers ( >= 1)
          if( e.key === "-" || e.key === "+" || ($(this).val().length === 0 && e.key === "0")){
              return false;
          }
      })

  });

</script>

@endsection
