<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Smb;
use App\Models\Kabupaten;

class SmbPublic extends Component
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
        if (!request()->query('page') && session()->has('smb_page')) {
            $this->setPage(session('smb_page'));
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
        $query = Smb::with(['kabupaten']);
        
        // Filter berdasarkan kabupaten yang dipilih
        if ($this->kabupaten_id != '') {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_smb', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('nssmb', 'like', "%{$search}%")
                  ->orWhereHas('kabupaten', function($q) use ($search) {
                      $q->where('kabupaten', 'like', "%{$search}%");
                  });
                //   ->orWhereHas('kecamatan', function($q) use ($search) {
                //       $q->where('kecamatan', 'like', "%{$search}%");
                //   });
            });
        }
        
        $smbs = $query->orderBy('nama_smb')->paginate(15);
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();
        
        session(['smb_page' => $smbs->currentPage()]);

        // Statistik
        $totalSmb = Smb::count();
        $totalKabupaten = Smb::distinct('kabupaten_id')->count('kabupaten_id');
        
        return view('livewire.guest.smb-public', [
            'smbs' => $smbs,
            'kabupatens' => $kabupatens,
            'totalSmb' => $totalSmb,
            'totalKabupaten' => $totalKabupaten,
        ]);
    }
}
