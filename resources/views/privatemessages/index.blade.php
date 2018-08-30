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
                <div class="col-12 col-lg-2">
                    <div class="btn-group-vertical">
                        <a href="{{ route('private_messages.inbox') }}" class="btn btn-secondary @if(1 == $inbox) active @endif">Inbox <span class="badge badge-light">4</span></a>
                        <a href="{{ route('private_messages.sent') }}" class="btn btn-secondary @if(0 == $inbox) active @endif">Sent</a>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    @if(count($items) > 0)
                        <div class="list-group">
                        @foreach($items as $privateMessage)
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start @if(null === $privateMessage->read_at and 1 == $inbox) list-group-item-secondary @endif">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">{{ $privateMessage->user->name }}</h5>
                                    <small>{{ $privateMessage->created_at }}</small>
                                </div>
                                <p class="mb-1">{{ $privateMessage->body }}</p>
                            </a>
                        @endforeach
                        </div>
                    @else
                        <p>No messages were found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection