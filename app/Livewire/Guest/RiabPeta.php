<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Riab;

class RiabPeta extends Component
{
    public function render()
    {
        // Ambil data RIAB yang memiliki koordinat latitude dan longitude
        $riabData = Riab::whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->get(['id', 'nama', 'alamat', 'latitude', 'longitude'])
                        ->map(function ($riab) {
                            return [
                                'nama' => $riab->nama,
                                'alamat' => $riab->alamat,
                                'lat' => (float) $riab->latitude,
                                'long' => (float) $riab->longitude,
                                'url' => route('guest.riab.show', $riab->id)
                            ];
                        });

        return view('livewire.guest.riab-peta', [
            'locations' => $riabData
        ]);
    }
}
