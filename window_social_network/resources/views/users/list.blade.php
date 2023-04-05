@extends('layouts.app')
@section('content')
<div class="m-auto w-50">
    @foreach($users as $user)
    <a href="/users/{{ $user->id }}" class="nav-link">
        <div class="d-flex align-items-center gap-4 user-list-container p-2">
            <img src="{{ asset('images/users/'. $user->profile) }}" alt="Profile Image" class="img-fluid img-user-list">
            <h5>{{ $user->name }} {{ $user->lastname }}</h5>
        </div>
    </a>
    <hr>
    @endforeach
</div>
@endsection