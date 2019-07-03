@extends('layouts.admin')

@section('content')

    <h1>Users</h1>

    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
          </tr>
        </thead>
        <tbody>
        @if($user)
            @foreach($user as $users)
                <tr>
                    <td>{{$users->id}}</td>
                    <td>{{$users->name}}</td>
                    <td>{{$users->email}}</td>
                    <td>{{$users->role ? $users->role->name : 'No role'}}</td>
                    <td>{{$users->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$users->created_at->diffForHumans()}}</td>
                    <td>{{$users->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection