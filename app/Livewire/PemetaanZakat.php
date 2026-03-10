<?php

namespace App\Livewire;

use App\Models\Kecamatan;
use Livewire\Component;

class PemetaanZakat extends Component
{
      /**
       * Data kecamatan dengan jumlah muzakki dan mustahik
       */
      public array $kecamatans = [];

      /**
       * Center koordinat peta (Bojonegoro)
       */
      public array $center = [-7.1394, 111.8810];

      /**
       * Zoom level default
       */
      public int $zoom = 11;

      public function mount(): void
      {
            $this->loadKecamatanData();
      }

      /**
       * Baca data kecamatan dari database dengan hitung dinamis
       */
      public function loadKecamatanData(): void
      {
            $this->kecamatans = Kecamatan::query()
                  ->orderBy('nama', 'asc')
                  ->get()
                  ->map(function (Kecamatan $kec) {
                        return [
                              'id' => $kec->id,
                              'nama' => $kec->nama,
                              'latitude' => (float) $kec->latitude,
                              'longitude' => (float) $kec->longitude,
                              'jumlah_muzakki' => $kec->jumlah_muzakki,
                              'jumlah_mustahik' => $kec->jumlah_mustahik,
                              'has_coordinates' => ! is_null($kec->latitude) && ! is_null($kec->longitude),
                        ];
                  })
                  ->toArray();
      }

      public function render()
      {
            return view('livewire.pemetaan-zakat');
      }
}
