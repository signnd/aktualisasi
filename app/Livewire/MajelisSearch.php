<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Majelis;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;

class MajelisSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $kabupaten_id = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';


    public function mount()
    {
        // Set default kabupaten sesuai user yang login (kecuali admin)
        if (Auth::check() && Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id) {
            $this->kabupaten_id = Auth::user()->kabupaten_id;
        }
    }

    // Reset pagination saat search atau filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKabupatenId()
    {
        $this->resetPage();
    }


    public function resetFilters()
    {
        $this->search = '';
        $this->kabupaten_id = '';
        $this->resetPage();
    }

    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // Toggle direction jika field yang sama
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Set field baru dengan direction asc
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }



    public function render()
    {
        $query = Majelis::with(['user', 'kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih di combobox
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
                  ->orWhere('ketua', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kecamatan', function($q) use ($search) {
                      $q->where('kecamatan', 'like', "%{$search}%");
                  });
            });
        }
                
        // Sorting
        if ($this->sortField === 'kabupaten') {
            $query->join('kabupaten', 'majelis.kabupaten_id', '=', 'kabupaten.id')
                  ->orderBy('kabupaten.kabupaten', $this->sortDirection)
                  ->select('majelis.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        
        $majeliss = $query->paginate(10);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();

        session(['majelis_page' => $majeliss->currentPage()]);

        return view('livewire.majelis-search', [
            'majeliss' => $majeliss,
            'kabupatens' => $kabupatens
        ]);
    }
}
