<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Majelis;

class MajelisGuestController extends Controller
{
    public function show(Majelis $majelis)
    {
        $majelis->load(['kabupaten']);
        return view('guest.majelis-show', compact('majelis'));
    }
}