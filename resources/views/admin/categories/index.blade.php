@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_category'))

        <p class="bg-danger">{{session('deleted_category')}}</p>

    @endif

    <h1>Categories</h1>

    <div class="col-sm-6">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

    </div>

    <div class="col-sm-6">

        @if($category)
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($category as $categories)
                        <tr>
                            <td>{{$categories->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $categories->id)}}">{{$categories->name}}</a></td>
                            <td>{{$categories->created_at->diffForHumans()}}</td>
                            <td>{{$categories->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection