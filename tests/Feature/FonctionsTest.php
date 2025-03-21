<?php
use App\Models\User;
use App\Models\Fonctions;

it('Affichage du listing des fonctions', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response = $this->get('/fonctions');
    $response->assertStatus(200);
    $response->assertViewIs('fonctions');
    $response->assertSeeText('Fonctions');
    $response->assertSeeText('Manager');
});

it('OK - Ajout fonction', function () {
    ///CREATION DE LA DB ET CONNEXION A L'APP////
    $this->seed();//Initialisation de la DB
    $user = User::factory()->state(['role' => 'admin'])->create();//Creation d'un user Admin
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    ////////////////////////////////////////////
    ///
    $this->assertAuthenticated();//Vérification de l'authentification


    /// AJOUT D'UNE NOUVELLE FONCTION
    $response = $this->post('/fonctions', [
        'name' => 'Fonction Test',

    ]);
    $response->assertRedirect('/fonctions');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});

it('Erreur - Ajout fonction', function () {
    ///CREATION DE LA DB ET CONNEXION A L'APP////
    $this->seed();//Initialisation de la DB
    $user = User::factory()->state(['role' => 'admin'])->create();//Creation d'un user Admin
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    ////////////////////////////////////////////
    ///
    $this->assertAuthenticated();//Vérification de l'authentification


    /// AJOUT D'UNE NOUVELLE FONCTION
    $response = $this->post('/fonctions', [
        'name' => 'Manager',

    ]);

    $response->assertSessionHasErrors('name');
    $response->assertSessionHasInput('name','Manager');
});

it('OK - Edit fonction', function () {
    ///CREATION DE LA DB ET CONNEXION A L'APP////
    $this->seed();//Initialisation de la DB
    $user = User::factory()->state(['role' => 'admin'])->create();//Creation d'un user Admin
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    ////////////////////////////////////////////
    ///
    $this->assertAuthenticated();//Vérification de l'authentification

    $fonction = Fonctions::query()->first();
    /// AJOUT D'UNE NOUVELLE FONCTION
    $response = $this->post('/fonctions/'.$fonction->id.'/edit', [
        'name' => 'Fonction Edit',

    ]);
    $response->assertRedirect('/fonctions');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});

it('Erreur - Edit fonction', function () {
    ///CREATION DE LA DB ET CONNEXION A L'APP////
    $this->seed();//Initialisation de la DB
    $user = User::factory()->state(['role' => 'admin'])->create();//Creation d'un user Admin
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    ////////////////////////////////////////////
    ///
    $this->assertAuthenticated();//Vérification de l'authentification

    $fonction = Fonctions::query()->first();
    /// AJOUT D'UNE NOUVELLE FONCTION
    $response = $this->post('/fonctions/'.$fonction->id.'/edit', [
        'name' => $fonction->name,

    ]);

    $response->assertSessionHasErrors('name');
    $response->assertSessionHasInput('name');

});

it('Ok - Delete fonction', function () {
    ///CREATION DE LA DB ET CONNEXION A L'APP////
    $this->seed();//Initialisation de la DB
    $user = User::factory()->state(['role' => 'admin'])->create();//Creation d'un user Admin
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    ////////////////////////////////////////////
    ///
    $this->assertAuthenticated();//Vérification de l'authentification


    $fonction = Fonctions::query()->first();

    //////////////////////////////////
    ///
    /// SUPPRESSION RESTAURANT
    $response = $this->get('/fonctions/'.$fonction->id.'/delete');
    $response->assertRedirect('/fonctions');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});
