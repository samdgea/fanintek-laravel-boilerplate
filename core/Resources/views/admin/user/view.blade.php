@extends('layouts.app', ['title' => "View {$detailUser->full_name} | User Management", 'breadcrumbs' => [
    [
        'title' => 'Home', 
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Administrative Menu',
        'icon' => 'fa fa-cogs',
    ], [
        'title' => 'User Management',
        'icon' => 'fa fa-users',
        'route' => 'manage.user.index',
        // 'active' => true
    ], [
        'title' => 'View User',
        'icon' => 'fa fa-eye',
        'active' => true        
    ]
]])

@section('content')
<div class="box">
    <div class="box-body">
        {!! form($form) !!}
    </div>
    <div class="box-footer">
        <a href="{{ route('manage.user.index') }}" class="btn btn-primary pull-right"> Ok</a>
    </div>
</div>
@endsection