<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\YayasanBuddha;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class YayasanSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $kabupaten_id = '';
    public $currentPage = 1;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function mount()
    {
        // Set default kabupaten sesuai user yang login (kecuali admin)
        if (Auth::check() && Auth::user()->user_role !== 'admin' && Auth::user()->kabupaten_id) {
            $this->kabupaten_id = Auth::user()->kabupaten_id;
        }
        // $this->currentPage = request()->get('page', 1);
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

    public function updatingPaginators($page, $pageName)
    {
        $this->currentPage = $page;
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

    public function render(Request $request)
    {
        $query = YayasanBuddha::with(['kabupaten', 'kecamatan']);
        
        // Filter berdasarkan kabupaten yang dipilih di combobox
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
        
        // Sorting
        if ($this->sortField === 'kabupaten') {
            $query->join('kabupaten', 'yayasan_buddha.kabupaten_id', '=', 'kabupaten.id')
                  ->orderBy('kabupaten.kabupaten', $this->sortDirection)
                  ->select('yayasan_buddha.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }
        
        $yayasans = $query->paginate(10);
        $kabupatens = Kabupaten::orderBy('kabupaten')->where('kabupaten', '!=', 'Provinsi Bali')->get();

        // Simpan current page ke session
        session(['yayasan_page' => $yayasans->currentPage()]);

        
        return view('livewire.yayasan-search', [
            'yayasans' => $yayasans,
            'kabupatens' => $kabupatens
        ]);
    }
}
