<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riab;
use App\Models\Majelis;
use App\Models\YayasanBuddha;
use App\Models\Smb;
use App\Models\SiswaSmb;
use App\Models\SiswaDhammasekha;
use App\Models\Dhammasekha;
use App\Models\Pusdiklat;
use App\Models\Okb;
use App\Models\GuruPenda;
use App\Models\Tendik;
use App\Models\Informasi;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari setiap tabel
        $counts = [
            'riab' => Riab::count(),
            'okb' => Okb::count(),
            'majelis' => Majelis::count(),
            'yayasan' => YayasanBuddha::count(),
            'smb' => Smb::count(),
            'siswasmb' => SiswaSmb::count(),
            'dhammasekha' => Dhammasekha::count(),
            'pusdiklat' => Pusdiklat::count(),
            'gurupenda' => GuruPenda::count(),
            'tendik' => Tendik::count(),
        ];

        // Ambil 9 informasi dengan kategori "Informasi Internal"
        $informasiInternal = Informasi::where('kategori', 'Informasi Internal')
            ->latest()
            ->take(9)
            ->get();

        return view('dashboard', compact('counts', 'informasiInternal'));
    }
}
