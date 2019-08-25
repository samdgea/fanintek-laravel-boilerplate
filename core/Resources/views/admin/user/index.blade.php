@extends('layouts.app', ['title' => 'User Management', 'breadcrumbs' => [
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
        'active' => true
    ]
]])

@section('content')
{{-- @php dd(\Auth::user()->hasRole('Administrator')) @endphp --}}
@endsection