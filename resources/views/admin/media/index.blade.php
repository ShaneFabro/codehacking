@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td>{{$photo->id}}</td>
                        <td><img height="50" src="{{$photo->file ? $photo->file : 'http://placehold.it/400x400'}}" alt=""></a></td>
                        <td>{{$photo->create_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                        <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

@endsection