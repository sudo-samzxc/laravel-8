@extends('layouts.app')
@section('content')
    <ul>
        @foreach ($posts as $post)
            <div class="image-container">
                <img height="100" src="{{$post->path}}" alt="">
            </div>
            <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }} </a>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </li>
        @endforeach
    </ul>
@endsection
