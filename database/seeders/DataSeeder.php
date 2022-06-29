<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataError = DB::table('threshold_error')->orderBy('data', 'asc')->get();

        $file = base_path('database/seeders/Mei2022.csv');
        $csv = $this->csvToArray($file);

        $data = [];

        foreach ($csv as $row) {
            $thresholdSuspect = DB::table('threshold')->where('stasiun_id', '=', $row[4])->first();
            $thresholdError['kelembapan'] = $dataError[0];
            $thresholdError['suhu'] = $dataError[1];
            $thresholdError['tekanan'] = $dataError[2];
            $dataSebelumnya = $this->getPreviousData($this->getTanggal($row[0]), $this->getJam($row[0]), $row[4]);
            $data = [
                'stasiun_id' => $row[4],
                'waktu' => $row[0],
                'data_suhu' => $row[1] == "" ? NULL : $row[1],
                'data_kelembapan' => $row[2] == "" ? NULL : $row[2],
                'data_tekanan' => $row[3] == "" ? NULL : $row[3],
                'hasil_rc_suhu' => $this->getHasilRC($row[1] == "" ? NULL : $row[1], [
                    'bawah' => $thresholdSuspect->rc_batasbawah_suspect_suhu,
                    'atas' => $thresholdSuspect->rc_batasatas_suspect_suhu,
                ], [
                    'bawah' => $thresholdError['suhu']->batas_bawah_error,
                    'atas' => $thresholdError['suhu']->batas_atas_error
                ]),
                'hasil_rc_kelembapan' => $this->getHasilRC($row[2] == "" ? NULL : $row[2], [
                    'bawah' => $thresholdSuspect->rc_batasbawah_suspect_kelembapan,
                    'atas' => $thresholdSuspect->rc_batasatas_suspect_kelembapan,
                ], [
                    'bawah' => $thresholdError['kelembapan']->batas_bawah_error,
                    'atas' => $thresholdError['kelembapan']->batas_atas_error
                ]),
                'hasil_rc_tekanan' => $this->getHasilRC($row[3] == "" ? NULL : $row[3], [
                    'bawah' => $thresholdSuspect->rc_batasbawah_suspect_tekanan,
                    'atas' => $thresholdSuspect->rc_batasatas_suspect_tekanan,
                ], [
                    'bawah' => $thresholdError['tekanan']->batas_bawah_error,
                    'atas' => $thresholdError['tekanan']->batas_atas_error
                ]),
                'hasil_sc_suhu' => $this->getHasilSC(($row[1] == "" ? NULL : $row[1]), $dataSebelumnya['suhu'], [
                    'bawah' => $thresholdSuspect->sc_batasbawah_suspect_suhu,
                    'atas' => $thresholdSuspect->sc_batasatas_suspect_suhu,
                ]),
                'hasil_sc_kelembapan' => $this->getHasilSC(($row[2] == "" ? NULL : $row[2]), $dataSebelumnya['kelembapan'], [
                    'bawah' => $thresholdSuspect->sc_batasbawah_suspect_kelembapan,
                    'atas' => $thresholdSuspect->sc_batasatas_suspect_kelembapan,
                ]),
                'hasil_sc_tekanan' => $this->getHasilSC(($row[3] == "" ? NULL : $row[3]), $dataSebelumnya['tekanan'], [
                    'bawah' => $thresholdSuspect->sc_batasbawah_suspect_tekanan,
                    'atas' => $thresholdSuspect->sc_batasatas_suspect_tekanan,
                ]),
            ];
            DB::table('data')->insert($data);
        }
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

    private function getTanggal($string)
    {
        return explode(' ', $string)[0];
    }

    private function getJam($string)
    {
        return explode(' ', $string)[1];
    }

    private function getPreviousData($tanggal, $jam, $stasiunId)
    {
        $data = DB::table('data')->where('stasiun_id', '=', $stasiunId)->where('waktu', 'LIKE', $tanggal . '%')->orderBy('waktu', 'desc')->get();

        $dataSuhu = 0;
        $dataKelembapan = 0;
        $dataTekanan = 0;
        foreach ($data as $row) {
            if ($jam == explode(' ', $row->waktu)[1]) {
                continue;
            }
            if ($row->data_suhu != NULL && $dataSuhu == NULL) {
                $dataSuhu = $row->data_suhu;
            }
            if ($row->data_kelembapan != NULL && $dataKelembapan == NULL) {
                $dataKelembapan = $row->data_kelembapan;
            }
            if ($row->data_tekanan != NULL && $dataTekanan == NULL) {
                $dataTekanan = $row->data_tekanan;
            }
            if ($dataSuhu != NULL && $dataKelembapan != NULL && $dataTekanan != NULL)
                break;
        }

        return [
            'suhu' => $dataSuhu,
            'kelembapan' => $dataKelembapan,
            'tekanan' => $dataTekanan
        ];
    }

    private function getHasilRC($nilaiData, $nilaiSuspect, $nilaiError)
    {
        if ($nilaiData != NULL) {
            if ($nilaiData < $nilaiSuspect['bawah'] || $nilaiData > $nilaiSuspect['atas']) {
                if ($nilaiData < $nilaiError['bawah'] || $nilaiData > $nilaiError['atas']) {
                    return config('constants.STATUS.ERROR');
                } else {
                    return config('constants.STATUS.SUSPECT');
                }
            } else {
                return config('constants.STATUS.GOOD');
            }
        } else {
            return config('constants.STATUS.ERROR');
        }
    }

    private function getHasilSC($nilaiBaru, $nilaiSebelumnya, $nilaiSuspect)
    {
        if ($nilaiBaru != NULL) {
            if ($nilaiSebelumnya == NULL) {
                return config('constants.STATUS.GOOD');
            } else {
                if (abs(abs($nilaiBaru) - abs($nilaiSebelumnya)) > $nilaiSuspect['atas']) {
                    return config('constants.STATUS.SUSPECT');
                } else {
                    return config('constants.STATUS.GOOD');
                }
            }
        } else {
            return config('constants.STATUS.SUSPECT');
        }
    }
}
