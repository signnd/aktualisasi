<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Informasi;

class InformasiSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $kategori = '';
    public $kabupaten_id = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'kategori' => ['except' => ''],
    ];


    // Reset pagination saat search atau filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function updatingKategori()
    {
        $this->resetPage();
    }


    public function render()
    {
        $query = Informasi::with(['users']);
        
        // Filter berdasarkan kategori jika dipilih
        if ($this->kategori != '') {
            $query->where('kategori', $this->kategori);
        }
        
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('teks', 'like', "%{$search}%");
            });
        }
        
        $informasis = $query->paginate(10);

        session(['informasi_page' => $informasis->currentPage()]);
        
        return view('livewire.informasi-search', [
            'informasis' => $informasis,
        ]);
    }
}