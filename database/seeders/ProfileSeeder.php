<?php

namespace Database\Seeders;

use App\Models\Missions;
use App\Models\Pillars;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat profile utama
        $profile = Profile::create([
            'title' => 'Lazisnu Bojonegoro',
            'deskripsi' => 'Lazisnu Bojonegoro adalah organisasi yang berkomitmen untuk mengelola dana zakat, infaq, dan sadaqah dengan profesional dan amanah untuk kesejahteraan masyarakat.',
            'tahun_berdiri' => '2015',
            'penerima_manfaat' => 5250,
            'program_tersalurkan' => 28,
            'visi' => 'Menjadi lembaga zakat terpercaya yang profesional dalam mengelola dan mendistribusikan dana umat untuk pemberdayaan ekonomi dan sosial masyarakat.',
        ]);

        // Buat missions untuk profile
        $missions = [
            'Mengumpulkan dana zakat, infaq, dan sadaqah dari masyarakat dengan integritas tinggi',
            'Mendistribusikan dana secara adil dan transparan kepada penerima manfaat yang berhak',
            'Memberdayakan ekonomi masyarakat melalui program-program pembangunan berkelanjutan',
            'Meningkatkan kesadaran umat akan kewajiban berzakat dan berbagi',
            'Membangun kepercayaan masyarakat melalui akuntabilitas dan transparansi',
        ];

        foreach ($missions as $index => $text) {
            Missions::create([
                'profile_id' => $profile->id,
                'text' => $text,
                'urutan' => $index + 1,
            ]);
        }

        // Buat pillars untuk profile
        $pillars = [
            [
                'title' => 'Program Pendidikan',
                'deskripsi' => 'Menyediakan beasiswa dan bantuan pendidikan untuk anak-anak kurang mampu agar dapat melanjutkan pendidikan ke jenjang yang lebih tinggi.',
            ],
            [
                'title' => 'Program Kesehatan',
                'deskripsi' => 'Memberikan layanan kesehatan gratis dan pemeriksaan kesehatan berkala untuk masyarakat yang kurang mampu.',
            ],
            [
                'title' => 'Program Pemberdayaan Ekonomi',
                'deskripsi' => 'Memberikan pelatihan keterampilan dan modal usaha kepada masyarakat untuk meningkatkan ekonomi keluarga.',
            ],
            [
                'title' => 'Program Sosial Kemanusiaan',
                'deskripsi' => 'Memberikan bantuan sosial dalam bentuk makanan, pakaian, dan kebutuhan pokok kepada masyarakat yang membutuhkan.',
            ],
            [
                'title' => 'Program Dakwah dan Pembelajaran',
                'deskripsi' => 'Menyelenggarakan kegiatan dakwah, pengajian, dan pembelajaran agama untuk meningkatkan spiritual masyarakat.',
            ],
        ];

        foreach ($pillars as $index => $pillar) {
            Pillars::create([
                'profile_id' => $profile->id,
                'title' => $pillar['title'],
                'deskripsi' => $pillar['deskripsi'],
                'urutan' => $index + 1,
            ]);
        }
    }
}
