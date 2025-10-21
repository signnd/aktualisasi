<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\GuruPenda;

class GuruPendaGuestController extends Controller
{
    public function show(GuruPenda $guruPenda) {
        $guruPenda->load(['kabupaten']);
        return view('guest.guru-penda-show', compact('guruPenda'));
    }
}
