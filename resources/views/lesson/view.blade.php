@extends('master.master')

@section('content')

<div class="content-page">
  <div id="lesson-view" class="slide-container">

    <button class="slide-back" type="button" name="" data-target="#lesson-view" title="Back">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </button>
    <button class="slide-next" type="button" name="" data-target="#lesson-view" title="Next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </button>

    <div class="title slide">
      <h3 class="no_steps">{{ count( $lesson['outlines'] ) }} Steps</h3>
      <h3 class="prefix">to</h3>
      <h3 class="name col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">{{ $lesson['general']->title }}</h3>
      <h5 style="margin-top: 150px"> By. {{ $lesson['author']->username }}</h5>
    </div>

    @if( $lesson['general']->intro != null )
    <div class="intro slide">
      <h4><strong># Introduction</strong></h4>
      <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <i>
        <!--<p>We are living on the Earth. How much do you know about the Earth?</p>
        <p>Are you concerned about the welfare of the earth? Do you want to do what you can to save it? With bad news about global warming, dying oceans, and endangered animals flooding us on a daily basis, it's hard to know where to start.</p>-->
        <p>{{ $lesson['general']->intro }}</p>
        </i>
      </div>
    </div>
    @endif

    <div class="slide">
      <h4><strong># Outlines</strong></h4>
      <ul class="outlines col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
        @for($i = 0; $i < count($lesson['outlines']); $i++)
          <li><span class="index">Step {{ $i + 1 }} -</span>{{ $lesson['outlines'][$i]->name }}</li>
        @endfor
      </ul>
    </div>

    <!--<div class="details slide">
      <div class="outline-index">
        <h5><strong># Step 1 / 2</strong></h5>
      </div>

      <div class="outline">
        <h4 class="title">
          <strong>What is the Earth?</strong>
        </h4>
        <div class="contents slide-container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
          <div class="slide">
            <p>Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago.</p>
            <p>
              <img style="width: 379px;" src="https://qph.fs.quoracdn.net/main-qimg-425be0e2d545276fe61c7b39addf2b2b-c">
            </p>
          </div>
          <div class="slide">
            <p> About <b>71%</b> of Earth's surface is covered with water, mostly by oceans.[29] The remaining 29% is land consisting of continents and islands that together have many lakes, rivers and other sources of water that contribute to the hydrosphere.</p>
            <p>
              <span class="video-container">
                <iframe frameborder="0" src="//www.youtube.com/embed/fHyi_2ezUmw" width="640" height="360" class="video"></iframe>
              </span>
            </p>
          </div>
          <div class="slide">
            <div class="tests">
              <a href="#">Try a test before moving on</a>
            </div>
          </div>
        </div>
      </div>
    </div>-->

    @for($i = 0; $i < count( $lesson['outlines'] ); $i++)

    <div class="details slide">
      <div class="outline-index">
        <h5><strong># Step {{ $i + 1 }} / {{ count( $lesson['outlines'] ) }}</strong></h5>
      </div>

      <div class="outline">
        <h4 class="title">
          <strong>{{ $lesson['outlines'][$i]->name }}</strong>
        </h4>
        <div class="contents slide-container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
          <!--<div class="slide">
            <p>Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago.</p>
            <p>
              <img style="width: 379px;" src="https://qph.fs.quoracdn.net/main-qimg-425be0e2d545276fe61c7b39addf2b2b-c">
            </p>
          </div>
          <div class="slide">
            <p> About <b>71%</b> of Earth's surface is covered with water, mostly by oceans.[29] The remaining 29% is land consisting of continents and islands that together have many lakes, rivers and other sources of water that contribute to the hydrosphere.</p>
            <p>
              <span class="video-container">
                <iframe frameborder="0" src="//www.youtube.com/embed/fHyi_2ezUmw" width="640" height="360" class="video"></iframe>
              </span>
            </p>
          </div>-->

          @foreach( $lesson['split_outline_contents'][$i] as $slide_content )
            <div class="slide">
              {!! $slide_content  !!}
            </div>
          @endforeach

          <!--Test slide-->
          <!--<div class="slide">
            <div class="tests">
              <a href="#">Try a test before moving on</a>
            </div>
          </div>-->
        </div>
      </div>
    </div>

    @endfor

    @if( $lesson['media']['num_of_media'] > 0 )
    <div class="references slide">
      <h4><strong>References</strong></h4>

      <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
      @foreach(Config::get('constants.media_type') as $type)

        @if( count( $lesson['media']['types'][$type] ) )
        <h5>{{ $type }}</h5>

        <ul>
          @foreach( $lesson['media']['types'][$type] as $media )
            @if( $media->name == null )
              <li>
                <a target="_blank" href="{{ $media->url }}">
                  {{$media->origin_name}}
                </a>
              </li>
            @else
            <li>
              <a target="_blank" href="{{ action('MediaController@viewMediaReference', $media->name) }}">
                {{$media->origin_name}}
              </a>
            </li>
            @endif
          @endforeach
        </ul>
        @endif

      @endforeach
      </div>

    </div>
    @endif
  </div>
</div>

@endsection

@section('styles')

<style>

  #lesson-view{
    margin: 30px 0;
  }

  #lesson-view > div{
    padding: 15px 30px;
  }

  ul{
    list-style: none;
  }

  .title .no_steps{
    font-weight: 800
  }

  .title .prefix{
    font-size: 1.2em;
    font-weight: 600;
  }

  .title .name{
    font-size: 2.2em;
    font-weight: 800;
  }

  .intro{
    text-align: justify;
  }

  .outlines > li{
    margin-bottom: 15px;
  }

  .references ul{
    padding-bottom: 25px;
    margin-bottom: 25px;
    border-bottom: 1px solid #eee;
  }

</style>

@endsection

@section('scripts')

<script src="{{ asset('js/effect.js') }}"></script>
<script>
  $('.slide-container .slide img').css('width', '100%');
</script>

@endsection
