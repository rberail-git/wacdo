@extends('template')

@section('content')
    <div class="container">
        <h1>Modifier Collaborateur</h1><hr>

        <form method="post" class="vstack gap-2" action="{{ url('/collaborateurs/'.$user->id.'/edit') }}">
            @csrf
            <div class="row">
            <!-- Name -->
            @include('shared.input',['class'=>'col','label'=>'Nom','name'=>'name','value'=> $user->name])

            <!-- Firstname -->
            @include('shared.input',['class'=>'col','label'=>'Prénom','name'=>'firstname','value'=> $user->firstname])
            </div>
            <div class="row">
            <!-- Email -->
            @include('shared.input',['class'=>'col','label'=>'Adresse Mail','name'=>'email','value'=> $user->email])

            <!-- Role -->
                @if(Auth::User()->role == 'superadmin')
                    @include('shared.select',['class'=>'col','label'=>'Rôle','name'=>'role','options'=>['user'=>'User','admin'=>'Admin','superadmin'=>'SuperAdmin'],'value'=>$valuePoste])
                @else
                    @include('shared.select',['class'=>'col','label'=>'Rôle','name'=>'role','options'=>['user'=>'User','admin'=>'Admin'],'value'=>$valuePoste])
                @endif
            </div>
            <div class="row">
            <!-- Password -->
            @include('shared.input',['class'=>'col','type'=>'password','label'=>'Password','name'=>'password'])

            <!-- Password -->
            @include('shared.input',['class'=>'col','type'=>'password','label'=>'Confirmer Password','name'=>'password_confirmation'])
            </div>

            <!-- Submit -->
            <hr>
            <div class="row gap-2">
            <a href="{{ url('collaborateurs') }}" class="btn btn-primary col">Retour</a>
            <button type="submit" class="btn btn-success col">Enregistrer</button>
            </div>
        </form>


    </div>

@endsection
