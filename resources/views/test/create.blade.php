@extends('master.master')

@section('content')

  <div class="container">
    <div class="form-group">
      <input class="form-control" id="title" type="text" name="title" placeholder="Test name here">
    </div>

    <div class="col-xs-12 question-container create-mode">
      <!--<div class="question question-multichoice">
        <div class="content content-border-top">
          <div class="head">
            <h4><strong>1</strong>
              <span class="glyphicon glyphicon-remove"></span>
            </h4>
          </div>
          <div class="title">
            <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
          </div>
          <div class="suggestion-container">
            <div class="col-xs-12 col-sm-6">
              <p>
                <span class="signal">A.</span>
                <input class="suggestion" type="text" name="" value="">
                <button class="close-suggestion" title="Remove this" type="button" name="">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <p>
                <span class="signal">B.</span>
                <input class="suggestion" type="text" name="" value="">
                <button class="close-suggestion" title="Remove this" type="button" name="">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <p>
                <span class="signal">C.</span>
                <input class="suggestion" type="text" name="" value="">
                <button class="close-suggestion" title="Remove this" type="button" name="">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </p>
            </div>
          </div>
          <div class="foot">
            <button class="add-multichoice" type="button" name="" title="Add 1 more suggestion">
              <span class="glyphicon glyphicon-plus"></span>
            </button>
            <p>Default correct answer is A. When test is shown, suggestion's positions will be changed randomly.</p>
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

      <div class="question question-true-false">
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
          <div class="head">
            <h4><strong>2</strong>
              <span class="glyphicon glyphicon-remove"></span>
            </h4>
          </div>
          <div class="title">
            <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
          </div>
          <div class="suggestion-container">
            <div class="col-xs-12 col-sm-6">
              <p>
                <span>A. </span>
                <span class="suggestion">True</span>
              </p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <p>
                <span>B. </span>
                <span class="suggestion">False</span>
              </p>
            </div>
          </div>
          <div class="foot">
            <button class="switch-true-false" type="button" name="" title="Switch correct answer">
              <span class="glyphicon glyphicon-refresh"></span>
            </button>
            <p>Default correct answer is A. When test is shown, suggestion's positions will be changed randomly.</p>
          </div>
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

      <div class="question question-matching">
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
          <div class="head">
            <h4><strong>2</strong>
              <span class="glyphicon glyphicon-remove"></span>
            </h4>
          </div>
          <div class="title">
            <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
          </div>
          <div class="suggestion-container">
            <div>
                <div class="col-xs-12">
                  <span class="signal">A. </span>
                  <button class="close-suggestion" title="Remove this matching" type="button" name="">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                  <div class="clearfix"></div>
                </div>
                <div class="col-xs-6">
                  <textarea class="suggestion" name="" rows="3"></textarea>
                </div>
                <div class="col-xs-6">
                  <textarea class="suggestion" name="" rows="3"></textarea>
                </div>
            </div>
            <div>
                <div class="col-xs-12">
                  <span class="signal">B. </span>
                  <button class="close-suggestion" title="Remove this matching" type="button" name="">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                  <div class="clearfix"></div>
                </div>
                <div class="col-xs-6">
                  <textarea class="suggestion" name="" rows="3"></textarea>
                </div>
                <div class="col-xs-6">
                  <textarea class="suggestion" name="" rows="3"></textarea>
                </div>
            </div>
          </div>
          <div class="foot">
            <button class="add-matching" type="button" name="" title="Add 1 more matching">
              <span class="glyphicon glyphicon-plus"></span>
            </button>
            <p>Each row has 2 matched elements. When test is shown, suggestion's positions will be changed randomly.</p>
          </div>
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

      <div class="question question-hidden-word">
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
          <div class="head">
            <h4><strong>2</strong>
              <span class="glyphicon glyphicon-remove"></span>
            </h4>
          </div>
          <div class="title">
            <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
          </div>
          <div class="suggestion-container">
            <div class="shown">
              <div class="word">
                <div class="wrapper-letter"><span>C</span></div>
                <div class="wrapper-letter"><span>a</span></div>
                <div class="wrapper-letter"><span>t</span></div>
              </div>
              <div class="wrapper-letter space"><span>_</span></div>
              <div class="word">
                <div class="wrapper-letter"><span>I</span></div>
                <div class="wrapper-letter"><span>T</span></div>
              </div>
            </div>
            <input class="suggestion" type="text" name="" placeholder="Answer here">
          </div>
          <div class="foot">
            <p>Let your children have fun in guessing answer letter by letter.</p>
          </div>
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
      </div>-->

    </div>

    <div class="add-container">
      <button id="add-btn" type="button" name="" title="Choose kind of question">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
      <div class="question-option">
        <button id="hidden-word" type="button" name="" title="Add Hidden Word">Hidden Word</button>
        <button id="multichoice" type="button" name="" title="Add Multichoice">Multichoice</button>
        <button id="true-false" type="button" name="" title="Add True / False">True / False</button>
        <button id="matching" type="button" name="" title="Add Matching">Matching</button>
      </div>
    </div>

    <input class="btn btn-default" id="save" type="button" name="save" value="Save">
  </div>

@endsection

@section('styles')

  <link rel="stylesheet" href="{{ asset('css/question.css') }}">

  <style>

  .container{
    text-align: center;
  }

  #title{
    font-size: 2em;
    font-weight: bold;
    border: none;
    box-shadow: none;
    border-radius: 0;
    text-align: center;
    margin: 25px 0 45px 0;
  }

  #save{
    margin-top: 25px;
    display: none;
  }


  </style>

@endsection

@section('scripts')

<script src="{{ asset('js/question.js') }}"></script>

@endsection
