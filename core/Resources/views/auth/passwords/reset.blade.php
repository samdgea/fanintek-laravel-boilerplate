@extends('layouts.auth', ['title' => 'Reset Password'])

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">{{ __('Reset Password') }}</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf 

        <input type="hidden" name="token" value="{{ $token }}">

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
            <div class="col-xs-8 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
<!-- /.login-box-body -->
@endsection
