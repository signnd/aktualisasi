<?php

namespace App\Http\Controllers;
use App\Models\GuruPenda;
use App\Models\Majelis;
use App\Models\Okb;
use App\Models\Riab;
use App\Models\Smb;
use App\Models\YayasanBuddha;
use App\Models\Dhammasekha;
use App\Models\Pusdiklat;
use App\Models\Informasi;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {

        $counts = [
            'riab' => Riab::count(),
            'okb' => Okb::count(),
            'majelis' => Majelis::count(),
            'yayasan' => YayasanBuddha::count(),
            'smb' => Smb::count(),
            'dhammasekha' => Dhammasekha::count(),
            'pusdiklat' => Pusdiklat::count(),
            'gurupenda' => GuruPenda::count(),
        ];

    $informasiPublik = Informasi::where('kategori', 'Informasi Publik')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('counts', 'informasiPublik'));
    }

        public function index3() {

        $counts = [
            'riab' => Riab::count(),
            'okb' => Okb::count(),
            'majelis' => Majelis::count(),
            'yayasan' => YayasanBuddha::count(),
            'smb' => Smb::count(),
            'dhammasekha' => Dhammasekha::count(),
            'pusdiklat' => Pusdiklat::count(),
            'gurupenda' => GuruPenda::count(),
        ];

        $informasiPublik = Informasi::where('kategori', 'Informasi Publik')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('counts', 'informasiPublik'));
    }

}
