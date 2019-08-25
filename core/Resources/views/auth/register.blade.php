@extends('layouts.auth', ['title' => 'Registration Form'])

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">{{ __('Register') }}</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf 

        <div class="row">
        <div class="form-group has-feedback col-md-6">
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>
            
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group has-feedback col-md-6">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
            
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        </div>

        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
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

        <div class="form-group has-feedback">
            <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password-confirm" placeholder="Repeat Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            @error('password-confirm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    @if (Route::has('login'))
        <a href="{{ route('login') }}">
            {{ __('Back to login') }}
        </a>
    @endif
</div>
<!-- /.login-box-body -->
@endsection
