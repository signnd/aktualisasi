<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Majelis;
use App\Models\Kabupaten;

class MajelisPublic extends Component
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
        $query = Majelis::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_majelis', 'like', "%{$search}%")
                  ->orWhere('sekte', 'like', "%{$search}%")
                  ->orWhere('binaan', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kecamatan', function($q) use ($search) {
                      $q->where('kecamatan', 'like', "%{$search}%");
                  });
            });
        }
        
        $majeliss = $query->orderBy('nama_majelis')->paginate(12);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        // Statistik
        $totalMajelis = Majelis::count();
        $totalKabupaten = Majelis::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.majelis-public', [
            'majeliss' => $majeliss,
            'kabupatens' => $kabupatens,
            'totalMajelis' => $totalMajelis,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}
