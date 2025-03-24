@extends('template')

@section('content')

    <div class="container" style="padding-bottom:20px;">

        <div class="row justify-content-center">

            <div class="col-md-5"><h1>Mon profil</h1></div>

            <div class="col-md-7"></div>
            <hr>
        </div>
        <div class="card o-hidden border-0 shadow-sm p-4 mb-4">
            <div class="card-body p-0">
                <h3 class="card-title">Information Profil</h3>
                <h6 class="card-subtitle mb-2 text-muted">Modification des informations de votre profil et de votre adresse mail.</h6>
                <div class="row" style="padding:20px;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="card o-hidden border-0 shadow-sm p-4 mb-4">
            <div class="card-body p-0">
                <h3 class="card-title">Modification Password</h3>
                <h6 class="card-subtitle mb-2 text-muted">Assurez-vous d'utiliser un mot de passe assez long et aléatoire pour garantir la sécurité.</h6>
                <div class="row" style="padding:20px;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="card o-hidden border-0 shadow-sm p-4 mb-4">
            <div class="card-body p-0">
                <h3 class="card-title">Supprimer mon compte</h3>
                <h6 class="card-subtitle mb-2 text-muted">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.</h6>
                <div class="row" style="padding:20px;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

@endsection
