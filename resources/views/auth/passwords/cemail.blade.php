@extends('layouts/login-layout')

@section('body')
            <form action="{{ route('login.custom') }}" method="post">
                        {{ csrf_field() }}


              <h1>Reset Password</h1>


  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div>
                                <input id="email" type="text" class="form-control" placeholder="Username, Phone, or Email" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div>
                                <input id="password" type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

  <div class="form-group">
                            <div class="pull-left">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>




              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

           

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{route('register')}}" class="to_register"> Create Account </a>
                </p>

              


  @endsection