@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->isEmpty())
                <p>Posts Not found</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            @can('update', $posts->first())
                                <th>Edit</th>
                            @endcan
                            @can('destroy', $posts->first())
                                <th>Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>
                                    @can('update', $post)
                                        {!! Form::open(['route' => ['posts.edit', $post->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                                <td>
                                    @can('destroy', $post)
                                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this post?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>

                            <td>

                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Add Comment</a>
                                </td>

                        @endforeach
                    </tbody>
                </table>
            @endif
            <div>
            @if (Auth::check())
            <a href="{{ route('posts.create') }}" class="btn btn-primary">create Post</a>
            @endif
            </div>
        </div>
    </div>
</div>


@endsection
