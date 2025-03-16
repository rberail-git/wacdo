@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fa-solid fa-user" style="padding-right:20px;"></i>{{ $user->name }} {{ $user->firstname }}</h1>
                <span style="font-size: 1em;"><i class="fa-solid fa-envelope" style="color:red;"></i> {{ $user->email }}</span>

            </div>


        </div>
        <hr>



    </div>



    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h3>Affectations </h3>

            </div>

            <div class="col-md-7 td-link" style="text-align:left;margin-bottom:0px;">
            </div>
            @if(!isset($input))
                <div class="col-md-1 td-link" style="padding-top:15px;"><a data-toggle="collapse" href="#formFilter" ><i class="fa-solid fa-filter"></i> Filtres</a></div>
            @else
                <div class="col-md-1 td-link-unset" style="padding-top:15px;"><a  href="{{ url( "/collaborateurs/".$user->id."/detail" ) }}" ><i class="fa-solid fa-filter-circle-xmark"></i> Filtres</a></div>
            @endif
            <div class="col-md-2 td-link" style="padding-top:15px;">
                <form action="" method="get">
                    <div class="form-check form-switch">

                        @if($infos['mode'] == 'on')
                            <input class="form-check-input" type="checkbox" role="switch" name="mode" id="mode" onchange="this.form.submit()" checked>
                        @else
                            <input class="form-check-input" type="checkbox" role="switch" name="mode" id="mode" onchange="this.form.submit()">
                        @endif

                        <label class="form-check-label" for="mode">Historique</label>
                    </div>
                </form>

            </div>
        </div>
        <hr>

        <div class="row justify-content-center">
            <form method="post" action="{{url( "/collaborateurs/".$user->id."/detail" )}}">
                @csrf
                <div id="formFilter" @class(['row collapse','show' => isset($input)])>
                    <div class="row" style="padding-left:50px;">

                        <input type="hidden" name="mode" value="{{ $infos['mode'] }}"/>
                        <div class="col-md-2"><input type="text" class="form-control" name="fonction" id="fonction" placeholder="Poste" value="{{ $input['fonction'] ?? '' }}"/>
                            @error("name")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2 text-right pt-1">Date de début :</div>
                        <div class="col-md-2"><input type="date" class="form-control" name="date_debut" id="date_debut" placeholder="Date Début" value="{{ $input['date_debut'] ?? '' }}"/>
                            @error("date_debut")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2"><button type="submit" class="btn btn-xs btn-success">Filtrer</button></div>

                    </div>






                </div>
            </form>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9"></div>

            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="padding:20px;">
                            <table class="table table-hover">
                                <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Restaurant</th>
                                    <th scope="col">Fonction</th>
                                    <th scope="col">Date Début</th>
                                    <th scope="col">Date Fin</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($affectations as $affectation)

                                        @if($infos['mode'] == 'on')
                                            <tr @class(['bg-tr-inactive' => $affectation->active == false])>
                                                <td>{{ $affectation->id }}</td>
                                                <td>{{ $affectation->restaurant?->name }}</td>
                                                <td>{{ $affectation->fonction?->name }}</td>
                                                <td>{{ $affectation->date_debut }}</td>
                                                <td>{{ $affectation->date_fin }}</td>
                                                <td>
                                                    @if($affectation->active)
                                                        <a href="#" data-toggle="modal" data-target="#formNewAffect_{{$affectation->id}}"><i class="fa-solid fa-pen"></i></a>
                                                        <div class="modal fade" id="formNewAffect_{{$affectation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $user->name }} {{ $user->firstname }} - Affectation n°{{$affectation->id}}</h5>

                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" class="vstack gap-2" action="{{ url('/affectations/'.$affectation->id.'/edit') }}">
                                                                            @csrf
                                                                            <div class="form-group">

                                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">


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
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success">Enregistrer</button>


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif($infos['mode'] == 'off')
                                            <tr @class(['hidden' => $affectation->active == false])>
                                                <td>{{ $affectation->id }}</td>
                                                <td>{{ $affectation->restaurant?->name }}</td>
                                                <td>{{ $affectation->fonction?->name }}</td>
                                                <td>{{ $affectation->date_debut }}</td>
                                                <td>{{ $affectation->date_fin }}</td>
                                                <td>
                                                    @if($affectation->active)
                                                        <a href="#" data-toggle="modal" data-target="#formNewAffect_{{$affectation->id}}"><i class="fa-solid fa-pen"></i></a>
                                                        <div class="modal fade" id="formNewAffect_{{$affectation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $user->name }} {{ $user->firstname }} - Affectation n°{{$affectation->id}}</h5>

                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" class="vstack gap-2" action="{{ url('/affectations/'.$affectation->id.'/edit') }}">
                                                                            @csrf
                                                                            <div class="form-group">

                                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">


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
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success">Enregistrer</button>


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif


                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection
