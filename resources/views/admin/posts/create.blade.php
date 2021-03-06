@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')

    <h1>Create Post</h1>

    <div class="row">
        {{-- {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!} --}}
        <form action="{{route('admin.posts.show')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
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
            <br>
            <div class="form-group">
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
            </div>

        

        {{-- {!! Form::close() !!} --}}
        </form>
        <br>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@endsection