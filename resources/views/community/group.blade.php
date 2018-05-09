@extends('master.master')

@section('content')

<div class="container group-container">
  <div class="info">
    <div class="head">
      <h4>Wanna find some partners for yours and your children?</h4>
    </div>
    <form class="content">
      <p>Children's age from
        <input class="min_age" type="number" name="min_age">
        to
        <input class="max_age" type="number" name="max_age">
      </p>
      <p>Gender
        <select class="gender" name="gender">
          <option value="All">All</option>
          <option value="Boy">Boy</option>
          <option value="Girl">Girl</option>
          <option value="Others">Others</option>
        </select>
      </p>
      <p>Max number of partners
        <input class="max_no_of_partners" type="number" name="max_no_of_partners" value="1" required>
      </p>
      <div class="favourite-topics hint-chosen-panel">
        <p>Favourite topics</p>

        <div class="chosen-hints">

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
        <select class="countries" name="countries">
          <option value="All">All</option>
          <option value="Gernamy">Germany</option>
          <option value="japan">Japan</option>
          <option value="korean">Korean</option>
          <option value="us">US</option>
          <option value="vietnam">Vietnam</option>
        </select>
        <select class="provinces" name="provinces">
          <option value="All">All</option>
          <option value="hanoi">Ha Noi</option>
          <option value="danang">Da Nang</option>
          <option value="tphcm">TP.Ho Chi Minh</option>
        </select>
      </p>
      <div>
        <p>Other info</p>
          <textarea class="form-control other-info" rows="4" placeholder="Type some other requirements here" name="other_info"></textarea>
      </div>
    </form>
    <div class="foot">
      <button class="btn btn-default search-btn" type="button" name="search" value="search">Search</button>
      <button class="btn btn-default post-btn" type="button" name="post" value="post">Post</button>
    </div>
  </div>

  <div class="post-container">
    <div class="head">
      <h4>Try to find some partners here!</h4>
    </div>
    @foreach( $posts as $post )
    <div class="post">
      <div class="head">
        <p>From. <a href="">{{ $post->user_name }}</a></p>
        <p>Wanna find partners for his/her 2 children with some requirements</p>
      </div>
      <div class="content">
        <div class="col-xs-12">
          <p class="col-xs-4">Age</p>
          <p class="col-xs-8">
            @if($post->age_from == null && $post->age_to == null)
              No limitted
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
          <p class="col-xs-8">{{ $post->address }}</p>
        </div>
        <div class="col-xs-12">
          <p class="col-xs-4">Others</p>
          <p class="col-xs-8">{{ $post->other_info }}</p>
        </div>
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
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/hint-chosen-panel.css') }}">
<style>

  .info, .post-container{
    background-color: #eee;
    padding: 15px;
    margin-bottom: 45px;
  }

  .group-container .head, .group-container .foot{
    text-align: center;
  }

  .group-container .head, .group-container .content{
    margin-bottom: 30px;
  }

  .post-container{
    overflow: auto;
  }

  .post-container .post{
    padding: 0 15px;
    max-width: 500px;
    margin-bottom: 45px;
    margin-left: auto;
    margin-right: auto;
    border-left: 3px solid green;
  }

  .post-container .post .head,
  .post-container .post .content{
    border-bottom: 1px solid #ccc;
    margin-bottom: 15px;
    overflow: auto;
    text-align: left;
  }

  .post .content p:nth-child(2n + 1){
    padding-left: 0;
  }

  .post .content p:nth-child(2n){
    text-align: right;
    padding-right: 0;
  }

  .message{
    font-size: 0.85em;
    margin-top: 20px;
    padding-left: 5px;
    font-style: italic;
    display: none;
  }

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
      });

      $('.info .search-btn').on('click', function(){

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
      });

  });

</script>

@endsection
