<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Riab;
use App\Models\Kabupaten;

class RiabPublic extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'kabupaten_id' => ['except' => ''],
    ];

    public $search = '';
    public $kabupaten_id = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function mount()
    {
        // Restore the previous page from session when no page query param is present
        if (!request()->query('page') && session()->has('riab_page')) {
            $this->setPage(session('riab_page'));
        }
    }

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
        $query = Riab::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
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
        
        $riabs = $query->orderBy('nama')->paginate(15);
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        
        session(['riab_page' => $riabs->currentPage()]);

        // Statistik
        $totalRiab = Riab::count();
        $totalKabupaten = Riab::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.riab-public', [
            'riabs' => $riabs,
            'kabupatens' => $kabupatens,
            'totalRiab' => $totalRiab,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}