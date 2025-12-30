<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

it('allows an admin to access a role-protected route', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    Route::middleware(['web', 'auth', 'role:admin'])
        ->get('/_role-test-admin', fn () => 'ok');

    $this->actingAs($admin)
        ->get('/_role-test-admin')
        ->assertStatus(200)
        ->assertSee('ok');
});

it('forbids a non-admin from accessing a role-protected route', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    Route::middleware(['web', 'auth', 'role:admin'])
        ->get('/_role-test-admin-2', fn () => 'ok');

    $this->actingAs($user)
        ->get('/_role-test-admin-2')
        ->assertForbidden();
});
