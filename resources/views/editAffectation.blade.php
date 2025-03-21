@extends('template')

@section('content')
    <div class="container">
        <h1>Modification Affectation</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/affectations/'.$affectation->id.'/edit') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">Collaborateur</label>
                <select class="form-control" name="user_id" id="user_id" required>

                    @foreach($users as $user)
                        @if($user->id == $affectation->user_id)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif

                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="restaurants_id">Restaurants</label>
                <select class="form-control" name="restaurants_id" id="restaurants_id">
                    <option value="">Choisir</option>
                    @foreach($restaurants as $restaurant)
                        @if($restaurant->id == $affectation->restaurants_id)
                            <option value="{{ $restaurant->id }}" selected>{{ $restaurant->name }}</option>
                        @else
                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endif

                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="fonctions_id">Fonctions</label>
                <select class="form-control" name="fonctions_id" id="fonctions_id" required>

                    @foreach($fonctions as $fonction)
                        @if($fonction->id == $affectation->fonctions_id)
                            <option value="{{ $fonction->id }}" selected>{{ $fonction->name }}</option>
                        @else
                            <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                        @endif

                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="date_debut">Date Début</label>
                <input type="date" class="form-control" name="date_debut" id="date_debut" value="{{ $affectation->date_debut }}" required/>
                @error("date_debut")
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="date_fin">Date Fin</label>
                <input type="date" class="form-control" name="date_fin" id="date_fin" value="{{ $affectation->date_fin }}"/>
                @error("date_fin")
                {{ $message }}
                @enderror
            </div>


            <!-- Submit -->
            <hr>
            <div class="row gap-2">
                <a href="{{ url('affectations') }}" class="btn btn-primary col">Retour</a>
                <button type="submit" class="btn btn-success col">Enregistrer</button>
            </div>


        </form>
    </div>

@endsection
