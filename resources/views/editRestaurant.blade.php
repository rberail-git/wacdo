@extends('template')

@section('content')
    <div class="container">
        <h1>Modifier Restaurant</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/restaurants/'.$restaurant->id.'/edit') }}">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <label for="titre">Nom</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$restaurant->name}}" required/>
                @error("name")
                {{ $message }}
                @enderror
            </div>
            <!-- Adresse -->
            <div class="form-group">
                <label for="titre">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" value="{{$restaurant->adresse}}" required/>
                @error("adresse")
                {{ $message }}
                @enderror
            </div>

            <!-- Code Postal -->
            <div class="form-group">
                <label for="titre">Code Postal</label>
                <input type="text" class="form-control" name="code_postal" id="code_postal" value="{{$restaurant->code_postal}}" required/>
                @error("code_postal")
                {{ $message }}
                @enderror
            </div>
            <!-- Ville -->
            <div class="form-group">
                <label for="titre">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" value="{{$restaurant->ville}}" required/>
                @error("ville")
                {{ $message }}
                @enderror
            </div>


            <!-- Submit -->
            <hr>
            <a href="{{ url('restaurants') }}" class="btn btn-primary">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>


        </form>
    </div>

@endsection
