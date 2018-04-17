@extends('master.master')

@section('content')

<div class="container">
  <div class="parent_profile">
    <h4>Parent's Profile</h4>
    <div class="form-group">
      <span>Username</span>
      <input class="form-control" type="text" name="username" value="">
    </div>
    <div class="form-group">
      <span>Email</span>
      <input class="form-control" type="email" name="email" value="">
    </div>
    <div class="form-group">
      <span>Address</span>
      <input class="form-control" type="text" name="address" value="">
    </div>
    <div class="form-group">
      <span>Password</span>
      <input class="form-control" type="password" name="password" value="">
    </div>
    <div class="form-group">
      <span>Retype Password</span>
      <input class="form-control" type="password" name="retype_password" value="">
    </div>
  </div>
  <div class="">
    <h4>Children's Profile</h4>
    <div class="">
      <div class="form-group">
        <span>Username</span>
        <input class="form-control" type="text" name="username" value="">
      </div>
      <div class="form-group">
        <span>Password</span>
        <input class="form-control" type="password" name="password" value="">
      </div>
      <div class="form-group">
        <span>Retype Password</span>
        <input class="form-control" type="password" name="retype_password" value="">
      </div>
      <div class="form-group">
        <span>Gender</span>
        <select class="form-control" name="gender">
          <option value="">All</option>
          <option value="male">Boy</option>
          <option value="female">Girl</option>
          <option value="others">Others</option>
        </select>
      </div>
      <div class="form-group">
        <span>Birthday</span>
        <input class="form-control" id="birthday_1" type="text" name="birthday" value="">
      </div>
    </div>
  </div>
  <button class="btn btn-default" type="button" name="">Save</button>
</div>

@endsection

@section('styles')


@endsection

@section('scripts')

<script>

$(document).ready(function(){

  $('#birthday_1').datetimepicker();

});

</script>

@endsection
