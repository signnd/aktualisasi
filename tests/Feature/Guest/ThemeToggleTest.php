<?php

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Support\Str;

dataset('guest public routes', [
    'riab' => [fn () => route('guest.riab.index')],
    'riab peta' => [fn () => route('guest.riab.peta')],
    'riab test' => [fn () => route('guest.riab.test-index')],
    'okb' => [fn () => route('guest.okb.index')],
    'majelis' => [fn () => route('guest.majelis.index')],
    'yayasan' => [fn () => route('guest.yayasan.index')],
    'smb' => [fn () => route('guest.smb.index')],
    'guru-penda' => [fn () => route('guest.guru-penda.index')],
    'dhammasekha' => [fn () => route('guest.dhammasekha.index')],
    'pusdiklat' => [fn () => route('guest.pusdiklat.index')],
    'tendik' => [fn () => route('guest.tendik.index')],
    'informasi' => [fn () => route('guest.informasi.index')],
]);

it('renders the theme toggle in the navbar', function (Closure $url) {
    $this->get($url())
        ->assertOk()
        ->assertSee('data-theme-toggle', escape: false)
        ->assertSee('toggleTheme', escape: false);
})->with('guest public routes');

it('renders the theme toggle on a public detail page', function () {
    $informasi = Informasi::create([
        'judul' => 'Pengumuman',
        'ringkasan' => 'Ringkasan pengumuman',
        'kategori' => 'Informasi Publik',
        'teks' => 'Isi pengumuman',
        'user_id' => User::factory()->create()->id,
    ]);

    $this->get(route('guest.informasi.show', $informasi))
        ->assertOk()
        ->assertSee('data-theme-toggle', escape: false);
});

it('renders the theme toggle inside the navbar container', function () {
    $response = $this->get(route('guest.riab.index'))->assertOk();

    $navbar = Str::between($response->getContent(), '<nav', '</nav>');

    expect($navbar)->toContain('data-theme-toggle');
});

it('does not hardcode the dark class on the html element', function () {
    $html = $this->get(route('guest.riab.index'))
        ->assertOk()
        ->getContent();

    expect(Str::before($html, '<head'))->not->toContain('class="dark"');
});

it('bootstraps the appearance script so the preference persists', function () {
    $this->get(route('guest.riab.index'))
        ->assertOk()
        ->assertSee('flux.appearance', escape: false)
        ->assertSee('window.Flux.applyAppearance', escape: false);
});
