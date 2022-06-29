<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThresholdErrorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threshold_error')->insert([
            [
                'data' => 'suhu',
                'batas_bawah_error' => -80,
                'batas_atas_error' => 60
            ],
            [
                'data' => 'kelembapan',
                'batas_bawah_error' => 0,
                'batas_atas_error' =>100
            ],
            [
                'data' => 'tekanan',
                'batas_bawah_error' => 500,
                'batas_atas_error' => 1100
            ],
        ]);
    }
}
