@extends('layouts.app')
@section('content')
<div class="m-auto w-50">
    <div class="profile-cover-container">
        <img src="{{ asset('images/background/background4.jpg') }}" class="img-fluid" alt="Profile Cover">
    </div>
    <img src="{{ asset('images/users/' . $user->profile) }}" class="img-fluid personal-profile-img" alt="Profile Cover">
    <h3 class="ps-4">{{ $user->name }} {{ $user->lastname }}</h3>
    <div class="mt-5">
        @include('posts.alerts')
        @include('posts.errors')
        @if(count($posts) == 0)
        <h4 class="text-center"><i class="bi bi-exclamation-circle-fill"></i> Al momento non sono presenti post da questo utente</h4>
        @endif
        @foreach($posts as $post)
        <div class="card border-secondary card-container mt-4 mb-4 m-auto" id="post{{ $post->id }}">
            <div class="d-flex justify-content-between header-post align-items-center">
                <div class="d-flex gap-3 align-items-center">
                    <img src="{{ asset('images/users/' . $user->profile) }}" class="img-fluid profile-image" alt="User Image" />
                    <h5 class="mb-0">{{ $user->name }} {{ $user->lastname }}</h5>
                </div>
                @if(Auth::user()->id == $post->user_id)
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $post->id }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteExampleModal{{ $post->id }}">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                    <!--Edit Modal -->
                    <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $post->id }}">Modifca il post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <label for="title" class="form-label">Titolo</label>
                                        <input type="text" name="title" class="form-control form-control-sm mb-2 @error('title') is-invalid @enderror" id="title" value="{{ $post->title }}" required>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="description" class="form-label">Descrizione</label>
                                        <input type="text" name="description" class="form-control form-control-sm mb-2 @error('description') is-invalid @enderror" id="description" value="{{ $post->description }}" required>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="image" class="form-label">Immagine</label>
                                        <input type="file" name="image" id="image" class="form-control form-control-sm mb-2">
                                        <button type="submit" class="btn btn-sm btn-warning float-end">Modifica</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteExampleModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteExampleModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="deleteExampleModalLabel{{ $post->id }}">Sicuro di eliminare il post? L'azione non sarà reversibile</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger float-end">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <p class="mb-2 p-2">{{ $post->title }}</p>
            <img src="{{asset('images/posts/' . $post->image)}}" class="card-img-top" alt="Post Image" />
            <div class="card-body">
                <i class="bi bi-heart-fill"></i>
                <p class="card-text">{{ $post->description }}</p>
            </div>
            <hr />
            @foreach($post->comments as $comment)
            <div class="comment-container">
                <div class="d-flex gap-1 align-items-center">
                    <img src="{{ asset('images/users/' . $comment->user->profile) }}" class="comment-image-user" />
                    <p class="m-0">{{ $comment->user->name }} {{ $comment->user->lastname }}</p>
                </div>
                <small>{{ $comment->content }} </small>
                <hr />
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection