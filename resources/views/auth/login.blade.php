@extends('layouts.front')

@section('content')
<div class="reg-form">
    <h3>Sign In</h3>
    <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
         <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
       </div>

       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
       </div>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
       <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
       <button type="submit" class="btn red-btn">Login</button>
    </form>
</div>

@endsection
