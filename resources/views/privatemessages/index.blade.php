@extends('layouts.app')

@section('title', 'PrivateMessages')

@section('content')

    <div class="row mt-2 mb-2 text-center text-lg-left">
        <div class="col-12 col-lg-4">
            <h1>@yield('title')</h1>
        </div>
        <div class="col-12 col-lg-8 text-lg-right">
            <a href="" class="btn btn-success mb-4">Write a new message!</a>
        </div>
    </div>
    
    <div class="card mb-4 bg-light">
        <div class="card-body">

        </div>
    </div>

    @if(count($items) > 0)
        <p>MESSAGES, ALERT</p>
    @else
        <p>No messages were found</p>
    @endif

@endsection