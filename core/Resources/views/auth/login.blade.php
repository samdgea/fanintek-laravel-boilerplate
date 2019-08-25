@extends('layouts.auth', ['title' => 'Sign In'])

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf 

        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-xs-8">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
            {{ __('I forgot my password') }}
        </a>
    @endif
    <br>
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
    @endif
</div>
<!-- /.login-box-body -->
@endsection
