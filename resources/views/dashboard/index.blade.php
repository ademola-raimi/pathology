@extends('layout.master')
@section('title', 'Welcome to your dashboard, feel free to navigate around')
@section('content')
<div class="row">
    @include('dashboard.partials.top-nav-bar')
  </div>

  <div class="row">
    @include('dashboard.partials.side-nav-bar')
  </div>

@endsection