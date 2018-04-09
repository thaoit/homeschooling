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
      <button type="button" name="creating_test" title="Create new test" class="btn btn-default" data-toggle="modal" data-target="#lesson-modal">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
    </div>
  </div>

  <div id="filter-lesson" class="filter-container">
    <div class="filter-group">
      <p class="filter-name">From</p>
      <div class="filter-options">
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="my_resource" checked>
          <span class="checkmark"></span>
          My resourse
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 checkbox-option">
          <input type="checkbox" name="" value="community" checked>
          <span class="checkmark"></span>
          Community
        </label>
      </div>
    </div>
    <div class="filter-group">
      <p class="filter-name">Time</p>
      <div class="filter-options">
        <label class="col-xs-12 col-sm-3 col-md-2 radio-option">
          <input type="radio" name="time" value="lastly" checked>
          <span class="checkmark"></span>
          Lastly
        </label>
        <label class="col-xs-12 col-sm-3 col-md-2 radio-option">
          <input type="radio" name="time" value="oldest">
          <span class="checkmark"></span>
          Oldest
        </label>
      </div>
    </div>
    <div class="filter-group">
      <button class="filter-control" type="button" name="filter_ok" title="Start filter">OK</button>
      <button class="filter-control" type="button" name="filter_cancel" title="Close filter pane" data-dismiss="filter-container">Cancel</button>
    </div>
  </div>

  <div id="my_resource" class="test-container">
    <h3>My resource</h3>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
      <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">&#8734;</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href="" title="How do?"><strong>How do animals sleep in the winter? What is a greate question!</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">2</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
  </div>

  <div id="community" class="test-container">
    <h3>Community</h3>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
      <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">&#8734;</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href="" title="How do?"><strong>How do animals sleep in the winter? What is a greate question!</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">2</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="title-container">
        <p class="title"><a href=""><strong>Test discovery about the Earth</strong></a></p>
      </div>
      <div class="content">
        <div class="col-xs-5">
          <p class="no-of-question">3</p>
          <p class="caption">Question(s)</p>
        </div>
        <div class="col-xs-2 signal">x</div>
        <div class="col-xs-5">
          <p class="duration">20</p>
          <p class="caption">Min(s)</p>
        </div>
      </div>
      <div class="foot">
        <div class="control-btn">
          <button type="button" name="edit" title="Edit this test">
            <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
          </button>
          <button type="button" name="delete" title="Delete this test">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
        <p class="caption">MBC. Key</p>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')

  <link rel="stylesheet" href="{{ asset('css/filter.css') }}">
  <link rel="stylesheet" href="{{ asset('css/testlist.css') }}">

  <style >

    .container{
      text-align: center;
    }

    .container > div{
      overflow: hidden;
    }

    .container h3{
      margin-bottom: 30px;
    }

    .search-container{
      margin-bottom: 10px;
    }

    .filter-create-container button{
      border: none;
      outline: none;
    }

    .filter-create-container button:hover{
      background-color: #fff;
    }

    #my_resource{
      clear: both;
    }

  </style>

@endsection

@section('scripts')

  <script src="{{ asset('js/filter.js') }}"></script>

@endsection
