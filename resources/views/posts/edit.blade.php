@extends('layouts.app')
@section('content')
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
    {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
    {!! Form::submit('Update post', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@endsection
