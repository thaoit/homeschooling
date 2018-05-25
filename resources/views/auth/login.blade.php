@extends('master.master')

@section('content')

<div class="content-page">
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="login-title">{{ __('Login') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username_email" class="col-sm-4 col-form-label text-md-right">{{ __('Username or Email') }}</label>

                            <div class="col-md-8">
                                <input id="username_email" type="text" class="form-control{{ $errors->has('username_email') ? ' is-invalid' : '' }}" name="username_email" value="{{ old('username_email') }}" required autofocus>

                                @if ($errors->has('username_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">

                                <button type="submit" class="btn border-no-background-button">
                                    {{ __('Login') }}
                                </button>

                                <div>
                                  <a class="btn btn-link make-color" href="{{ route('password.request') }}">
                                      {{ __('Forgot Your Password?') }}
                                  </a>
                                </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
