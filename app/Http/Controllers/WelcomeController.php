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

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        //$yayasans = YayasanBuddha::with(['kabupaten', 'kecamatan'])
        //    ->latest()
        //    ->take(5) // hanya tampilkan 5 data terbaru
        //    ->get();
//
        //return view('welcome', compact('yayasans'));

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

        return view('welcome', compact('counts'));
    }

        public function index3() {
        //$yayasans = YayasanBuddha::with(['kabupaten', 'kecamatan'])
        //    ->latest()
        //    ->take(5) // hanya tampilkan 5 data terbaru
        //    ->get();
//
        //return view('welcome', compact('yayasans'));

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

        return view('welcome3', compact('counts'));
    }

}
