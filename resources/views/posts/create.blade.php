@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => 'posts.store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! Form::hidden('user_id', '0') !!}
        {!! Form::hidden('content', 'Default content') !!}
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>

    <div class="form-group">
        {!! Form::file('file', ['class' => 'form-control']) !!}
    </div>
    {!! Form::close() !!}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
