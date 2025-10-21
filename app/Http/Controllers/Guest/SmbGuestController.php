<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Smb;

class SmbGuestController extends Controller
{
        public function show(Smb $smb)
    {
        $smb->load(['kabupaten']);
        return view('guest.smb-show', compact('smb'));
    }
}
