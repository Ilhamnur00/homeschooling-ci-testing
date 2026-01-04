<?php

use App\Models\User;
use function Pest\Laravel\{get, actingAs};

it('redirects unauthenticated user from protected routes', function () {
    get('/daftar-online')->assertRedirect('/login');
    get('/daftar-trial')->assertRedirect('/login');
});

it('allows authenticated user to access protected routes', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/daftar-online')
        ->assertStatus(200);

    actingAs($user)
        ->get('/daftar-trial')
        ->assertStatus(200);
});
