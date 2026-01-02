<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Informasi;

class InformasiPublic extends Component
{
    use WithPagination;

    public $search = '';
    public $kategori = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKategori()
    {
        $this->resetPage();
    }

    // Method untuk reset semua filter
    public function resetFilters()
    {
        $this->search = '';
    //     $this->kategori = '';
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Informasi::with(['users'])->where('kategori', 'Informasi Publik');
                
        // Search functionality
        if ($this->search != '') {
            $s = $this->search;
            $query->where(fn($q) =>
                $q->where('judul', 'like', "%{$s}%")
                  ->orWhere('ringkasan', 'like', "%{$s}%")
                  ->orWhere('teks', 'like', "%{$s}%"));
            }
        
        $informasis = $query->latest()->paginate(9);
        
        
        return view('livewire.guest.informasi-public', compact('informasis'));
    }
}