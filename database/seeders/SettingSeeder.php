<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'fidyah_price_per_day',
                'value' => '50000',
                'group' => 'fidyah',
                'label' => 'Harga Fidyah Per Hari',
                'deskripsi' => 'Nilai fidyah per hari dalam rupiah (setara 1 mud makanan pokok)',
            ],
            [
                'key' => 'zakat_fitrah_uang_per_jiwa',
                'value' => '45000',
                'group' => 'zakat',
                'label' => 'Zakat Fitrah Per Jiwa (Uang)',
                'deskripsi' => 'Nilai zakat fitrah dalam bentuk uang per jiwa (setara 2.5kg beras)',
            ],
            [
                'key' => 'zakat_fitrah_beras_kg',
                'value' => '2.5',
                'group' => 'zakat',
                'label' => 'Zakat Fitrah Beras (kg)',
                'deskripsi' => 'Ukuran beras untuk zakat fitrah per jiwa dalam kg',
            ],
            [
                'key' => 'nisab_emas_gram',
                'value' => '85',
                'group' => 'zakat',
                'label' => 'Nisab Emas (gram)',
                'deskripsi' => 'Batas nisab zakat mal setara gram emas',
            ],
            [
                'key' => 'harga_emas_per_gram',
                'value' => '1100000',
                'group' => 'zakat',
                'label' => 'Harga Emas Per Gram (Rp)',
                'deskripsi' => 'Harga emas terkini per gram untuk perhitungan nisab. Update berkala.',
            ],
            [
                'key' => 'zakat_mal_persen',
                'value' => '2.5',
                'group' => 'zakat',
                'label' => 'Persentase Zakat Mal (%)',
                'deskripsi' => 'Persentase zakat mal dari total harta yang sudah mencapai nisab',
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
