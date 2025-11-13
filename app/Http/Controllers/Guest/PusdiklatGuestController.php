<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pusdiklat;

class PusdiklatGuestController extends Controller
{
    public function show(Pusdiklat $pusdiklat)
    {
        $pusdiklat->load(['kabupaten']);
        return view('guest.pusdiklat-show', compact('pusdiklat'));
    }

}
