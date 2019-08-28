@extends('layouts.app', ['title' => "Edit Menu | Menu Management", 'breadcrumbs' => [
    [
        'title' => 'Home', 
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Administrative Menu',
        'icon' => 'fa fa-cogs',
    ], [
        'title' => 'Menu Management',
        'icon' => 'fa fa-compass',
        'route' => 'manage.menu.index',
        // 'active' => true
    ], [
        'title' => 'Edit Menu',
        'icon' => 'fa fa-pencil',
        'active' => true        
    ]
]])

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Menu Information</h3>    
    </div>
    <div class="box-body">
        {!! form($formMenu) !!}
    </div>
</div>
@endsection