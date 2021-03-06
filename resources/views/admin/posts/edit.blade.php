@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')

    <h1>Edit Post</h1>

    <div class="col-sm-6">

        <img  src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x133'}}" alt="" class="img-responsive">

    </div>

    <div class="col-sm-6">
        <div class="row">
                {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
        
                    <div class="form-group">
                        {!! Form::label('title', 'Title:') !!}
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::label('category', 'Category:') !!}
                        {!! Form::select('category_id', [''=>'Choose Category'] + $category, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('photo_id', 'Photo:') !!}
                        {!! Form::file('photo_id') !!}
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::label('body', 'Description:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>
                
                    <div class="form-group">
                        {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
                    </div>
        
        
                {!! Form::close() !!}

                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
                    </div>

                {!! Form::close() !!}
                <br>
            </div>
            <div class="row">
                @include('includes.form_error')
        </div>
    </div>

@endsection