@extends('template')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

                <div class="col-md-2"><h1>Restaurants</h1></div>

                <div class="col-md-8"></div>
                <div class="col-md-1 td-link" style="padding-top:15px;"><a href="{{ url('restaurants/new') }}" ><i class="fa-solid fa-shop"></i> Ajouter</a></div>
                @if(!isset($input))
                <div class="col-md-1 td-link" style="padding-top:15px;"><a data-toggle="collapse" href="#formFilter" ><i class="fa-solid fa-filter"></i> Filtres</a></div>
                @else
                <div class="col-md-1 td-link-unset" style="padding-top:15px;"><a  href="{{ url('/restaurants/') }}" ><i class="fa-solid fa-filter-circle-xmark"></i> Filtres</a></div>
                @endif


            <hr>
        </div>


            <!-- Filtre Collapse -->
        <div class="row justify-content-center">
            <form method="post" action="{{ route('restaurants') }}">
                @csrf
                <div id="formFilter" @class(['row collapse','show' => isset($input)])>
                    <div class="row" style="padding-left:50px;">


                        <div class="col-md-2"><input type="text" class="form-control" name="name" id="name" placeholder="Nom" value="{{ $input['name'] ?? '' }}"/>
                            @error("name")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" name="code_postal" id="code_postal" placeholder="Code Postal" value="{{ $input['code_postal'] ?? '' }}"/>
                            @error("code_postal")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="{{ $input['ville'] ?? '' }}"/>
                            @error("ville")
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-2"><button type="submit" class="btn btn-xs btn-success">Filtrer</button></div>

                    </div>
                </div>
            </form>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row" style="padding:20px;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><a href="?sortBy=name&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Nom <i class="fa-solid fa-sort"></i></a></th>
                                <th scope="col"><a href="?sortBy=adresse&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Adresse <i class="fa-solid fa-sort"></i></a></th>
                                <th scope="col"><a href="?sortBy=code_postal&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Code Postal <i class="fa-solid fa-sort"></i></a></th>
                                <th scope="col"><a href="?sortBy=ville&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Ville <i class="fa-solid fa-sort"></i></a></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurants as $restaurant)
                                <tr>
                                    <th scope="row">{{$restaurant->id}}</th>
                                    <td class="td-link">
                                        <a href=" {{url( "/restaurants/".$restaurant->id."/detail" )}}">{{$restaurant->name}}</a>
                                    </td>
                                    <td>{{$restaurant->adresse}}</td>
                                    <td>{{$restaurant->code_postal}}</td>
                                    <td>{{$restaurant->ville}}</td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="{{ url('/restaurants/'.$restaurant->id.'/edit')}}"><i class="fa-solid fa-pen"></i></a> <a href="{{ url('/restaurants/'.$restaurant->id.'/delete')}}"><span style="color:red;padding-left:15px;"><i class="fa-solid fa-trash"></i></span></a></td>
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
