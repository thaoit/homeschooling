@extends('master.master')

@section('content')
<div class="controls">
  <button class="slide-back" type="button" name="" data-target="#lesson-view">Back</button>
  <button class="slide-next" type="button" name="" data-target="#lesson-view">Next</button>
</div>
<div id="lesson-view" class="slide-container">

  <div class="title slide">
    <h3 class="no_steps">4 Steps</h3>
    <h3 class="prefix">to</h3>
    <h3 class="name">Discovery about the Earth</h3>
  </div>
  <div class="intro slide">
    <p>We are living on the Earth.</p>
    <p>How much do you know about the Earth?</p>
  </div>
  <ul class="outlines slide">
    <li><span class="index">Step 1</span>What is the Earth?</li>
    <li><span class="index">Step 2</span>Which benefit does the Earth give us?</li>
  </ul>

  <div class="details slide">
    <div class="outline-index">
      <p><span class="index">Step 1</span> / 2</p>
    </div>

    <div class="outline">
      <div class="title">
        What is the Earth?
      </div>
      <div class="contents slide-container">
        <p class="slide">Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago.</p>
        <p class="slide"> About <b>71%</b> of Earth's surface is covered with water, mostly by oceans.[29] The remaining 29% is land consisting of continents and islands that together have many lakes, rivers and other sources of water that contribute to the hydrosphere.</p>
        <p class="slide"><img style="width: 379px;" src="https://qph.fs.quoracdn.net/main-qimg-425be0e2d545276fe61c7b39addf2b2b-c"></p>
        <p class="slide"><iframe frameborder="0" src="//www.youtube.com/embed/fHyi_2ezUmw" width="640" height="360" class="note-video-clip"></iframe></p>
        <div class="tests slide">
          <a href="#">Try a test before moving on</a>
        </div>
      </div>
      <div class="progress-completation">
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/effect.css') }}">

@endsection

@section('scripts')

<script src="{{ asset('js/effect.js') }}"></script>

@endsection
