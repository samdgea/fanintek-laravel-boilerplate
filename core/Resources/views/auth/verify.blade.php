@extends('layouts.app', ['title' => 'Verify your email'])

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ __('Verify Your Email Address') }}</h3>
    </div>
    <div class="box-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection
