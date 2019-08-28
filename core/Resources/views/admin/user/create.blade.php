@extends('layouts.app', ['title' => "Create User | User Management", 'breadcrumbs' => [
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
        'title' => 'Create User',
        'icon' => 'fa fa-user-plus',
        'active' => true        
    ]
]])

@section('content')
<div class="box">
    <div class="box-body">
        {!! form($form) !!}
    </div>
</div>
@endsection