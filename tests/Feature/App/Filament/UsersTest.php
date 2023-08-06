<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;
use App\Filament\Resources\UserResource;

beforeEach(function () {
    actingAs(User::factory()->create());
});

test('the index page works', function () {
    get(UserResource::getUrl('index'))
        ->assertOk();
});
