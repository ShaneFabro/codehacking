@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if(session()->has('no_selected'))
        <p>{{session('no_selected')}}</p>
    @endif
    @if($photos)

        <form action="delete/media" method="post" class="form-inline">
            {{ csrf_field() }}

            {{ method_field('delete') }}
            
            <div class="form-group">
                <select name="checkBoxArray" id="" class="form-control">
                    <option value="">Delete</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="delete_all" id="" class="btn-primary">
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="options"></th>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Linked To</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($photos as $photo)
                        <tr>
                            <td>
                                <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                            </td>
                            <td>{{$photo->id}}</td>
                            <td><img height="50" src="{{$photo->file ? $photo->file : 'http://placehold.it/400x400'}}" alt=""></a></td>
                            <td>
                                @if($photo->user)

                                    '{{$photo->user->name}}''

                                @elseif($photo->post)

                                    '{{$photo->post->title}}'

                                @else

                                    'No Used'

                                @endif
                            </td>
                            <td>{{$photo->create_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                            <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
                            <td>

                                {{-- {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}

                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                                {!! Form::close() !!} --}}
                                {{-- <div class="form-group">
                                    <input type="hidden" name="destroy_single_id" value="{{$photo->id}}">
                                    <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                                </div> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </form>

    @endif

    

@endsection

@section('scripts')

    <script>
        
            $(document).ready(function(){

                $('#options').click(function(){

                    if(this.checked){

                        $('.checkBoxes').each(function(){

                            this.checked = true;

                        })

                    }else{

                        $('.checkBoxes').each(function(){

                            this.checked = false;

                        })

                    }


                });

            });
        
    </script>

@endsection