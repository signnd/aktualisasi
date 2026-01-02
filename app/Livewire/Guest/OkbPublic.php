<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Okb;
use App\Models\Kabupaten;

class OkbPublic extends Component
{
    use WithPagination;

    public $search = '';
    public $kabupaten_id = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKabupatenId()
    {
        $this->resetPage();
    }

    // Method untuk reset semua filter
    public function resetFilters()
    {
        $this->search = '';
        $this->kabupaten_id = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Okb::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_okb', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('no_registrasi', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kecamatan', function($q) use ($search) {
                      $q->where('kecamatan', 'like', "%{$search}%");
                  });
            });
        }
        
        $okbs = $query->orderBy('nama_okb')->paginate(15);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        // Statistik
        $totalokb = Okb::count();
        $totalKabupaten = Okb::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.okb-public', [
            'okbs' => $okbs,
            'kabupatens' => $kabupatens,
            'totalokb' => $totalokb,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}