<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rekening::factory(5)->create();
    }
}
