@extends('layouts.app', ['title' => "Edit {$detailRole->name} | Role Management", 'breadcrumbs' => [
    [
        'title' => 'Home', 
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Administrative Menu',
        'icon' => 'fa fa-cogs',
    ], [
        'title' => 'Role Management',
        'icon' => 'fa fa-shield',
        'route' => 'manage.role.index',
        // 'active' => true
    ], [
        'title' => 'Edit Role',
        'icon' => 'fa fa-pencil',
        'active' => true        
    ]
]])

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Role Information</h3>    
    </div>
    <div class="box-body">
        {!! form($formRole) !!}
    </div>
</div>
@endsection