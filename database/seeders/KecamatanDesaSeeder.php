<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanDesaSeeder extends Seeder
{
      /**
       * Run the database seeds.
       */
      public function run(): void
      {
            // Data Kecamatan Bojonegoro (Contoh)
            $kecamatans = [
                  'Bojonegoro',
                  'Kanor',
                  'Gayam',
                  'Ngambon',
                  'Gondang',
                  'Dander',
                  'Kapas',
                  'Sumberrejo',
                  'Temayang',
                  'Padangan',
                  'Ngrambe',
                  'Balen',
                  'Malo',
                  'Kasiman',
            ];

            foreach ($kecamatans as $kecamatanName) {
                  $kecamatan = Kecamatan::firstOrCreate(
                        ['nama' => $kecamatanName],
                        ['nama' => $kecamatanName]
                  );

                  // Contoh desa untuk setiap kecamatan
                  $desas = $this->getDesas($kecamatanName);

                  foreach ($desas as $desaName) {
                        Desa::firstOrCreate(
                              ['kecamatan_id' => $kecamatan->id, 'nama' => $desaName],
                              ['kecamatan_id' => $kecamatan->id, 'nama' => $desaName]
                        );
                  }
            }
      }

      /**
       * Get desa list berdasarkan kecamatan
       */
      private function getDesas(string $kecamatan): array
      {
            $desasMap = [
                  'Bojonegoro' => [
                        'Kembang',
                        'Mindi',
                        'Banjarejo',
                        'Tambakrejo',
                        'Temenggungan',
                        'Gondang Baru',
                        'Menanggal',
                        'Kawitan',
                  ],
                  'Kanor' => [
                        'Kanor',
                        'Bakaran',
                        'Kedung Banteng',
                        'Ngebel',
                        'Tembuku',
                        'Sumber Sari',
                  ],
                  'Gayam' => [
                        'Gayam',
                        'Kedung Urip',
                        'Karanggeneng',
                        'Kwadungan',
                        'Ketaon',
                  ],
                  'Ngambon' => [
                        'Ngambon',
                        'Kemantren',
                        'Sidoharjo',
                        'Jambean',
                  ],
                  'Gondang' => [
                        'Gondang',
                        'Kalirejo',
                        'Karean',
                        'Telaga',
                        'Jembul',
                  ],
                  'Dander' => [
                        'Dander',
                        'Karanganyar',
                        'Tanggung',
                        'Cerdik',
                        'Sumbersari',
                  ],
                  'Kapas' => [
                        'Kapas',
                        'Kradenan',
                        'Senggoro',
                        'Tawangsari',
                  ],
                  'Sumberrejo' => [
                        'Sumberrejo',
                        'Kendal',
                        'Plosokandang',
                        'Grogol',
                  ],
                  'Temayang' => [
                        'Temayang',
                        'Gayam',
                        'Ngembar',
                        'Clumprit',
                  ],
                  'Padangan' => [
                        'Padangan',
                        'Pakal',
                        'Wukirsari',
                        'Margomulyo',
                  ],
                  'Ngrambe' => [
                        'Ngrambe',
                        'Selopuro',
                        'Karangdowo',
                        'Menganti',
                  ],
                  'Balen' => [
                        'Balen',
                        'Temulus',
                        'Kampung Baru',
                        'Kembang Sore',
                  ],
                  'Malo' => [
                        'Malo',
                        'Tamansari',
                        'Cangkol',
                        'Bangkalan',
                  ],
                  'Kasiman' => [
                        'Kasiman',
                        'Tambakrejo',
                        'Sidoharjo',
                        'Ringinanum',
                  ],
            ];

            return $desasMap[$kecamatan] ?? [$kecamatan];
      }
}
