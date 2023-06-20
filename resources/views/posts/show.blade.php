@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Post: {{ $post->title }}</div>
            <div class="card-body">
                <!-- Display post content here -->

                <h3>Comments</h3>
                <!-- Display existing comments here -->

                <!-- Add comment form -->
                @if (Auth::check())
                    {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                        <p>{{ Form::textarea('comment', old('comment')) }}</p>
                        {{ Form::hidden('post_id', $post->id) }}
                        <p>{{ Form::submit('Send') }}</p>
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
    @if(isset($comment))
        <div class="alert alert-success">
            New comment added: {{ $comment->comment }} by {{ $comment->user->name }}
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header">Post: {{ $post->title }}</div>
            <div class="card-body">
                <!-- Display post content here -->
                <h3>Comments</h3>

                @if (count($post->comments) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post->comments as $comment)
                                <tr>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>This post has no comments</p>
                @endif
            </div>
        </div>
    </div>
@endsection
