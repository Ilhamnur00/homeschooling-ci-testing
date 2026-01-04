<?php

use function Pest\Laravel\get;

it('shows the home page', function () {
    get('/')->assertStatus(200);
});

it('redirects to google when visiting /auth/google', function () {
    get('/auth/google')->assertStatus(302);
});

it('requires login to access dashboard', function () {
    get('/dashboard')->assertRedirect('/login');
});
