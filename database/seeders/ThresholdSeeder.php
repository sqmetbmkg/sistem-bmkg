<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThresholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = base_path('database/seeders/threshold.csv');
        $csv = $this->csvToArray($file);

        $data = [];
        foreach($csv as $row) {
            $data[] = [
                'stasiun_id' => $row[0],
                'rc_batasatas_suspect_suhu' => $row[1],
                'rc_batasbawah_suspect_suhu' => $row[2],
                'rc_batasatas_suspect_kelembapan' => $row[3],
                'rc_batasbawah_suspect_kelembapan' => $row[4],
                'rc_batasatas_suspect_tekanan' => $row[5],
                'rc_batasbawah_suspect_tekanan' => $row[6],
                'sc_batasatas_suspect_suhu' => 3,
                'sc_batasbawah_suspect_suhu' => 3,
                'sc_batasatas_suspect_kelembapan' => 3,
                'sc_batasbawah_suspect_kelembapan' => 3,
                'sc_batasatas_suspect_tekanan' => 3,
                'sc_batasbawah_suspect_tekanan' => 3,
            ];
        }

        DB::table('threshold')->insert($data);
    }

    private function csvToArray($csvFile)
    {
        $fileToRead = fopen($csvFile, 'r');
        while (!feof($fileToRead)) {
            $row[] = fgetcsv($fileToRead, 1000, ';');
        }
        fclose($fileToRead);
        return $row;
    }
}
