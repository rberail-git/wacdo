@extends('template')

@section('content')
    <div class="container">
        <h1>Nouvelle Affectation</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/affectations/new') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">Collaborateur</label>
                <select class="form-control" name="user_id" id="user_id" required>
                    <option value="">Choisir</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="restaurants_id">Restaurants</label>
                <select class="form-control" name="restaurants_id_multi[]" id="restaurants_id" multiple>
                    <option value="">Choisir</option>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="fonctions_id">Fonctions</label>
                <select class="form-control" name="fonctions_id" id="fonctions_id" required>
                    <option value="">Choisir</option>
                    @foreach($fonctions as $fonction)
                        <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="date_debut">Date Début</label>
                <input type="date" class="form-control" name="date_debut" id="date_debut" required/>
                @error("date_debut")
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="date_fin">Date Fin</label>
                <input type="date" class="form-control" name="date_fin" id="date_fin"/>
                @error("date_fin")
                {{ $message }}
                @enderror
            </div>


            <!-- Submit -->
            <hr>
            <a href="{{ url('affectations') }}" class="btn btn-primary">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>


        </form>
    </div>

@endsection
