<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tendik;
use Illuminate\Http\Request;

class TendikGuestController extends Controller
{
    public function show(Tendik $tendik)
    {
        $tendik->load('kabupaten');
        return view('guest.tendik-show', compact('tendik'));
    }
}
