@extends('master.master')

@section('content')

<div class="container">
  <div class="info">
    <div class="head">
      <h4>Wanna find some partners for yours and your children?</h4>
    </div>
    <div class="content">
      <p>Children's age from
        <input type="number" name="min_age">
        to
        <input type="number" name="max_age">
      </p>
      <p>Gender
        <select name="gender">
          <option value="">All</option>
          <option value="male">Boy</option>
          <option value="female">Girl</option>
          <option value="others">Others</option>
        </select>
      </p>
      <div class="favourite-topics hint-chosen-panel">
        <p>Favourite topics</p>
        <div class="typing-hint">
          <input class="form-control" type="text" name="topics" placeholder="Type some topics here">
        </div>
        <div class="hints">
          <ul>
            <li>Science</li>
            <li>Art</li>
            <li>Skill</li>
            <li>Music</li>
          </ul>
        </div>
        <div class="chosen-hints">

        </div>
      </div>
      <p>Your family comes from
        <select name="countries">
          <option value="">All</option>
          <option value="gernamy">Germany</option>
          <option value="japan">Japan</option>
          <option value="korean">Korean</option>
          <option value="us">US</option>
          <option value="vietnam">Vietnam</option>
        </select>
        <select class="" name="provinces">
          <option value="">All</option>
          <option value="hanoi">Ha Noi</option>
          <option value="danang">Da Nang</option>
          <option value="tphcm">TP.Ho Chi Minh</option>
        </select>
      </p>
      <div>
        <p>Other info</p>
        <input class="form-control" type="text" name="others" placeholder="Type some other requirements here">
      </div>
    </div>
    <div class="foot">
      <button class="btn btn-default" type="button" name="">Search</button>
      <button class="btn btn-default" type="button" name="">Post</button>
    </div>
  </div>

  <div class="post-container">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 post">
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
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 post">
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
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 post">
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
</div>

@endsection

@section('styles')

<link rel="stylesheet" href="{{ asset('css/hint-chosen-panel.css') }}">
<style>

  .info{
    margin-bottom: 45px;
  }

  .info .head{
    text-align: center;
  }

  .info .head, .info .content{
    margin-bottom: 30px;
  }

  .info .foot{
    text-align: center;
  }

  .post-container .post{
    padding: 15px;
    margin-bottom: 10px;
  }

  .post-container .post .head,
  .post-container .post .content{
    border-bottom: 1px solid #ccc;
    margin-bottom: 15px;
    overflow: auto;
  }

  .post .content p:nth-child(2n + 1){
    padding-left: 0;
  }

  .post .content p:nth-child(2n){
    text-align: right;
    padding-right: 0;
  }

</style>

@endsection

@section('scripts')

<script src="{{ asset('js/hint-chosen-panel.js') }}"></script>

@endsection
