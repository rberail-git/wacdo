<?php

use App\Models\Affectations;
use App\Models\User;
use App\Models\Restaurants;
use App\Models\Fonctions;

it('Affichage du listing des affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response = $this->get('/affectations');
    $response->assertStatus(200);
    $response->assertViewIs('affectations');
    $response->assertSeeText('Affectations');



});

it('OK - Ajout affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response = $this->get('/affectations/new');
    $response->assertStatus(200);

    $restaurant = Restaurants::query()->first();
    $fonction = Fonctions::query()->first();
    $response = $this->post('/affectations/new', [
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2024-01-01',
        'date_fin' => '2027-01-01',
    ]);
    $response->assertRedirect(url()->previous());
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');

});

it('Erreur - Ajout affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response = $this->get('/affectations/new');
    $response->assertStatus(200);

    $response = $this->post('/affectations/new', [
        'user_id' => $user->id,
        'restaurants_id_multi' => ['2'],
        'fonctions_id' => '1',
        'date_debut' => '2026-01-01',
        'date_fin' => '2025-01-01',
    ]);
    $response->assertRedirect(url()->previous());
    $response->assertSessionHasErrors('date_fin');

});

it('Ok - Edit affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();
    $restaurant = Restaurants::query()->first();
    $fonction = Fonctions::query()->first();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();

    $affectation = Affectations::create([
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2024-01-01',
        'date_fin' => '2025-01-01',
    ]);
    $response = $this->get('/affectations/'.$affectation->id.'/edit');
    $response->assertStatus(200);

    $response = $this->post('/affectations/'.$affectation->id.'/edit', [
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2024-02-01',
        'date_fin' => '2025-02-01',
    ]);
    $response->assertRedirect(url()->previous());
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');

});

it('Error - Edit affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();
    $restaurant = Restaurants::query()->first();
    $fonction = Fonctions::query()->first();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();

    $affectation = Affectations::create([
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2024-01-01',
        'date_fin' => '2025-01-01',
    ]);
    $response = $this->get('/affectations/'.$affectation->id.'/edit');
    $response->assertStatus(200);

    $response = $this->post('/affectations/'.$affectation->id.'/edit', [
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2026-02-01',
        'date_fin' => '2025-02-01',
    ]);
    $response->assertRedirect(url()->previous());
    $response->assertSessionHasErrors('date_fin');

});

it('Ok - Delete affectations', function () {
    $this->seed();
    $user = User::factory()->state(['role' => 'admin'])->create();
    $restaurant = Restaurants::query()->first();
    $fonction = Fonctions::query()->first();
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $affectation = Affectations::create([
        'user_id' => $user->id,
        'restaurants_id_multi' => [$restaurant->id],
        'fonctions_id' => $fonction->id,
        'date_debut' => '2024-01-01',
        'date_fin' => '2025-01-01',
    ]);
    $response = $this->get('/affectations/'.$affectation->id.'/delete');
    $response->assertRedirect('/affectations');
    $response->assertSessionHasNoErrors();
    $response->assertSessionHas('success');
});
