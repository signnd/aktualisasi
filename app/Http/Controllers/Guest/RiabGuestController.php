<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Riab;

class RiabGuestController extends Controller
{
    public function show(Riab $riab)
    {
        $riab->load(['kabupaten', 'kecamatan']);
        return view('guest.riab-show', compact('riab'));
    }
}