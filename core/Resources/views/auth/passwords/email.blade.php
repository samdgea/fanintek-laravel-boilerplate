@extends('layouts.auth', ['title' => 'Reset Password'])

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">{{ __('Reset Password') }}</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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
        
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-8 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Send Password Reset Link') }}</button>
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
