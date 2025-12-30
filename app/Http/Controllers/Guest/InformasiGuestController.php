<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Informasi;

class InformasiGuestController extends Controller
{
    public function show(Informasi $informasi)
    {
        $informasi->load(['users']);
        return view('guest.informasi-show', compact('informasi'));
    }
}