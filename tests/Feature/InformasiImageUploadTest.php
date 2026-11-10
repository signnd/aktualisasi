<?php

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');

    $this->user = User::factory()->create();
    $this->informasi = Informasi::create([
        'judul' => 'Informasi Lama',
        'ringkasan' => 'Ringkasan lama',
        'kategori' => 'Informasi Publik',
        'foto' => null,
        'teks' => 'Teks lama',
        'user_id' => $this->user->id,
    ]);
});

function updateInformasi(User $user, Informasi $informasi, array $overrides = [])
{
    return test()->actingAs($user)->put(route('informasi.update', $informasi), array_merge([
        'judul' => 'Informasi Baru',
        'ringkasan' => 'Ringkasan baru',
        'kategori' => 'Informasi Publik',
        'foto' => null,
        'teks' => 'Teks baru',
        'user_id' => $user->id,
    ], $overrides));
}

function createInformasi(User $user, array $overrides = [])
{
    return test()->actingAs($user)->post(route('informasi.store'), array_merge([
        'judul' => 'Informasi Baru',
        'ringkasan' => 'Ringkasan baru',
        'kategori' => 'Informasi Publik',
        'foto' => null,
        'teks' => 'Teks baru',
        'user_id' => $user->id,
    ], $overrides));
}

function fakeImages(int $count): array
{
    return collect(range(1, $count))
        ->map(fn (int $index) => UploadedFile::fake()->image("foto-{$index}.jpg", 1200, 800))
        ->all();
}

it('renders the multiple image upload form on the create page', function () {
    $this->actingAs($this->user)
        ->get(route('informasi.create'))
        ->assertOk()
        ->assertSee('enctype="multipart/form-data"', false)
        ->assertSee('name="foto_file[]"', false)
        ->assertSee('multiple', false)
        ->assertSee('dikompres otomatis di browser hingga di bawah 500 KB')
        ->assertDontSee('name="remove_fotos[]"', false);
});

it('stores uploaded photos when creating informasi', function () {
    createInformasi($this->user, [
        'foto_file' => fakeImages(3),
    ])->assertRedirect(route('informasi.index'))
        ->assertSessionHasNoErrors();

    $informasi = Informasi::where('judul', 'Informasi Baru')->sole();

    expect($informasi->fotos)->toHaveCount(3);

    foreach ($informasi->fotos as $photo) {
        expect($photo)->toStartWith('/storage/informasi/');
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $photo));
    }
});

it('stores the maximum of five uploaded photos when creating informasi', function () {
    createInformasi($this->user, [
        'foto_file' => fakeImages(5),
    ])->assertSessionHasNoErrors();

    $informasi = Informasi::where('judul', 'Informasi Baru')->sole();

    expect($informasi->fotos)->toHaveCount(5);

    foreach ($informasi->fotos as $photo) {
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $photo));
    }
});

it('rejects more than five uploaded photos when creating informasi', function () {
    createInformasi($this->user, [
        'foto_file' => fakeImages(6),
    ])->assertSessionHasErrors('foto_file');

    expect(Informasi::where('judul', 'Informasi Baru')->exists())->toBeFalse()
        ->and(Storage::disk('public')->allFiles('informasi'))->toBeEmpty();
});

it('stores an uploaded photo on the public disk', function () {
    updateInformasi($this->user, $this->informasi, [
        'foto_file' => fakeImages(1),
    ])->assertRedirect(route('informasi.index', ['page' => 1]));

    $this->informasi->refresh();

    expect($this->informasi->foto)->toBeNull()
        ->and($this->informasi->fotos)->toHaveCount(1)
        ->and($this->informasi->fotos[0])->toStartWith('/storage/informasi/');

    Storage::disk('public')->assertExists(str_replace('/storage/', '', $this->informasi->fotos[0]));
});

it('stores up to five uploaded photos', function () {
    updateInformasi($this->user, $this->informasi, [
        'foto_file' => fakeImages(5),
    ])->assertSessionHasNoErrors();

    $this->informasi->refresh();

    expect($this->informasi->fotos)->toHaveCount(5);

    foreach ($this->informasi->fotos as $photo) {
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $photo));
    }
});

it('rejects more than five uploaded photos at once', function () {
    updateInformasi($this->user, $this->informasi, [
        'foto_file' => fakeImages(6),
    ])->assertSessionHasErrors('foto_file');

    expect(Storage::disk('public')->allFiles('informasi'))->toBeEmpty();
});

it('rejects uploads that would exceed the five photo limit', function () {
    Storage::disk('public')->put('informasi/foto-lama.jpg', 'old-photo');
    $this->informasi->update([
        'fotos' => ['/storage/informasi/foto-lama.jpg'],
    ]);

    updateInformasi($this->user, $this->informasi, [
        'foto_file' => fakeImages(5),
    ])->assertSessionHasErrors('foto_file');

    $this->informasi->refresh();

    expect($this->informasi->fotos)->toBe(['/storage/informasi/foto-lama.jpg']);
    Storage::disk('public')->assertExists('informasi/foto-lama.jpg');
});

it('removes selected photos and deletes their files', function () {
    Storage::disk('public')->put('informasi/satu.jpg', 'satu');
    Storage::disk('public')->put('informasi/dua.jpg', 'dua');
    $this->informasi->update([
        'fotos' => ['/storage/informasi/satu.jpg', '/storage/informasi/dua.jpg'],
    ]);

    updateInformasi($this->user, $this->informasi, [
        'remove_fotos' => ['/storage/informasi/satu.jpg'],
    ])->assertSessionHasNoErrors();

    $this->informasi->refresh();

    expect($this->informasi->fotos)->toBe(['/storage/informasi/dua.jpg']);
    Storage::disk('public')->assertMissing('informasi/satu.jpg');
    Storage::disk('public')->assertExists('informasi/dua.jpg');
});

it('migrates a legacy local photo into the photo gallery', function () {
    Storage::disk('public')->put('informasi/lama.jpg', 'lama');
    $this->informasi->update([
        'foto' => 'http://localhost:8000/storage/informasi/lama.jpg',
    ]);

    updateInformasi($this->user, $this->informasi)->assertSessionHasNoErrors();

    $this->informasi->refresh();

    expect($this->informasi->foto)->toBeNull()
        ->and($this->informasi->fotos)->toBe(['/storage/informasi/lama.jpg']);
});

it('rejects a non-image upload', function () {
    updateInformasi($this->user, $this->informasi, [
        'foto_file' => [UploadedFile::fake()->create('dokumen.pdf', 10, 'application/pdf')],
    ])->assertSessionHasErrors('foto_file.0');

    expect(Storage::disk('public')->allFiles('informasi'))->toBeEmpty();
});

it('keeps the photo url when no file is uploaded', function () {
    $this->informasi->update([
        'foto' => 'https://drive.google.com/file/d/contoh/view',
    ]);

    updateInformasi($this->user, $this->informasi, [
        'foto' => 'https://drive.google.com/file/d/contoh/view',
    ])->assertSessionHasNoErrors();

    expect($this->informasi->fresh()->foto)->toBe('https://drive.google.com/file/d/contoh/view');
});

it('renders the multiple image upload form on the edit page', function () {
    $this->informasi->update(['fotos' => ['/storage/informasi/foto-lama.jpg']]);

    $this->actingAs($this->user)
        ->get(route('informasi.edit', $this->informasi))
        ->assertOk()
        ->assertSee('enctype="multipart/form-data"', false)
        ->assertSee('name="foto_file[]"', false)
        ->assertSee('multiple', false)
        ->assertSee('name="remove_fotos[]"', false)
        ->assertSee('dikompres otomatis di browser hingga di bawah 500 KB')
        ->assertSee('Mengompres');
});

it('renders local uploaded photos on the admin and public detail pages', function () {
    $this->informasi->update([
        'fotos' => [
            'http://localhost:8000/storage/informasi/satu.jpg',
            '/storage/informasi/dua.jpg',
        ],
    ]);

    $this->actingAs($this->user)
        ->get(route('informasi.show', $this->informasi))
        ->assertOk()
        ->assertSee('src="/storage/informasi/satu.jpg"', false)
        ->assertSee('src="/storage/informasi/dua.jpg"', false)
        ->assertSee('x-data="{ active: 0, total: 2 }"', false)
        ->assertSee('Foto sebelumnya')
        ->assertSee('Foto berikutnya')
        ->assertSee('h-96', false);

    $this->get(route('guest.informasi.show', $this->informasi))
        ->assertOk()
        ->assertSee('src="/storage/informasi/satu.jpg"', false)
        ->assertSee('src="/storage/informasi/dua.jpg"', false)
        ->assertSee('x-data="{ active: 0, total: 2 }"', false)
        ->assertSee('Foto sebelumnya')
        ->assertSee('Foto berikutnya')
        ->assertSee('h-96', false);
});
