@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fa-solid fa-shop" style="padding-right:20px;"></i>{{ $restaurant->name }}</h1>
                <span style="font-size: 1em;"><i class="fa-solid fa-location-dot" style="color:red;"></i> {{ $restaurant->adresse }} {{ $restaurant->code_postal }} {{ $restaurant->ville }}</span>

            </div>

            <div class="col-md-5" style="text-align:right;margin-bottom:0px;">
            </div>
        </div>
        <hr>
        <!-- Outer Row -->

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row" style="padding:20px;">

                    <div class="col-md-3 text-center">
                        <div class="card mb-4 rounded-3 shadow-sm border-success">
                            <div class="card-header py-1 text-white bg-success border-success">
                                <h5 class="my-0 fw-normal">Manager</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title"><i class="fa-solid fa-user"></i><span style="padding-left:15px;font-size: 0.8em;">
                                        {{ $infos['manager'] }}

                                    </span></h3>

                                <!--<button type="button" class="w-100 btn btn-sm btn-outline-success">Afficher</button>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="card mb-4 rounded-3 shadow-sm border-success">
                            <div class="card-header py-1 text-white bg-success border-success">
                                <h5 class="my-0 fw-normal">Salarié Actif</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">{{ $infos['nbActif'] }}</h3>

                                <!--<button type="button" class="w-100 btn btn-sm btn-outline-success">Afficher</button>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="card mb-4 rounded-3 shadow-sm border-success">
                            <div class="card-header py-1 text-white bg-success border-success">
                                <h5 class="my-0 fw-normal">CDD</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">{{ $infos['nbCDD'] }}</h3>

                                <!--<button type="button" class="w-100 btn btn-sm btn-outline-success">Afficher</button>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="card mb-4 rounded-3 shadow-sm border-success">
                            <div class="card-header py-1 text-white bg-success border-success">
                                <h5 class="my-0 fw-normal">CDI</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">{{ $infos['nbCDI'] }}</h3>

                                <!--<button type="button" class="w-100 btn btn-sm btn-outline-success">Afficher</button>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="card mb-4 rounded-3 shadow-sm border-success">
                            <div class="card-header py-1 text-white bg-success border-success">
                                <h5 class="my-0 fw-normal">Fin de contrat <small>(<3 jours)</small></h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">{{ $infos['nbFinContrat'] }}</h3>

                                <!--<button type="button" class="w-100 btn btn-sm btn-outline-success">Afficher</button>-->
                            </div>
                        </div>
                    </div>


                    </div>

            </div>
            </div>

        </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h3>Collaborateurs </h3>

            </div>

            <div class="col-md-7 td-link" style="text-align:left;margin-bottom:0px;">
            </div>
            @if(!isset($input))
                <div class="col-md-1 td-link" style="padding-top:15px;"><a data-toggle="collapse" href="#formFilter" ><i class="fa-solid fa-filter"></i> Filtres</a></div>
            @else
                <div class="col-md-1 td-link-unset" style="padding-top:15px;"><a  href="{{ url( "/restaurants/".$restaurant->id."/detail" ) }}" ><i class="fa-solid fa-filter-circle-xmark"></i> Filtres</a></div>
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
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <form method="post" action="{{url( "/restaurants/".$restaurant->id."/detail" )}}">
                @csrf
                <div id="formFilter" @class(['row collapse','show' => isset($input)])>
                    <div class="row" style="padding-left:50px;">

                        <input type="hidden" name="mode" value="{{ $infos['mode'] }}"/>
                        <div class="col-md-2"><input type="text" class="form-control" name="name" id="name" placeholder="Nom" value="{{ $input['name'] ?? '' }}"/>
                            @error("name")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" name="fonction" id="fonction" placeholder="Poste" value="{{ $input['fonction'] ?? '' }}"/>
                            @error("fonction")
                            {{ $message }}
                            @enderror
                        </div>
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
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Poste</th>
                                    <th scope="col">Date Début</th>
                                    <th scope="col">Date Fin</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($affectations as $affectation)

                                    @if($infos['mode'] == 'on')
                                        <tr @class(['bg-tr-inactive' => $affectation->active == false])>
                                            <td>{{ $affectation->user->id }}</td>
                                            <td>{{ $affectation->user->name }}</td>
                                            <td>{{ $affectation->user->firstname }}</td>
                                            <td>{{ $affectation->user->email }}</td>
                                            <td>{{ $affectation->fonction->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($affectation->date_debut)->format('d/m/Y') }}</td>
                                            <td> @if(isset($affectation->date_fin))
                                                  {{ \Carbon\Carbon::parse($affectation->date_fin)->format('d/m/Y') }}
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @elseif($infos['mode'] == 'off')
                                        <tr @class(['hidden' => $affectation->active == false])>
                                            <td>{{ $affectation->user->id }}</td>
                                            <td>{{ $affectation->user->name }}</td>
                                            <td>{{ $affectation->user->firstname }}</td>
                                            <td>{{ $affectation->user->email }}</td>
                                            <td>{{ $affectation->fonction->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($affectation->date_debut)->format('d/m/Y') }}</td>
                                            <td> @if(isset($affectation->date_fin))
                                                    {{ \Carbon\Carbon::parse($affectation->date_fin)->format('d/m/Y') }}
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endif


                                @endforeach



                                </tbody>
                                <tr>
                                    <td colspan="8" style="text-align: right;">
                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#formNewAffect">Nouvelle affectation</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- MODAL NEW AFFECTATION -->
        <div class="modal fade" id="formNewAffect" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nouvelle Affectation - {{ $restaurant->name }}</h5>

                    </div>
                    <form method="post" class="vstack gap-2" action="{{ url('/affectations/new') }}">
                        <div class="modal-body">


                                @csrf
                                <input type="hidden" class="form-control" name="restaurants_id_multi[]" value="{{ $restaurant->id }}"/>

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

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIN MODAL -->

    </div>
@endsection
