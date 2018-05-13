@extends('master.master')

@section('content')

<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
  <form class="profile-container">
    <div class="parent-profile-container">
      <div class="text-center">
        <h1>{{ $user->username }}</h1>
        <button type="button" data-toggle="modal" data-target="#change-account-modal"><span>Change account</span></button>
      </div>
      <div class="profile">
        <div class="form-group">
          <label for="">Name</label>
          <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
          <label for="">Address</label>
          <input class="form-control" type="text" name="address" value="{{ $user->address }}">
        </div>
        <div class="form-group">
          <label for="">Other info</label>
          <textarea class="form-control" name="other_info" rows="3">{{ $user->other_info }}</textarea>
        </div>
        @if( count($child_users) > 0 )
        <div class="table-responsive child-profile-container">
          <label>Children</label>
          <table class="table">
            <thead>
              <th>Name</th>
              <th>Gender</th>
              <th>Birthday</th>
              <th></th>
            </thead>
            <tbody>
              @foreach( $child_users as $child_user )
              <tr class="child-profile" data-user-id="{{ $child_user->id }}">
                <td>{{ $child_user->name }}</td>
                <td>{{ $child_user->gender }}</td>
                <td>{{ $child_user->birthday }}</td>
                <td style="text-align: right">
                  <button class="delete-child" type="button" data-toggle="modal" data-target="#delete-confirmation">
                    <span class="glyphicon glyphicon-remove" title="Delete"></span>
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>

    <div class="control-container">
      <button type="button" title="Add 1 more children profile" data-toggle="modal" data-target="#add-profile-modal">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
      <button class="save-profile" type="button" title="Save">
        <span class="glyphicon glyphicon-floppy-disk"></span>
      </button>
    </div>
  </form>
</div>

<div class="clearfix"></div>

<div id="change-account-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Change account</h4>
      </div>
      <div class="modal-body profile-container">

        <div class="form-group">
          <label for="">Username</label>
          <input class="form-control" type="text" name="username" value="{{ $user->username }}" required>
        </div>
        <div class="change_password">
          <div class="form-group">
            <label for="">New password</label>
            <input class="form-control password" type="password" name="password" value="" required>
          </div>
          <div class="form-group">
            <label for="">Retype new password</label>
            <input class="form-control retype-password" type="password" name="retype_password" value="" required>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal">Save</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="add-profile-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content profile-container">
      <div class="modal-header">
        <h4>Add child</h4>
      </div>
      <div class="modal-body">
        <div class="profile">
          <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" name="name" value="" required>
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
              @foreach( Config::get('constants.gender') as $gender )
              <option value="{{ $gender }}">$gender</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Birthday</label>
            <input class="form-control" type="date" name="birthday" value="" required>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" required>
          </div>
          <div class="form-group">
            <label>Retype Password</label>
            <input class="form-control" type="password" name="retype_password" value="" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default add-profile-btn" type="button" data-dismiss="modal">Save</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="delete-confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this profile?</p>
        <p>Account with this profile will be deleted too?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default delete-confirmation-btn" type="button" data-dismiss="modal">OK</button>
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

    $('.profile-container .child-profile-container').on('click', '.child-profile .delete-child', function(){

        var child = $(this).parents('.child-profile').attr('data-user-id');
        var target = $(this).attr('data-target');

        $(target).attr('data-user-id', child);
    });

});

</script>

@endsection
