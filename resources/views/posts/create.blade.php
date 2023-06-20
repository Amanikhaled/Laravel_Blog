@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>
                    <div class='card-body'>

                        {!! Form::open(['route' => 'posts.store']) !!}
                        <div class="form-group">
                             {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', old('title'), ['class' => 'form-control' . ($errors->has('title') ? ' is-valid' : ''), 'required', 'autofocus']) !!}

                            @if ($errors->has('title'))
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', 'Content') !!}
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control' . ($errors->has('content') ? ' is-valid' : ''), 'required']) !!}

                            @if ($errors->has('content'))
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class='form-group mt-4'>
                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
