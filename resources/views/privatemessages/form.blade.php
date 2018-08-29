{!! Form::open(['route' => 'private_messages.send']) !!}

    <div class="row mb-4">
        <div class="col-12 col-lg-12">
            <div class="form-group">
                {{ Form::label('recipient', 'Recipient') }}
                {{ Form::text('recipient', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'Message') }}
                {{ Form::textarea('body', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>


    {{ Form::submit('Send', ['class' => 'btn btn-success']) }}
     <a href="{{ route('private_messages.inbox') }}" class="btn btn-light">Cancel</a>

{!! Form::close() !!}