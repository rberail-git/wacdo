@extends('template')

@section('content')
    <div class="container">
        <h1>Nouveau Collaborateur</h1><hr>

    <form method="post" class="vstack gap-2" action="{{ route('newCollaborateur') }}">
        @csrf
        <!-- Name -->
        <div class="form-group">
            <label for="titre">Nom</label>
            <input type="text" class="form-control" name="name" id="name" required/>
            @error("name")
                {{ $message }}
            @enderror
        </div>
        <!-- Firstname -->
        <div class="form-group">
            <label for="titre">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" required/>
            @error("firstname")
            {{ $message }}
            @enderror
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="titre">Adresse Mail</label>
            <input type="email" class="form-control" name="email" id="email" required/>
            @error("email")
            {{ $message }}
            @enderror
        </div>
        <!-- Role -->
        <div class="form-group">
            <label for="titre">Rôle</label>
            <select class="form-control" name="role" id="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>
            </select>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="titre">Password</label>
            <input type="password" class="form-control" name="password" id="password" />
            @error("password")
            {{ $message }}
            @enderror
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="titre">Confirmer Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
            @error("password_confirmation")
            {{ $message }}
            @enderror
        </div>

        <!-- Submit -->
       <hr>
            <a href="{{ url('collaborateurs') }}" class="btn btn-primary">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>



        </div>
    </form>
@endsection
