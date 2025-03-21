<?php
use App\Models\User;
use App\Models\Restaurants;
use App\Models\Fonctions;
use App\Models\Affectations;

it('Affichage du listing des restaurants', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response = $this->get('/restaurants');
    $response->assertStatus(200);
    $response->assertViewIs('restaurants');
    $response->assertSeeText('Restaurants');
    $response->assertSeeText('Wacdo Carcassonne');
});

it('OK - Ajout restaurant', function () {
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

    ///AFFICHAGE DE LA PAGE D'AJOUT
    $response = $this->get('/restaurants/new');
    $response->assertStatus(200);
    //////////////////////////////////
    ///
    /// AJOUT D'UN NOUVEAU RESTAURANT
    $response = $this->post('/restaurants/new', [
        'name' => 'Wacdo Test',
        'adresse' => '12 rue du test',
        'code_postal' => '12345',
        'ville' => 'testCity',
    ]);
    $response->assertRedirect('/restaurants');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});

it('Erreur Code Postal - Ajout restaurant', function () {
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

    ///AFFICHAGE DE LA PAGE D'AJOUT
    $response = $this->get('/restaurants/new');
    $response->assertStatus(200);
    //////////////////////////////////
    ///
    /// AJOUT D'UN NOUVEAU RESTAURANT
    $response = $this->post('/restaurants/new', [
        'name' => 'Wacdo Test',
        'adresse' => '12 rue du test',
        'code_postal' => '12',///Code Postal invalide
        'ville' => 'testCity',
    ]);
    $response->assertRedirect('/restaurants/new');
    $response->assertSessionHasErrors('code_postal');
    $response->assertSessionHasInput('code_postal','12');
});

it('OK - Edit restaurant', function () {
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

    ///AFFICHAGE DE LA PAGE D'EDIT
    $restaurant = Restaurants::query()->first();
    $response = $this->get('/restaurants/'.$restaurant->id.'/edit');
    $response->assertStatus(200);
    //////////////////////////////////
    ///
    /// EDITION RESTAURANT
    $response = $this->put('/restaurants/'.$restaurant->id.'/edit', [
        'name' => 'Wacdo Edit',
        'adresse' => '12 rue du test',
        'code_postal' => '12345',
        'ville' => 'testCity',
    ]);
    $response->assertRedirect('/restaurants');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});

it('Ok - Delete restaurant', function () {
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


    $restaurant = Restaurants::query()->first();

    //////////////////////////////////
    ///
    /// SUPPRESSION RESTAURANT
    $response = $this->get('/restaurants/'.$restaurant->id.'/delete');
    $response->assertRedirect('/restaurants');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});

it('Affichage du détail des restaurants', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();

    $restaurant = Restaurants::query()->first();

    $response = $this->get('/restaurants/'.$restaurant->id.'/detail');
    $response->assertStatus(200);
    $response->assertViewIs('detailRestaurant');
    $response->assertSeeText($restaurant->name);

});
