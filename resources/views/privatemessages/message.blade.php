@extends('layouts.app')

@section('title', 'Private Messages')

@section('content')

    <div class="row mt-2 mb-2 text-center text-lg-left">
        <div class="col-12 col-lg-4">
            <h1>@yield('title')</h1>
        </div>
        <div class="col-12 col-lg-8 text-lg-right">
            <a href="{{ route('private_messages.create') }}" class="btn btn-success mb-4">Write a new message!</a>
        </div>
    </div>
    <div class="card mb-4 bg-light">
        <h5 class="card-header">Your private messages</h5>
        <div class="card-body">
            <div class="card-body row">
                <div class="col-12 col-lg-12">
                    <div class="list-group">
                        <a href="{{ route('private_messages.read', ['uuid' => $privateMessage->uuid]) }}" id="{{ $privateMessage->uuid }}" class="list-group-item list-group-item-action flex-column align-items-start @if(null === $privateMessage->read_at && $auth_id != $privateMessage->user_id) list-group-item-secondary @endif">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">{{ $privateMessage->user->name }}</h5>
                                <small>{{ $privateMessage->created_at }}</small>
                            </div>
                            <p class="mb-1">{{ $privateMessage->body }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection