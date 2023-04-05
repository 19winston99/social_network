@extends('layouts.app')
@section('content')
@include('posts.alerts')
@include('posts.errors')
<div class="m-auto w-50">
    <h5>Users</h5>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Show</th>
            <th>Delete</th>
        </thead>
        <tbody> @foreach ($users as $user)
            <tr>
                <td># {{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="/users/{{ $user->id }}" class="btn btn-sm btn-success"><i class="bi bi-eye"></i></a>
                </td>
                <td>
                    <form action="{{route('users.destroy', $user)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h5 class="mt-3">Posts</h5>
    <table class="table">
        <thead>
            <th>Owner ID</th>
            <th>Post ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Show</th>
            <th>Delete</th>
        </thead>
        <tbody> @foreach ($posts as $post)
            <tr>
                <td># {{ $post->user->id }}</td>
                <td># {{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    <a href="/users/{{ $post->user->id }}?#post{{ $post->id }}" class="btn btn-sm btn-success"><i class="bi bi-eye"></i></a>
                </td>
                <td>
                    <form action="{{route('posts.destroy', $post)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection