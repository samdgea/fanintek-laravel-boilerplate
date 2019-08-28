@extends('layouts.app', ['title' => "View {$detailMenu->menu_label} | Menu Management", 'breadcrumbs' => [
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
        'title' => 'View Menu',
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
        <a href="{{ route('manage.menu.index') }}" class="btn btn-primary pull-right"> Ok</a>
    </div>
</div>
@endsection