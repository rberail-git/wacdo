<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>WACDO Gestion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <!-- Custom styles for this template -->

    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
</head>

<body>

<header class="p-3 mb-3 border-bottom">
    <div class="container">

        @auth
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="{{ asset('img/wacdo_logo.jpg') }}" style="width:50px;"/>
            </a>
@php
$route = request() -> route() -> getName();
@endphp

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                <li><a @class(['nav-link px-2','link-secondary' => str_contains($route,'accueil')]) href="{{ url('/') }}" class="nav-link px-2 link-dark" >Accueil</a></li>
                <li><a @class(['nav-link','px-2','link-secondary' => str_contains($route,'estaurant')]) href="{{ url('/restaurants') }}" class="nav-link px-2 link-dark">Restaurants</a></li>
                <li><a @class(['nav-link','px-2','link-secondary' => str_contains($route,'ollaborateur')]) href="{{ url('/collaborateurs') }}" class="nav-link px-2 link-dark">Collaborateurs</a></li>
                <li><a @class(['nav-link','px-2','link-secondary' => str_contains($route,'fonction')]) href="{{ url('/fonctions') }}" class="nav-link px-2 link-dark">Fonctions</a></li>
                <li><a @class(['nav-link','px-2','link-secondary' => str_contains($route,'ffectation')]) href="{{ url('/affectations') }}" class="nav-link px-2 link-dark">Affectations</a></li>
            </ul>

                <div class="dropdown text-end" style="padding-left:0px;">
                    <a href="{{ url('/login') }}" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span style="padding-right: 10px;">{{\Illuminate\Support\Facades\Auth::user()->name }} {{\Illuminate\Support\Facades\Auth::user()->firstname}}</span>
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">

                        <li><form action="{{ route('logout') }}" method="post">

                                @csrf
                                <button class="btn nav-link p-2">Se déconnecter</button>

                            </form></li>

                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(($errors->any()))
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"><i class="fa-solid fa-circle-exclamation"></i> Erreurs</h4>
            <ul class="my-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')


</main>

<footer class="footer">
    <div class="container text-center ">
        <span class="text-muted">WACDO Gestion 2025 - Réalisé sous Laravel</span>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js" integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    new TomSelect('select[multiple]',{plugins: {remove_button: {title: 'Supprimer'}}})
</script>

</body>
</html>
