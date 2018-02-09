@extends('layouts/login-layout')

@section('body')
            <form action="{{ route('password.email') }}" method="post">
                        {{ csrf_field() }}
 
              <h1>Reset Password</h1>


  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div>
                                <input id="email" type="email" class="form-control" placeholder="Enter your Email" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


				

              <div>
                <button class="btn btn-default submit" type="submit">     Send Password Reset Link</button>
                <!-- <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

           

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{route('register')}}" class="to_register"> Create Account </a>
                </p>

              


  @endsection