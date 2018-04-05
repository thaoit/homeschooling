@extends('master.master')

@section('content')

  <div class="container">
    <div class="form-group">
      <input class="form-control" id="title" type="text" name="title" placeholder="Test name here">
    </div>

    <div class="col-xs-12 question-container">
      <div class="question">
        <div class="content content-border-top">
          <div class="head">
            <h4><strong>1</strong>
              <span class="glyphicon glyphicon-remove"></span>
            </h4>
          </div>
          <div class="title">
            <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
          </div>
          <div class="suggestion">

          </div>
          <div class="foot">
            <p>Default correct answer is A. When test is shown, all suggestions will be randomize.</p>
          </div>
        </div>

        <div class="edge edge-bottom-convex">
          <div class="svg-container svg-container-bottom-convex">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25">
              <g>
               <path stroke="#000" id="svg_9" d="m6.166686,-0.66664c0,0 6.333331,9.154778 0.333333,11.267419c-5.999998,2.112641 -12.666663,14.084274 8.333331,13.732167c20.999993,-0.352107 15.666662,-12.675847 8.333331,-13.027954c-7.333331,-0.352107 -6.666665,-8.098458 -1,-11.619526" fill-opacity="null" stroke-opacity="null" fill="#fff"/>
              </g>
            </svg>
          </div>
        </div>
      </div>

      <div class="question">
        <div class="edge edge-top-concave">
          <div class="svg-container svg-container-top-concave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25">
              <g>
               <path stroke="#000" d="m6.166686,-0.66664c0,0 6.333331,9.154778 0.333333,11.267419c-5.999998,2.112641 -12.666663,14.084274 8.333331,13.732167c20.999993,-0.352107 15.666662,-12.675847 8.333331,-13.027954c-7.333331,-0.352107 -6.666665,-8.098458 -1,-11.619526" fill-opacity="null" stroke-opacity="null" fill="#fff"/>
              </g>
            </svg>
          </div>
        </div>
        <div class="content">
          <p>Try question</p>
        </div>
        <div class="edge edge-bottom-concave">
          <div class="svg-container svg-container-bottom-concave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25">
              <g>
               <path stroke="#000" d="m6.166686,-0.66664c0,0 6.333331,9.154778 0.333333,11.267419c-5.999998,2.112641 -12.666663,14.084274 8.333331,13.732167c20.999993,-0.352107 15.666662,-12.675847 8.333331,-13.027954c-7.333331,-0.352107 -6.666665,-8.098458 -1,-11.619526" fill-opacity="null" stroke-opacity="null" fill="#fff"/>
              </g>
            </svg>
          </div>
        </div>
      </div>


    </div>

    <div class="add-container">
      <button id="add-btn" type="button" name="" title="Choose kind of question">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
      <div class="question-option">
        <button id="hidden-word" type="button" name="">Hidden Word</button>
        <button id="multichoice" type="button" name="">Multichoice</button>
        <button id="true-false" type="button" name="">True / False</button>
        <button id="matching" type="button" name="">Matching</button>
      </div>
    </div>
  </div>

@endsection

@section('styles')

  <link rel="stylesheet" href="{{ asset('css/question.css') }}">

  <style>

  #title{
    font-size: 2em;
    font-weight: bold;
    border: none;
    box-shadow: none;
    text-align: center;
    border-radius: 0;
  }


  </style>

@endsection

@section('scripts')

<script src="{{ asset('js/question.js') }}"></script>

@endsection
