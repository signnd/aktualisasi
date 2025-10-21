<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\YayasanBuddha;
use App\Models\Kabupaten;

class YayasanPublic extends Component
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
        $query = YayasanBuddha::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_yayasan', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('ketua', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kecamatan', function($q) use ($search) {
                      $q->where('kecamatan', 'like', "%{$search}%");
                  });
            });
        }
        
        $yayasanBuddhas = $query->orderBy('nama_yayasan')->paginate(12);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        // Statistik
        $totalYayasanBuddha = YayasanBuddha::count();
        $totalKabupaten = YayasanBuddha::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.yayasan-public', [
            'yayasanBuddhas' => $yayasanBuddhas,
            'kabupatens' => $kabupatens,
            'totalYayasanBuddha' => $totalYayasanBuddha,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}
