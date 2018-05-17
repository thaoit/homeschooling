@extends('master.master')

@section('content')

<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
  <div class="profile-container">
    <div class="main-profile-container">
      <div class="text-center">
        <h1 class="main-profile-username">{{ $user->username }}</h1>
        @if( $user->id == Auth::user()->id )
        <button type="button" data-toggle="modal" data-target=".change-account-modal"><span>Change account</span></button>
        @endif
      </div>
      <div class="profile">
        <form class="main-profile">
          <input type="hidden" name="id" value="{{ $user->id }}">
          @if( $user->id == Auth::user()->id )
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
          @else
          <div class="form-group">
            <label for="">Name</label>
            <p>{{ isset($user->name) ? $user->name : 'Empty' }}</p>
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <p>{{ isset($user->email) ? $user->email : 'Empty' }}</p>
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <p>{{ isset($user->address) ? $user->address : 'Empty' }}</p>
          </div>
          <div class="form-group">
            <label for="">Other info</label>
            <p>{{ isset($user->other_info) ? $user->other_info : 'Empty' }}</p>
          </div>
          @endif
        </form>
        @if( count($child_users) > 0 )
        <div class="table-responsive sub-profile-container">
          <label>Children</label>
          <table class="table">
            <thead>
              <th>Name</th>
              <th>Gender</th>
              <th>Age</th>
              @if( $user->id == Auth::user()->id )
              <th></th>
              @endif
            </thead>
            <tbody>
              @foreach( $child_users as $child_user )
              <tr class="sub-profile" data-user-id="{{ $child_user->id }}">
                <td>{{ $child_user->name }}</td>
                <td>{{ $child_user->gender }}</td>
                <td>{{ date('Y') - date('Y', strtotime($child_user->birthday)) }}</td>
                @if( $user->id == Auth::user()->id )
                <td style="text-align: right">
                  <button class="delete-sub" type="button" data-toggle="modal" data-target=".delete-confirmation">
                    <span class="glyphicon glyphicon-remove" title="Delete"></span>
                  </button>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
      <div class="alert-container">

      </div>
    </div>

    @if( $user->id == Auth::user()->id )
    <div class="control-container">
      <button type="button" title="Add 1 more children profile" data-toggle="modal" data-target=".add-profile-modal">
        <span class="glyphicon glyphicon-plus"></span>
        <span class="control-name">Add</span>
      </button>
      <button class="save-profile" type="button" title="Save">
        <span class="glyphicon glyphicon-floppy-disk"></span>
        <span class="control-name">Save</span>
      </button>
    </div>
    @endif
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

<div class="modal fade add-profile-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content profile-container">
      {{ csrf_field() }}
      <div class="modal-header">
        <h4>Add child</h4>
      </div>
      <div class="modal-body">
        <form class="new-sub-profile">
          <div class="profile">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="name" value="" >
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" name="gender">
                @foreach( Config::get('constants.gender') as $gender )
                  @if( $gender != Config::get('constants.gender.all') )
                  <option value="{{ $gender }}">{{$gender}}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Birthday</label>
              <input class="form-control" type="date" name="birthday" value="" >
            </div>
            <div class="form-group">
              <label>Username</label>
              <input class="form-control" type="text" name="username" value="" >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input class="form-control" type="password" name="password" value="" min="6" required>
            </div>
            <div class="form-group">
              <label>Retype Password</label>
              <input class="form-control" type="password" name="password_confirmation" value="" >
            </div>
          <div class="alert-container">

          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default add-profile-btn" type="button">Save</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade delete-confirmation" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this profile?</p>
        <p>Account with this profile will be deleted too?</p>
        <div class="alert-container">

        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default delete-confirmation-btn" type="button">OK</button>
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

    // bind child user id to modal
    $('.profile-container .sub-profile-container').on('click', '.sub-profile .delete-sub', function(){

        var sub_id = $(this).parents('.sub-profile').attr('data-user-id');
        var target = $(this).attr('data-target');

        $(target).attr('data-user-id', sub_id);
    });

    // add new child profile, means creating new child user
    $('.add-profile-modal .add-profile-btn').on('click', function(e){

        var modal = $(this).parents('.add-profile-modal');

        // request data
        var data = modal.find('.new-sub-profile').serialize();

        // url
        var url = '{{ action('UserController@storeChild') }}'

        // elements
        var elements = [];
        elements['modal'] = modal;
        elements['alert-container'] = modal.find('.alert-container');
        elements['sub-profile-container'] = $('.sub-profile-container table tbody');
        elements['status-element'] = $(this)[0];

        // process
        ajaxAddChildProfile(data, elements, url);
    });

    // delete child profile, means delete child user
    $('.delete-confirmation .delete-confirmation-btn').on('click', function(){

        var modal = $(this).parents('.delete-confirmation');

        // request data
        var user_id = modal.attr('data-user-id');

        // elements
        var elements = [];
        elements['modal'] = modal;
        elements['alert-container'] = $(this).parents('.delete-confirmation').find('.alert-container');
        elements['sub-profile'] = $('.sub-profile-container .sub-profile[data-user-id=' + user_id + ']');
        elements['status-element'] = $(this)[0];

        // process url
        var url = '{{ action('UserController@delete') }}';

        // process
        ajaxDeleteProfile(user_id, elements, url);
    });

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
