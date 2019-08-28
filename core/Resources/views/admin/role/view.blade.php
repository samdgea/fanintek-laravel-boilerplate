@extends('layouts.app', ['title' => "View {$detailRole->name} | Role Management", 'breadcrumbs' => [
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
        'title' => 'View Role',
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
        <a href="{{ route('manage.role.index') }}" class="btn btn-primary pull-right"> Ok</a>
    </div>
</div>
@endsection