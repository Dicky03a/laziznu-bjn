<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PillarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pillars')->insert([
            [
                'id' => 1,
                'profile_id' => 1,
                'title' => 'NUCARE CERDAS',
                'deskripsi' => "(1) Beasiswa tingkat MI,MTS, MA (2)\nBeasiswa Sarjana NU (3) Beasiswa Guru NU\n(4) Beasiswa Santri. (5) Pelatihan /\nWorkshop Guru NU (6) Madrasah Amil",
                'urutan' => 0,
                'created_at' => Carbon::parse('2026-03-08 09:12:07'),
                'updated_at' => Carbon::parse('2026-03-08 09:12:07'),
            ],
            [
                'id' => 2,
                'profile_id' => 1,
                'title' => 'NUCARE BERDAYA',
                'deskripsi' => "(1) Bantuan modal usaha (2) Bantuan alat\nkerja atau usaha seperti gerobak, rengkek\n(3) Bantuan Ternak",
                'urutan' => 1,
                'created_at' => Carbon::parse('2026-03-08 09:12:07'),
                'updated_at' => Carbon::parse('2026-03-08 09:12:07'),
            ],
            [
                'id' => 3,
                'profile_id' => 1,
                'title' => 'NUCARE SEHAT',
                'deskripsi' => "(1) bantuan pengobatan bagi fakir miskin\ndan dhuafa (2) Bantuan alat bantu medis\nseperti kursi roda, Kacamata, Tabung\noksigen ambulance, Kursi tandu ambulance\n(3) Gerakan Sehat Pesantren & Masjid NU",
                'urutan' => 2,
                'created_at' => Carbon::parse('2026-03-08 09:12:07'),
                'updated_at' => Carbon::parse('2026-03-08 09:12:07'),
            ],
            [
                'id' => 4,
                'profile_id' => 1,
                'title' => 'NUCARE DAMAI',
                'deskripsi' => "(1) Santunan Yatim, Piatu dan Dhuafa (2)\nBantuan Sosial Kemanusian dan Tanggap\nBencana (3) Bedah Rumah Dhuafa (4)\nProgram Dakwah dan Keagamaan",
                'urutan' => 3,
                'created_at' => Carbon::parse('2026-03-08 09:12:08'),
                'updated_at' => Carbon::parse('2026-03-08 09:12:08'),
            ],
            [
                'id' => 5,
                'profile_id' => 1,
                'title' => 'NUCARE HIJAU',
                'deskripsi' => "(1) Sedekah pohon dan Reboisasi (2)\nPesantren dan Masjid Hijau",
                'urutan' => 4,
                'created_at' => Carbon::parse('2026-03-08 09:12:08'),
                'updated_at' => Carbon::parse('2026-03-08 09:12:08'),
            ],
        ]);
    }
}
