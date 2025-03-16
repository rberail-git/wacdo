@extends('template')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-login-image">
                                <img src="{{ asset('img/wacdo_logo.jpg') }}" alt="photo profil berail remi" class="img-fluid img-thumbnail">
                            </div>
                            <!--<div class="col-sm-5 .d-block .d-sm-none bg-login-image">
                               <img src="{{ asset('img/wacdo_logo.jpg') }}" alt="photo profil berail remi" class="img-thumbnail">
                           </div>-->
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">

                                        <h1 class="h2 text-gray-900">Bienvenue chez WACDO Gestion</h1>

                                    </div>

                                    <div class="text-center">
                                        <p class="fs-6 fw-light fst-italic text-gray-400">Gestionnaire de ressources pour les restaurants wacdo</p>
                                    </div>
                                    <hr>
                                    @guest
                                    <div class="text-center">
                                        <form method="post" class="vstack gap-2" action="{{ route('login') }}">
                                            @csrf

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="titre">Adresse Mail</label>
                                                <input type="email" class="form-control" name="email" id="email" required/>
                                                @error("email")
                                                {{ $message }}
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label for="titre">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" />
                                                @error("password")
                                                {{ $message }}
                                                @enderror
                                            </div>


                                            <!-- Submit -->


                                            <button type="submit" class="btn btn-success" style="margin-top:20px;">Me connecter</button>



                                    </div>
                                        </form>
                                    </div>
                                        @endguest


                                </div>








                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
