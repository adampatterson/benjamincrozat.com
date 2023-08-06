<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;

test('users can access Filament', function () {
    actingAs(User::factory()->create())
        ->get('/admin')
        ->assertOk();
});

test('guests cannot access Filament', function () {
    assertGuest()
        ->getJson('/admin')
        ->assertUnauthorized();
});
