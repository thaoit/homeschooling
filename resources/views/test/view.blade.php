@extends('master.master')

@section('content')

<div class="col-xs-12 panel-container">
  <div class="time">
      <img src="{{ asset('img/alarm-clock.png') }}" alt="Alarm clock">
      <span>00</span>
      <span>:</span>
      <span>15</span>
      <span>:</span>
      <span>20</span>
  </div>
  <button class="assign" type="button" name="" title="Click to assign test" data-toggle="modal" data-target="#confirmation-assign">Assign</button>
  <button class="start" type="button" name="" title="Click to start testing">Start</button>
  <div class="clearfix"></div>
</div>

<div class="col-xs-12 col-sm-6 col-sm-offset-3 question-container view-mode">
  <div class="question question-multichoice">
    <div class="content content-border-top">
      <div class="head">
        <h4><strong>1</strong>
        </h4>
      </div>
      <div class="title">
        <p>What is the average surface temperature of the Moon?</p>
      </div>
      <div class="suggestion-container">
        <div class="col-xs-12 col-sm-6">
          <p>
            <span class="signal">A.</span>
            <!--<input class="suggestion" type="text" name="" value="">-->
            <span class="clickable">10 degrees Celsius during the day and -15 degrees Celsius at night</span>
          </p>
        </div>
        <div class="col-xs-12 col-sm-6">
          <p>
            <span class="signal">B.</span>
            <!--<input class="suggestion" type="text" name="" value="">-->
            <span class="clickable">107 degrees Celsius during the day and -153 degrees Celsius at night</span>
          </p>
        </div>
        <div class="col-xs-12 col-sm-6">
          <p>
            <span class="signal">C.</span>
            <!--<input class="suggestion" type="text" name="" value="">-->
            <span class="clickable">100 degrees Celsius during the day and 0 degrees Celsius at night</span>
          </p>
        </div>
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
        </h4>
      </div>
      <div class="title">
        <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
      </div>
      <div class="suggestion-container">
        <div class="col-xs-6">
          <p>
            <span class="signal">A. </span>
            <span class="clickable">True</span>
          </p>
        </div>
        <div class="col-xs-6">
          <p>
            <span class="signal">B. </span>
            <span class="clickable">False</span>
          </p>
        </div>
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
        </h4>
      </div>
      <div class="title">
        <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
      </div>
      <div class="suggestion-container">
        <div>
            <div class="col-xs-12">
              <span class="signal">A. </span>
              <div class="clearfix"></div>
            </div>
            <div class="col-xs-6">
              <p class="suggestion">Earth</p>
            </div>
            <div class="col-xs-6" ondrop="dropMatching(event)" ondragover="allowDropMatching(event)">
              <p id="1" class="suggestion clickable" draggable="true" ondragstart="dragMatching(event)">The third planet</p>
            </div>
        </div>
        <div>
            <div class="col-xs-12">
              <span class="signal">B. </span>
              <div class="clearfix"></div>
            </div>
            <div class="col-xs-6">
              <p class="suggestion">Mars</p>
            </div>
            <div class="col-xs-6" ondrop="dropMatching(event)" ondragover="allowDropMatching(event)">
              <p id="2" class="suggestion clickable" draggable="true" ondragstart="dragMatching(event)">The fourth planet</p>
            </div>
        </div>
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
        </h4>
      </div>
      <div class="title">
        <textarea name="title" rows="3" placeholder="Question or guidelines here"></textarea>
      </div>
      <div class="suggestion-container">
        <div class="shown">
          <div class="word">
            <div class="wrapper-letter"><span> </span></div>
            <div class="wrapper-letter"><span> </span></div>
            <div class="wrapper-letter"><span> </span></div>
          </div>
          <div class="wrapper-letter space"><span> </span></div>
          <div class="word">
            <div class="wrapper-letter"><span> </span></div>
            <div class="wrapper-letter"><span> </span></div>
          </div>
        </div>
        <input class="suggestion" type="text" name="" placeholder="Answer here">
      </div>
      <div class="foot">
        <div class="alert alert-warning">
          <span class="message"></span>
        </div>
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

</div>

<div class="clearfix"></div>

<div class="cover-question-container"></div>

<div id="confirmation-assign" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure to assign?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" type="button" name="ok" data-dismiss="modal">OK</button>
        <button class="btn btn-default" type="button" name="cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/question.css') }}">

@endsection

@section('scripts')

<script src="{{ asset('js/question.js') }}"></script>
<script>
  function allowDropMatching(e) {

      e.preventDefault();
  }

  function dragMatching(e) {

      e.dataTransfer.setData("element-id", e.target.id);
  }

  function dropMatching(e) {

      e.preventDefault();

      var drop_element = $("#" + e.dataTransfer.getData("element-id"));
      var current_element = $("#" + e.target.id);

      var drop_parent = drop_element.parent();
      var current_parent = current_element.parent();

      drop_element.remove();
      current_element.remove();

      drop_parent.append(current_element[0].outerHTML);
      current_parent.append(drop_element[0].outerHTML);
  }
</script>

@endsection
