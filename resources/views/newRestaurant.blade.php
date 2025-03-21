@extends('template')

@section('content')
    <div class="container">
        <h1>Nouveau Restaurant</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/restaurants/new') }}">
            @csrf
            <!-- Name -->
            @include('shared.input',['label'=>'Nom','name'=>'name'])

            <!-- Adresse -->
            @include('shared.input',['label'=>'Adresse','name'=>'adresse'])

            <!-- Code Postal -->
            @include('shared.input',['label'=>'Code Postal','name'=>'code_postal'])

            <!-- Ville -->
            @include('shared.input',['label'=>'Ville','name'=>'ville'])



            <!-- Submit -->
            <hr>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ url('restaurants') }}" class="btn btn-primary">Retour</a>
        </form>
    </div>
@endsection
