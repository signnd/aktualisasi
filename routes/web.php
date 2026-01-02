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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruPendaController;
use App\Http\Controllers\DhammasekhaController;
use App\Http\Controllers\SiswaDhammasekhaController;
use App\Http\Controllers\PusdiklatController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\RegisteredUsersController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Guest\RiabGuestController;
use App\Http\Controllers\Guest\OkbGuestController;
use App\Http\Controllers\Guest\MajelisGuestController;
use App\Http\Controllers\Guest\YayasanBuddhaGuestController;
use App\Http\Controllers\Guest\SmbGuestController;
use App\Http\Controllers\Guest\GuruPendaGuestController;
use App\Http\Controllers\Guest\DhammasekhaGuestController;
use App\Http\Controllers\Guest\PusdiklatGuestController;
use App\Http\Controllers\Guest\InformasiGuestController;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/test', [WelcomeController::class, 'index3'])->name('welcome3');

// Guest routes (tanpa middleware auth)
Route::prefix('public')->name('guest.')->group(function () {
    Route::get('/riab', function () {
        return view('guest.riab-index');
    })->name('riab.index');
    
    Route::get('/riab-test', function () {
        return view('guest.riab-test-index');
    })->name('riab.test-index');

    Route::get('/riab/{riab}', [RiabGuestController::class, 'show'])->name('riab.show');

    Route::get('/okb', function () {
        return view('guest.okb-index');
    })->name('okb.index');
    Route::get('/okb/{okb}', [OkbGuestController::class, 'show'])->name('okb.show');

    Route::get('/majelis', function () {
        return view('guest.majelis-index');
    })->name('majelis.index');
    Route::get('/majelis/{majelis}', [MajelisGuestController::class, 'show'])->name('majelis.show');
    
    Route::get('/yayasan', function () {
        return view('guest.yayasan-index');
    })->name('yayasan.index');
    Route::get('/yayasan/{yayasan}', [YayasanBuddhaGuestController::class, 'show'])->name('yayasan.show');
    
    Route::get('/smb', function () {
        return view('guest.smb-index');
    })->name('smb.index');
    Route::get('/smb/{smb}', [SmbGuestController::class, 'show'])->name('smb.show');
    
    Route::get('/guru-penda', function () {
        return view('guest.guru-penda-index');
    })->name('guru-penda.index');
    Route::get('/guru-penda/{guruPenda}', [GuruPendaGuestController::class, 'show'])->name('guru-penda.show');
    
    Route::get('/dhammasekha', function () {
        return view('guest.dhammasekha-index');
    })->name('dhammasekha.index');
    Route::get('/dhammasekha/{dhammasekha}', [DhammasekhaGuestController::class, 'show'])->name('dhammasekha.show');
    
    Route::get('/pusdiklat', function () {
        return view('guest.pusdiklat-index');
    })->name('pusdiklat.index');
    Route::get('/pusdiklat/{pusdiklat}', [PusdiklatGuestController::class, 'show'])->name('pusdiklat.show');
    
    Route::get('/informasi', function () {
        return view('guest.informasi-index');
    })->name('informasi.index');
    Route::get('/informasi/{informasi}', [InformasiGuestController::class, 'show'])->name('informasi.show');

});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/users/dashboard', [UserController::class, 'index'])->name('dashboard');
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    //Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::prefix('master')->group(function () {
        Route::resource('kabupaten', KabupatenController::class);
        Route::resource('kecamatan', KecamatanController::class);
        Route::get('/registered-users', [RegisteredUsersController::class, 'index'])
            ->name('registered-users.index');
        Route::patch('/registered-users/{user}', [RegisteredUsersController::class, 'update'])
            ->name('registered-users.update');
        Route::delete('/registered-users/{user}', [RegisteredUsersController::class, 'destroy'])
            ->name('registered-users.destroy');
    });
});



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
    Route::resource('pusdiklat', PusdiklatController::class);
    Route::resource('majelis', MajelisController::class)->parameters(['majelis' => 'majelis']);
    Route::resource('smb', SmbController::class);
    Route::resource('smb.siswa', SiswaSmbController::class);
    Route::resource('guru-penda', GuruPendaController::class);
    Route::resource('informasi', InformasiController::class);
    Route::resource('dhammasekha', DhammasekhaController::class);
    Route::resource('dhammasekha.siswa', DhammasekhaController::class);
    Route::prefix('dhammasekha/{dhammasekha}')->name('dhammasekha.')->group(function() {
        Route::post('/siswa', [SiswaDhammasekhaController::class, 'store'])->name('siswa.store');
        Route::put('/siswa/{siswa}', [SiswaDhammasekhaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{siswa}', [SiswaDhammasekhaController::class, 'destroy'])->name('siswa.destroy');

    });
    Route::prefix('smb/{smb}')->name('smb.')->group(function () {
        Route::post('/siswa', [SiswaSMBController::class, 'store'])->name('siswa.store');
        Route::put('/siswa/{siswa}', [SiswaSMBController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{siswa}', [SiswaSMBController::class, 'destroy'])->name('siswa.destroy');
    
        Route::get('/riab/by-kabupaten/{id}', [RiabController::class, 'getByKabupaten']);
    // Route::prefix('master')->group(function () {
    //         Route::resource('kecamatan', KecamatanController::class);
    // });
    });

});

//Route::resource('riab', RiabController::class)->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
