<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Riab;
use App\Models\Majelis;
use App\Models\YayasanBuddha;
use App\Models\Okb;
use App\Models\Smb;
use App\Models\Dhammasekha;
use App\Models\Pusdiklat;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [
        'rumah_ibadah' => [],
        'lembaga' => [],
        'sekolah' => []
    ];

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [
                'rumah_ibadah' => [],
                'lembaga' => [],
                'sekolah' => []
            ];
            return;
        }

        // Search Rumah Ibadah
        $this->results['rumah_ibadah'] = Riab::where('nama', 'like', '%' . $this->query . '%')
            ->select('id', 'nama as label')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->route = route('guest.riab.show', $item->id);
                return $item;
            })->toArray();

        // Search Lembaga
        $majelis = Majelis::where('nama_majelis', 'like', '%' . $this->query . '%')
            ->select('id', 'nama_majelis as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'Majelis';
                $item->route = route('guest.majelis.show', $item->id);
                return $item;
            })->toArray();

        $yayasan = YayasanBuddha::where('nama_yayasan', 'like', '%' . $this->query . '%')
            ->select('id', 'nama_yayasan as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'Yayasan';
                $item->route = route('guest.yayasan.show', $item->id);
                return $item;
            })->toArray();

        $okb = Okb::where('nama_okb', 'like', '%' . $this->query . '%')
            ->select('id', 'nama_okb as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'OKB';
                $item->route = route('guest.okb.show', $item->id);
                return $item;
            })->toArray();

        $this->results['lembaga'] = array_merge($majelis, $yayasan, $okb);

        // Search Sekolah
        $smb = Smb::where('nama_smb', 'like', '%' . $this->query . '%')
            ->select('id', 'nama_smb as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'SMB';
                $item->route = route('guest.smb.show', $item->id);
                return $item;
            })->toArray();

        $dhammasekha = Dhammasekha::where('nama', 'like', '%' . $this->query . '%')
            ->select('id', 'nama as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'Dhammasekha';
                $item->route = route('guest.dhammasekha.show', $item->id);
                return $item;
            })->toArray();

        $pusdiklat = Pusdiklat::where('nama', 'like', '%' . $this->query . '%')
            ->select('id', 'nama as label')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'Pusdiklat';
                $item->route = route('guest.pusdiklat.show', $item->id);
                return $item;
            })->toArray();

        $this->results['sekolah'] = array_merge($smb, $dhammasekha, $pusdiklat);
    }

    public function render()
    {
        return view('livewire.global-search');
    }
}
