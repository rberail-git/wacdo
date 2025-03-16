@extends('template')

@section('content')
    <div class="container">
        <h1>Nouveau Restaurant</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/restaurants/new') }}">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name"  required/>
                @error("name")
                {{ $message }}
                @enderror
            </div>
            <!-- Adresse -->
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" required/>
                @error("adresse")
                {{ $message }}
                @enderror
            </div>

            <!-- Code Postal -->
            <div class="form-group">
                <label for="code_postal">Code Postal</label>
                <input type="text" class="form-control" name="code_postal" id="code_postal" required/>
                @error("code_postal")
                {{ $message }}
                @enderror
            </div>
            <!-- Ville -->
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" required/>
                @error("ville")
                {{ $message }}
                @enderror
            </div>


            <!-- Submit -->
            <hr>
            <a href="{{ url('restaurants') }}" class="btn btn-primary">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>



    </div>
    </form>
@endsection
