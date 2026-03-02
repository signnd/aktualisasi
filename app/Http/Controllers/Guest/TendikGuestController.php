<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tendik;
use Illuminate\Http\Request;

class TendikGuestController extends Controller
{
    public function index(Request $request) {
    // Simpan current page ke session
        if ($request->has('page')) {
            session(['tendik_page' => $request->input('page')]);
        }

    }

    public function show(Tendik $tendik)
    {
        $tendik->load('kabupaten');
        return view('guest.tendik-show', compact('tendik'));
    }
}
