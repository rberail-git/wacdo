@extends('template')

@section('content')
    <div class="container">
        <h1>Fonctions</h1><hr>
        <!-- Outer Row -->
        <div class="row justify-content-center">





            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <td class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            <td class="row" style="padding:20px;">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><a href="?sortBy=name&direction={{ request('direction')=='desc' ? 'asc' : 'desc' }}">Nom <i class="fa-solid fa-sort"></i></a></th>
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
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <form method="post" class="" action="{{ url('/fonctions') }}">
                                            @csrf
                                            <td colspan="6">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nouvelle Fonction"  required/>
                                                    @error("name")
                                                    {{ $message }}
                                                    @enderror
                                            </td>
                                            <td><button type="submit" class="btn btn-success">Enregistrer</button></td>


                                        </form>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


@endsection
