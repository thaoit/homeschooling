@extends('master.master')

@section('content')

<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
  <div class="profile-container">
    <div class="main-profile-container">
      <div class="text-center">
        <h1 class="main-profile-username">{{ $user->username }}</h1>
        <button type="button" data-toggle="modal" data-target=".change-account-modal"><span>Change account</span></button>
      </div>
      <div class="profile">
        <form class="main-profile">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="form-group">
            <label for="">Name</label>
            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <input class="form-control" type="text" name="address" value="{{ $user->address }}">
          </div>
          <div class="form-group">
            <label for="">Other info</label>
            <textarea class="form-control" name="other_info" rows="3">{{ $user->other_info }}</textarea>
          </div>
        </form>
      </div>
      <div class="alert-container">

      </div>
    </div>

    <div class="control-container">
      <button class="save-profile" type="button" title="Save">
        <span class="glyphicon glyphicon-floppy-disk"></span>
        <span class="control-name">Save</span>
      </button>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<div class="modal fade change-account-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Change account</h4>
      </div>
      <div class="modal-body profile-container">
        <form class="account-form">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="form-group">
            <label for="">Username</label>
            <input class="form-control" type="text" name="username" value="{{ $user->username }}" required>
          </div>
          <div class="form-group">
            <label for="">New password</label>
            <input class="form-control password" type="password" name="password" value="" required>
          </div>
          <div class="form-group">
            <label for="">Retype new password</label>
            <input class="form-control password_confirmation" type="password" name="password_confirmation" value="" required>
          </div>
          <div class="alert-container">

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default change-account-btn" type="button">Save</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')

<style>


</style>

@endsection

@section('scripts')

<script src="{{ asset('js/custom.js') }}"></script>

<script>

$(document).ready(function(){

    // change account info,
    // info include: username, new password
    $('.change-account-modal .change-account-btn').on('click', function(){

        var modal = $(this).parents('.change-account-modal');

        // request data
        var data = modal.find('.account-form').serialize();

        // process url
        var url = '{{ action('UserController@changeAccount') }}'

        // elements
        var elements = [];
        elements['modal'] = modal;
        elements['status-element'] = $(this)[0];
        elements['alert-container'] = modal.find('.alert-container');
        elements['username-element'] = $('.main-profile-container .main-profile-username')[0];

        // process
        ajaxChangeAccount(data, elements, url);

    })

    // save general info in profile,
    // info include: name, email, address, other info
    $('.profile-container .control-container .save-profile').on('click', function(){

        var main_container = $(this).parents('.profile-container').find('.main-profile-container');

        // request data
        var data = main_container.find('.main-profile').serialize();

        // process url
        var url = '{{ action('UserController@updateGeneralProfile') }}';

        // elements
        var elements = [];
        elements['alert-container'] = main_container.find('.alert-container');
        elements['status-element'] = $(this).find('.control-name')[0];

        // process
        ajaxUpdateGeneralProfile(data, elements, url);
    })
});

</script>

@endsection
