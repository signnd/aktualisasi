<?php

namespace App\Livewire\Guest;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Tendik;
use App\Models\Kabupaten;

class TendikPublic extends Component
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
        $query = Tendik::with(['kabupaten']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_tendik', 'like', "%{$search}%")
                  ->orWhere('nama_lembaga', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
            });
        }
        
        $tendiks = $query->orderBy('nama_tendik')->paginate(12);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        // Statistik
        $totalTendik = Tendik::count();
        $totalKabupaten = Tendik::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.tendik-public', [
            'tendiks' => $tendiks,
            'kabupatens' => $kabupatens,
            'totalTendik' => $totalTendik,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}