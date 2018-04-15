@extends('master.master')

@section('content')

<div id="lesson-view" class="slide-container">

  <button class="slide-back" type="button" name="" data-target="#lesson-view" title="Back">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </button>
  <button class="slide-next" type="button" name="" data-target="#lesson-view" title="Next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </button>

  <div class="title slide">
    <h3 class="no_steps">4 Steps</h3>
    <h3 class="prefix">to</h3>
    <h3 class="name">Discovery about the Earth</h3>
  </div>
  <div class="intro slide">
    <h4><strong># Introduction</strong></h4>
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <i>
      <p>We are living on the Earth. How much do you know about the Earth?</p>
      <p>Are you concerned about the welfare of the earth? Do you want to do what you can to save it? With bad news about global warming, dying oceans, and endangered animals flooding us on a daily basis, it's hard to know where to start.</p>
      </i>
    </div>
  </div>
  <div class="slide">
    <h4><strong># Outlines</strong></h4>
    <ul class="outlines col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
      <li><span class="index">Step 1 -</span>What is the Earth?</li>
      <li><span class="index">Step 2 -</span>Which benefit does the Earth give us?</li>
      <li><span class="index">Step 3 -</span>How can we save the Earth?</li>
      <li><span class="index">Step 4 -</span>Alert yourself!</li>
    </ul>
  </div>

  <div class="details slide">
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
  </div>

  <div class="details slide">
    <div class="outline-index">
      <h5><strong># Step 2 / 2</strong></h5>
    </div>

    <div class="outline">
      <h4 class="title">
        <strong>Which benefit does the Earth give us?</strong>
      </h4>
      <div class="contents slide-container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <div class="slide">
          <p>Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago.</p>
          <p> About <b>71%</b> of Earth's surface is covered with water, mostly by oceans.[29] The remaining 29% is land consisting of continents and islands that together have many lakes, rivers and other sources of water that contribute to the hydrosphere.</p>
          <p>Landsat, a joint program of the USGS and NASA, has been observing the Earth continuously from 1972 through the present day. Today the Landsat satellites image the entire Earth's surface at a 30-meter resolution about once every two weeks, including multispectral and thermal data.</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/effect.css') }}">
<link rel="stylesheet" href="{{ asset('css/lesson-view.css') }}">

@endsection

@section('scripts')

<script src="{{ asset('js/effect.js') }}"></script>

@endsection