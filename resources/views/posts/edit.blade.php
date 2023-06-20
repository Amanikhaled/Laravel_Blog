@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <div class="card-body">
                        @if ($error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif

                        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('content', 'Content') !!}
                                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
