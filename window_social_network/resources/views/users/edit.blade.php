@extends('layouts.app')
@section('content')
<div class="m-auto w-50 edit-container">
    @if(Auth::user()->id == $user->id)
    <h5>Modifica i tuoi dati</h5>
    <div class="personal-information">
        <div class="d-flex gap-2">
            <strong>
                <p>ID: </p>
            </strong>
            <p>#{{ $user->id }}</p>
        </div>
        <div class="d-flex gap-2">
            <strong>
                <p>Nome: </p>
            </strong>
            <p>{{ $user->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <strong>
                <p>Cognome: </p>
            </strong>
            <p>{{ $user->lastname }}</p>
        </div>
        <div class="d-flex gap-2">
            <strong>
                <p>Email: </p>
            </strong>
            <p>{{ $user->email }}</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                <i class="bi bi-pencil-fill"></i> Modifica
            </button>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteExampleModal{{ $user->id }}">
                <i class="bi bi-exclamation-triangle-fill"></i> Elimina
            </button>
            <!--Edit Modal -->
            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $user->id }}">Modifica i dati personali</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" class="form-control form-control-sm mb-2 @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="lastname" class="form-label">Cognome</label>
                                <input type="text" name="lastname" class="form-control form-control-sm mb-2 @error('lastname') is-invalid @enderror" id="lastname" value="{{ $user->lastname }}" required>
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control form-control-sm mb-2 @error('password') is-invalid @enderror" id="password" placeholder="Inserire password per confermare modifiche / crea nuova password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="profile" class="form-label">Immagine Profilo</label>
                                <input type="file" name="profile" id="profile" class="form-control form-control-sm mb-2">
                                <button type="submit" class="btn btn-sm btn-warning float-end">Modifica</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteExampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteExampleModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="deleteExampleModalLabel{{ $user->id }}"><i class="bi bi-cone-striped"></i> L'azione non sarà reversibile <i class="bi bi-cone-striped"></i></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger float-end">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection