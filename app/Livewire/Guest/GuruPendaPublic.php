<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruPenda;
use App\Models\Kabupaten;

class GuruPendaPublic extends Component
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
        $query = GuruPenda::with(['kabupaten']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_guru', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nama_sekolah_sd', 'like', "%{$search}%")
                  ->orWhere('nama_sekolah_smp', 'like', "%{$search}%")
                  ->orWhere('nama_sekolah_sma', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
                //   ->orWhereHas('kecamatan', function($q) use ($search) {
                //       $q->where('kecamatan', 'like', "%{$search}%");
                //   });
            });
        }
        
        $guruPendas = $query->orderBy('nama_guru')->paginate(12);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        // Statistik
        $totalGuruPenda = GuruPenda::count();
        $totalKabupaten = GuruPenda::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.guru-penda-public', [
            'guruPendas' => $guruPendas,
            'kabupatens' => $kabupatens,
            'totalGuruPenda' => $totalGuruPenda,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}