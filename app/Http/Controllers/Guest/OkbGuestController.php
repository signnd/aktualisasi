<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Okb;

class OkbGuestController extends Controller
{
    public function show(Okb $okb)
    {
        $okb->load(['kabupaten', 'kecamatan']);
        return view('guest.okb-show', compact('okb'));
    }
}