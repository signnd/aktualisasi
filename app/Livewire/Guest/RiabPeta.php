<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Riab;

class RiabPeta extends Component
{
    public $search = '';
    public $kabupaten_id = '';

    public function updated($property)
    {
        if ($property === 'search' || $property === 'kabupaten_id') {
            $this->dispatch('locations-updated', locations: $this->getLocations());
        }
    }

    public function getLocations()
    {
        $query = Riab::whereNotNull('latitude')
                        ->whereNotNull('longitude');

        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }

        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
            });
        }

        return $query->get(['id', 'nama', 'alamat', 'latitude', 'longitude'])
                    ->map(function ($riab) {
                        return [
                            'id' => $riab->id,
                            'nama' => $riab->nama,
                            'alamat' => $riab->alamat,
                            'lat' => (float) $riab->latitude,
                            'long' => (float) $riab->longitude,
                            'url' => route('guest.riab.show', $riab->id)
                        ];
                    });
    }

    public function render()
    {
        $locations = $this->getLocations();
        $kabupatens = \App\Models\Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();

        // Data view untuk kartu list (termasuk relasinya agar kabupaten bisa ditampilkan di list)
        $queryList = Riab::with('kabupaten', 'kecamatan');
        
        if ($this->kabupaten_id != '') {
            $queryList->where('kabupaten_id', $this->kabupaten_id);
        }

        if ($this->search != '') {
            $search = $this->search;
            $queryList->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
            });
        }
        
        $listRiab = $queryList->orderBy('nama')->get();

        return view('livewire.guest.riab-peta', [
            'locations' => $locations,
            'kabupatens' => $kabupatens,
            'listRiab' => $listRiab
        ]);
    }
}
