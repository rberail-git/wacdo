@extends('template')

@section('content')
    <div class="container">
        <h1>Fonctions</h1><hr>
        <!-- Outer Row -->
        <div class="row justify-content-center">


                <form method="post" class="" action="{{ url('/fonctions') }}">
                    @csrf
                    <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nouvelle Fonction"  required/>
                        @error("name")
                        {{ $message }}
                        @enderror</div>
                    <div class="col-md-2"><button type="submit" class="btn btn-success">Enregistrer</button></div>
                    <div class="col-md-6"></div>
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
                                        <th scope="col">Nom</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fonctions as $fonction)
                                        @if($fonction->id == $oldFonction->id)
                                            <form action="" method="post">
                                                @csrf
                                                <tr>
                                                    <th scope="row">{{$oldFonction->id}}</th>
                                                    <td><input type="text" class="form-control" name="name" id="name" value="{{$oldFonction->name}}" required/></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><button type="submit" class="btn btn-outline-success btn-sm  ">valider</button><span><a href="{{url('/fonctions')}}" class="btn btn-outline-info btn-sm">retour</a></span><span><a href="{{ url('/fonctions/'.$fonction->id.'/delete')}}" class="btn btn-outline-danger btn-sm">supprimer</a></span></td>
                                                </tr>
                                            </form>

                                        @else
                                        <tr>
                                            <th scope="row">{{$fonction->id}}</th>
                                            <td>{{$fonction->name}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="{{ url('/fonctions/'.$fonction->id.'/edit')}}"><i class="fa-solid fa-pen"></i></a> <a href="{{ url('/fonctions/'.$fonction->id.'/delete')}}"><span style="color:red;padding-left:15px;"><i class="fa-solid fa-trash"></i></span></a></td>
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
