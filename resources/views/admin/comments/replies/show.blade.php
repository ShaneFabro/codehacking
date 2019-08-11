@extends('layouts.admin')

@section('content')

    

    @if(count($replies) > 0)

    <h1>Replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>View Post</th>
                <th>Approve/Unapprove</th>
            </tr>
            </thead>
            <tbody>
                @foreach($replies as $reply)
                    <tr>
                        <td>{{$reply->id}}</td>
                        <td>{{$reply->author}}</td>
                        <td>{{$reply->email}}</td>
                        <td>{{$reply->body}}</td>
                        <td><a href="{{route('admin.home.post', $reply->comment->post->slug)}}">View Post</a></td>
                        <td>

                            @if($reply->is_active == 1)

                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                                    <input type="hidden" name="is_active" value="0">
                                    
                                    {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}

                                {!! Form::close() !!}

                            @else

                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                                    <input type="hidden" name="is_active" value="1">
                            
                                    {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}

                                {!! Form::close() !!}

                            @endif

                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
                            
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

    <h1 class="text-center">No Replies</h1>

    @endif
@endsection