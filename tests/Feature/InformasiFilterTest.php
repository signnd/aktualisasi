<?php

use App\Livewire\InformasiSearch;
use App\Models\Informasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('filters informasi by kategori using the Livewire component', function () {
    $user = User::factory()->create();

    Informasi::create([
        'judul' => 'Publik A',
        'ringkasan' => 'ringkasan publik',
        'kategori' => 'Informasi Publik',
        'foto' => null,
        'teks' => 'konten publik',
        'user_id' => $user->id,
    ]);

    Informasi::create([
        'judul' => 'Internal B',
        'ringkasan' => 'ringkasan internal',
        'kategori' => 'Informasi Internal',
        'foto' => null,
        'teks' => 'konten internal',
        'user_id' => $user->id,
    ]);

    // Ensure both present when no filter
    Livewire::test(InformasiSearch::class)
        ->assertSee('Publik A')
        ->assertSee('Internal B')

        // Filter to only Publik
        ->set('kategori', 'Informasi Publik')
        ->assertSee('Publik A')
        ->assertDontSee('Internal B')

        // Clear filter returns both
        ->set('kategori', '')->assertSee('Internal B');
});
