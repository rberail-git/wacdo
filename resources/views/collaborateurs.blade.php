@extends('template')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-2"><h1>Collaborateurs</h1></div>
            <div class="col-md-6"></div>
            <div class="col-md-1 td-link" style="padding-top:15px;"><a href="{{ url('collaborateurs/new') }}" ><i class="fa-solid fa-user-plus"></i> Ajouter</a></div>
            @if(!isset($input))
                <div class="col-md-1 td-link" style="padding-top:15px;"><a data-toggle="collapse" href="#formFilter" ><i class="fa-solid fa-filter"></i> Filtres</a></div>
            @else
                <div class="col-md-1 td-link-unset" style="padding-top:15px;"><a  href="{{ url( "/collaborateurs/" ) }}" ><i class="fa-solid fa-filter-circle-xmark"></i> Filtres</a></div>
            @endif
            <div class="col-md-2 td-link" style="padding-top:15px;">
                <form action="" method="get">
                    <div class="form-check form-switch">

                        @if($infos['mode'] == 'on')
                            <input class="form-check-input" type="checkbox" role="switch" name="mode" id="mode" onchange="this.form.submit()" checked>
                        @else
                            <input class="form-check-input" type="checkbox" role="switch" name="mode" id="mode" onchange="this.form.submit()">
                        @endif

                        <label class="form-check-label" for="mode">Non affecté</label>
                    </div>
                </form>

            </div>

                <hr>
        </div>
        <!-- Filtre Collapse -->
        <div class="row justify-content-center">
            <form method="post" action="{{url( "/collaborateurs" )}}">
                @csrf
                <div id="formFilter" @class(['row collapse','show' => isset($input) | $errors->any()])>
                    <div class="row" style="padding-left:50px;">

                        <input type="hidden" name="mode" value="{{ $infos['mode'] }}"/>
                        <div class="col-md-2"><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nom" value="{{ $input['name'] ?? '' }}"/>

                        </div>
                        <div class="col-md-2"><input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="Prénom" value="{{ $input['firstname'] ?? '' }}"/>

                        </div>
                        <div class="col-md-2"><input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $input['email'] ?? '' }}"/>

                        </div>
                        <div class="col-md-2"><button type="submit" class="btn btn-xs btn-success">Filtrer</button></div>

                    </div>
                </div>
            </form>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 table-responsive">
                    <!-- Nested Row within Card Body -->
                    <div class="row" style="padding:20px;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><a href="?sortBy=nom&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Nom <i class="fa-solid fa-sort"></i></a></th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Première Embauche</th>
                                <th scope="col">Fonction</th>
                                <th scope="col">Affectation</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr @class(['hidden' => !empty($user->userRestaurants->all()) && $infos['mode']=='on'])>
                                    <th scope="row">{{$user->id}}</th>
                                    <td class="td-link"><a href="{{ url('/collaborateurs/'.$user->id.'/detail') }}">{{$user->name}} {{$user->firstname}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        @foreach($user->affectations as $affectation)
                                            {{ $affectation->date_debut }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($user->userFonctions as $fonction)
                                            {{ $fonction->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($user->userRestaurants as $restaurant)
                                            <span class="badge bg-success">{{ $restaurant->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('edit',$user)
                                        <a href="{{ url('/collaborateurs/'.$user->id.'/edit')}}"><i class="fa-solid fa-pen"></i></a>
                                        @endcan
                                        @can('delete',$user)
                                        <a href="{{ url('/collaborateurs/'.$user->id.'/delete')}}"><span style="color:red;padding-left:15px;"><i class="fa-solid fa-trash"></i></span></a>
                                            @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
