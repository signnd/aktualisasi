<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\YayasanBuddha;

class YayasanBuddhaGuestController extends Controller
{
    public function show(YayasanBuddha $yayasan)
    {
        $yayasan->load(['kabupaten']);
        return view('guest.yayasan-show', compact('yayasan'));
    }
}
