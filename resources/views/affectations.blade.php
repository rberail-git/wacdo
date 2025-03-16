@extends('template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-2"><h1>Affectations</h1></div>

            <div class="col-md-6"></div>
            <div class="col-md-1 td-link" style="padding-top:15px;"><a href="{{ url('affectations/new') }}" ><i class="fa-solid fa-arrows-down-to-people"></i> Ajouter</a></div>
            @if(!isset($input))
                <div class="col-md-1 td-link" style="padding-top:15px;"><a data-toggle="collapse" href="#formFilter" ><i class="fa-solid fa-filter"></i> Filtres</a></div>
            @else
                <div class="col-md-1 td-link-unset" style="padding-top:15px;"><a  href="{{ url('/affectations/') }}" ><i class="fa-solid fa-filter-circle-xmark"></i> Filtres</a></div>
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

            <hr>
        </div>

        <!-- Outer Row -->
        <div class="row justify-content-center">
           <form method="post" action="{{ route('affectations') }}">
                @csrf
               <div id="formFilter" @class(['row collapse','show' => isset($input)])>
                   <input type="hidden" name="mode" value="{{ $infos['mode'] }}"/>
                    <div class="row" style="padding-left:50px;">

                        <div class="col-md-1 text-center">Du</div>
                        <div class="col-md-2"><input type="date" class="form-control" name="date_debut" id="date_debut"  value="{{ $input['date_debut'] ?? '' }}"></div>
                        <div class="col-md-1 text-center">Au</div>
                        <div class="col-md-2"><input type="date" class="form-control" name="date_fin" id="date_debut"  value="{{ $input['date_fin'] ?? '' }}"/></div>
                        <div class="col-md-1" style="padding-top:10px;">
                            @if(isset($input))
                                @if(isset($input['cdd']))
                                    <input type="checkbox" class="form-check-input" id="cdd" name="cdd" @checked($input['cdd'] == 'on')>
                                @else
                                    <input type="checkbox" class="form-check-input" id="cdd" name="cdd">
                                @endif

                            @else
                                <input type="checkbox" class="form-check-input" id="cdd" name="cdd" checked>
                            @endif

                            <label class="form-check-label" for="cdd">CDD</label></div>
                        <div class="col-md-1" style="padding-top:10px;">
                            @if(isset($input))
                                @if(isset($input['cdi']))
                                    <input type="checkbox" class="form-check-input" id="cdi" name="cdi" @checked($input['cdi'] == 'on')>
                                @else
                                    <input type="checkbox" class="form-check-input" id="cdi" name="cdi">
                                @endif

                            @else
                                <input type="checkbox" class="form-check-input" id="cdi" name="cdi" checked>
                            @endif
                            <label class="form-check-label" for="cdi">CDI</label></div>
                    </div>


                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="fonctions_id"></label>
                        <select class="form-control" name="fonctions_id" id="fonctions_id">
                                    <option value="">Fonctions</option>
                            @foreach($fonctions as $fonction)
                                @if(isset($input))
                                        <option value="{{ $fonction->id }}" @selected( $input['fonctions_id'] == $fonction->id) >{{ $fonction->name }}</option>
                                @else
                                    <option value="{{ $fonction->id }}" >{{ $fonction->name }}</option>
                                @endif



                            @endforeach

                        </select>
                    </div>

                     <div class="col-md-2"><label for="ville"></label>
                        <select class="form-control" name="ville" id="ville">
                            <option value="">Ville</option>
                            @foreach($restaurantsDistinctVille as $restaurantVille)
                                @if(isset($input))
                                    <option value="{{ $restaurantVille }}" @selected( $input['ville'] == $restaurantVille)>{{ $restaurantVille }}</option>
                                @else
                                    <option value="{{ $restaurantVille }}">{{ $restaurantVille }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2"><br><button type="submit" class="btn btn-xs btn-success">Filtrer</button></div>

                </div>
            </form>





            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                            <div class="row" style="padding:20px;">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><a href="?sortBy=salarie&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Salarié <i class="fa-solid fa-sort"></i></a></th>
                                        <th scope="col"><a href="?sortBy=restaurant&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Restaurant <i class="fa-solid fa-sort"></i></a></th>
                                        <th scope="col"><a href="?sortBy=fonction&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Fonction <i class="fa-solid fa-sort"></i></a></th>
                                        <th scope="col"><a href="?sortBy=debut&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Date Début <i class="fa-solid fa-sort"></i></a></th>
                                        <th scope="col"><a href="?sortBy=fin&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Date Fin <i class="fa-solid fa-sort"></i></a></th>
                                        <th scope="col"></th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($affectations as $affectation)

                                        @if($infos['mode'] == 'on')
                                            <tr @class(['bg-tr-inactive' => $affectation->active == false])>
                                            <th scope="row">{{$affectation->id}}</th>

                                            <td>{{$affectation->user?->name}} {{$affectation->user?->firstname}}</td>
                                            <td>{{$affectation->restaurant?->name}}</td>
                                            <td>{{$affectation->fonction?->name}}</td>
                                            <td>{{$affectation->date_debut}}</td>
                                            <td>{{$affectation->date_fin}}</td>
                                            <td></td>
                                            <td><a href="{{ url('/affectations/'.$affectation->id.'/edit')}}"><i class="fa-solid fa-pen"></i></a> <a href="{{ url('/affectations/'.$affectation->id.'/delete')}}"><span style="color:red;padding-left:15px;"><i class="fa-solid fa-trash"></i></span></a></td>
                                        </tr>
                                        @elseif($infos['mode'] == 'off')
                                            <tr @class(['hidden' => $affectation->active == false])>
                                                <th scope="row">{{$affectation->id}}</th>

                                                <td>{{$affectation->user?->name}} {{$affectation->user?->firstname}}</td>
                                                <td>{{$affectation->restaurant?->name}}</td>
                                                <td>{{$affectation->fonction?->name}}</td>
                                                <td>{{$affectation->date_debut}}</td>
                                                <td>{{$affectation->date_fin}}</td>
                                                <td></td>
                                                <td><a href="{{ url('/affectations/'.$affectation->id.'/edit')}}"><i class="fa-solid fa-pen"></i></a> <a href="{{ url('/affectations/'.$affectation->id.'/delete')}}"><span style="color:red;padding-left:15px;"><i class="fa-solid fa-trash"></i></span></a></td>
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
