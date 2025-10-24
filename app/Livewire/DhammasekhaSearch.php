<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dhammasekha;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;

class DhammasekhaSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $kabupaten_id = '';

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

    public function render()
    {
        $query = Dhammasekha::with(['kabupaten']);
        
        // Filter berdasarkan kabupaten yang dipilih di combobox
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('no_izop', 'like', "%{$search}%")
                  ->orWhere('no_statistik', 'like', "%{$search}%")
                  ->orWhere('nama_yayasan', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
                //   ->orWhereHas('kecamatan', function($q) use ($search) {
                //       $q->where('kecamatan', 'like', "%{$search}%");
                //   });
            });
        }
        
        $dhammasekhas = $query->paginate(10);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();

        return view('livewire.dhammasekha-search', [
            'dhammasekhas' => $dhammasekhas,
            'kabupatens' => $kabupatens
        ]);
    }
}
