@extends('layouts.app', ['title' => "Edit {$detailUser->full_name} | User Management", 'breadcrumbs' => [
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
        'title' => 'Edit User',
        'icon' => 'fa fa-pencil',
        'active' => true        
    ]
]])

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Information</h3>    
    </div>
    <div class="box-body">
        {!! form($formInformation) !!}
    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Change User Password</h3>    
    </div>
    <div class="box-body">
        {!! form($formChangePassword) !!}
    </div>
</div>


<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-exclamation-triangle"></i> Danger Zone</h3>    
    </div>
    <div class="box-body">
        
    </div>
</div>
@endsection