<?php
use App\Models\User;

test('registration screen can be rendered', function () {

    $user = User::factory()->state(['role' => 'admin'])->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);



    $response = $this->get('/collaborateurs/new');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $user = User::factory()->state(['role' => 'admin'])->create();
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response = $this->post('/collaborateurs/new', [
        'name' => 'DOE',
        'firstname' => 'John',
        'email' => 'doe@example.com',
        'role' => 'user',
        'password' => 'password2',
        'password_confirmation' => 'password2',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('collaborateurs', absolute: false));
});
