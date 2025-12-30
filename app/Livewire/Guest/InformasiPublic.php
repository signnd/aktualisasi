<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Informasi;
use App\Models\Kabupaten;

class RiabPublic extends Component
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
    // public function resetFilters()
    // {
    //     $this->search = '';
    //     $this->kategori = '';
    //     $this->resetPage();
    // }
    
    public function render()
    {
        $informasis = Informasi::where('kategori', 'Informasi Publik')
            ->latest()
            ->take(3)
            ->get();;
        
        // Filter berdasarkan kabupaten yang dipilih
        // if ($this->kategori != '') {
        //     $query->where('kabupaten_id', $this->kabupaten_id);
        // }
        
        // Search functionality
        if ($this->search != '') {
            $search = $this->search;
            $informasis->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('teks', 'like', "%{$search}%");
            });
        }
        
        // $informasis = $query;
        
        
        return view('livewire.guest.informasi-public', [
            'informasis' => $informasis,
        ]);
    }
}