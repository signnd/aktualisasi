<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Smb;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;

class SmbSearch extends Component
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
        $query = Smb::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih di combobox
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_smb', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('izop_1', 'like', "%{$search}%")
                  ->orWhere('ppjg_1', 'like', "%{$search}%")
                  ->orWhere('ppjg_2', 'like', "%{$search}%")
                  ->orWhere('nssmb', 'like', "%{$search}%")
                  ->orWhere('bapen', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
                //   ->orWhereHas('kecamatan', function($q) use ($search) {
                //       $q->where('kecamatan', 'like', "%{$search}%");
                //   });
            });
        }
                
        // Sorting
        if ($this->sortField === 'kabupaten') {
            $query->join('kabupaten', 'smb.kabupaten_id', '=', 'kabupaten.id')
                  ->orderBy('kabupaten.kabupaten', $this->sortDirection)
                  ->select('smb.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        
        $smbs = $query->paginate(10);
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();

        session(['smb_page' => $smbs->currentPage()]);

        return view('livewire.smb-search', [
            'smbs' => $smbs,
            'kabupatens' => $kabupatens
        ]);
    }
}
