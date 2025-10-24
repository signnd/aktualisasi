<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Dhammasekha;

class DhammasekhaGuestController extends Controller
{
    public function show(Dhammasekha $dhammasekha)
    {
        $dhammasekha->load(['kabupaten']);
        return view('guest.dhammasekha-show', compact('dhammasekha'));
    }
}