<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruPenda;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;

class GuruPendaSearch extends Component
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

    public function render()
    {
        $query = GuruPenda::with(['kabupaten']);
        
        // Filter berdasarkan kabupaten yang dipilih di combobox
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_guru', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('nrg', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
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
        
        $guruPendas = $query->paginate(10);
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        return view('livewire.guru-penda-search', [
            'guruPendas' => $guruPendas,
            'kabupatens' => $kabupatens
        ]);
    }
}
