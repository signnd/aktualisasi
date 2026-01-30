<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\GuruPenda;
use Illuminate\Http\Request;

class GuruPendaGuestController extends Controller
{
    public function index(Request $request) {
    // Simpan current page ke session
        if ($request->has('page')) {
            session(['guru_penda_page' => $request->input('page')]);
        }

    }

    public function show(GuruPenda $guruPenda) {
        $guruPenda->load(['kabupaten']);
        return view('guest.guru-penda-show', compact('guruPenda'));
    }
}
