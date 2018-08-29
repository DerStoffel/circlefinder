@extends('layouts.app')

@section('title', 'New Private Message')

@section('content')

<h1>@yield('title')</h1>

<div class="card mt-3">
        <h5 class="card-header">Create a new private message</h5>
        <div class="card-body">
            @include('privatemessages.form')
        </div>
</div>

@endsection