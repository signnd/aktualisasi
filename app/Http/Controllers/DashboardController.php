<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riab;
use App\Models\Majelis;
use App\Models\YayasanBuddha;
use App\Models\Smb;
use App\Models\Okb;
use App\Models\GuruPenda;

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
            'gurupenda' => GuruPenda::count(),
        ];

        return view('dashboard', compact('counts'));
    }
}
