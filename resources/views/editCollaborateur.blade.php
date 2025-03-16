@extends('template')

@section('content')
    <div class="container">
        <h1>Modifier Collaborateur</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/collaborateurs/'.$user->id.'/edit') }}">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <label for="titre">Nom</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" required/>
                @error("name")
                {{ $message }}
                @enderror
            </div>
            <!-- Firstname -->
            <div class="form-group">
                <label for="titre">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="{{$user->firstname}}" required/>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="titre">Adresse Mail</label>
                <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required/>
            </div>
            <!-- Role -->
            <div class="form-group">
                <label for="titre">Rôle</label>
                <select class="form-control" name="role" id="role" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                </select>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="titre">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="titre">Confirmer Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
            </div>

            <!-- Submit -->
            <hr>
            <a href="{{ url('collaborateurs') }}" class="btn btn-primary">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>



    </div>
    </form>
@endsection
