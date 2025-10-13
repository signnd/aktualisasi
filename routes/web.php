<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\RiabController;
use App\Http\Controllers\OkbController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\YayasanBuddhaController;
use App\Http\Controllers\MajelisController;
use App\Http\Controllers\SmbController;
use App\Http\Controllers\SiswaSmbController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
    Route::resource('riab', RiabController::class);
    Route::resource('okb', OkbController::class);
    Route::resource('yayasan', YayasanBuddhaController::class);
    Route::resource('majelis', MajelisController::class)->parameters(['majelis' => 'majelis']);
    Route::resource('smb', SmbController::class);
    Route::resource('smb.siswa', SiswaSmbController::class);
    Route::prefix('smb/{smb}')->name('smb.')->group(function () {
        Route::post('/siswa', [SiswaSMBController::class, 'store'])->name('siswa.store');
        Route::put('/siswa/{siswa}', [SiswaSMBController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{siswa}', [SiswaSMBController::class, 'destroy'])->name('siswa.destroy');
    });
    Route::prefix('master')->group(function () {
        Route::resource('kabupaten', KabupatenController::class);
        Route::resource('kecamatan', KecamatanController::class);
    });

});

//Route::resource('riab', RiabController::class)->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
