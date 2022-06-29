<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAPI extends Controller
{
    private $dataSuhu = [];
    private $dataKelembapan = [];
    private $dataTekanan = [];
    private $dataStatus = [];
    private $dataWarna = [];

    public function __construct()
    {
        for($i = 0; $i < 24; $i++) {
            $this->dataSuhu[$i] = 'NaN';
            $this->dataKelembapan[$i] = 'NaN';
            $this->dataTekanan[$i] = 'NaN';
            $this->dataStatus[$i] = 'ERROR';
            $this->dataWarna[$i] = 'RED';
        }
    }
    public function getDataStasiun($idStasiun, $waktu)
    {
        $data = DB::table('data')->where('stasiun_id', '=', $idStasiun)
                                ->where('waktu', 'like', $waktu . '%')
                                ->orderBy('waktu')
                                ->get();
        $namaStasiun = DB::table('stasiun')->where('id', '=', $idStasiun)->first()->nama_stasiun;
        // Data
        $dataSuhu = $this->getDataSuhu($data);
        $dataKelembapan = $this->getDataKelembapan($data);
        $dataTekanan = $this->getDataTekanan($data);

        // Status
        $statusSuhu = $this->getStatusSuhu($data);
        $statusKelembapan = $this->getStatusKelembapan($data);
        $statusTekanan = $this->getStatusTekanan($data);

        // Warna
        $warnaSuhu = $this->getWarna($statusSuhu);
        $warnaKelembapan = $this->getWarna($statusKelembapan);
        $warnaTekanan = $this->getWarna($statusTekanan);

        // Response
        $response = [
            [
                'id' => $namaStasiun,
                'datapoints' => $dataSuhu,
                'status' => $statusSuhu,
                'colors' =>$warnaSuhu
            ],
            [
                'id' => $namaStasiun,
                'datapoints' => $dataKelembapan,
                'status' => $statusKelembapan,
                'colors' =>$warnaKelembapan
            ],
            [
                'id' => $namaStasiun,
                'datapoints' => $dataTekanan,
                'status' => $statusTekanan,
                'colors' =>$warnaTekanan
            ],
        ];

        return response()->json($response);
    }

    private function getWarna($dataStatus)
    {
        $dataWarna = $this->dataWarna;
        for($i = 0; $i < 24; $i++) {
            $warna = 'red';
            if ($dataStatus[$i] == 'SUSPECT') {
                $warna = 'yellow';
            }
            if ($dataStatus[$i] == 'GOOD') {
                $warna = 'green';
            }

            $dataWarna[$i] = $warna;
        }

        return $dataWarna;
    }

    private function getStatusSuhu($data)
    {
        $dataStatus = $this->dataStatus;
        foreach($data as $row) {
            if ($row->hasil_rc_suhu == 'SUSPECT' || $row->hasil_sc_suhu == 'SUSPECT') {
                $status = 'SUSPECT';
            }
            if ($row->hasil_rc_suhu == 'GOOD' && $row->hasil_sc_suhu == 'GOOD') {
                $status = 'GOOD';
            }

            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            
            $dataStatus[$idx] = $status;
        }

        return $dataStatus;
    }

    private function getStatusKelembapan($data)
    {
        $dataStatus = $this->dataStatus;
        foreach($data as $row) {
            if ($row->hasil_rc_kelembapan == 'SUSPECT' || $row->hasil_sc_kelembapan == 'SUSPECT') {
                $status = 'SUSPECT';
            }
            if ($row->hasil_rc_kelembapan == 'GOOD' && $row->hasil_sc_kelembapan == 'GOOD') {
                $status = 'GOOD';
            }

            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            
            $dataStatus[$idx] = $status;
        }

        return $dataStatus;
    }

    private function getStatusTekanan($data)
    {
        $dataStatus = $this->dataStatus;
        foreach($data as $row) {
            if ($row->hasil_rc_tekanan == 'SUSPECT' || $row->hasil_sc_tekanan == 'SUSPECT') {
                $status = 'SUSPECT';
            }
            if ($row->hasil_rc_tekanan == 'GOOD' && $row->hasil_sc_tekanan == 'GOOD') {
                $status = 'GOOD';
            }

            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            
            $dataStatus[$idx] = $status;
        }

        return $dataStatus;
    }

    private function getDataSuhu($data)
    {
        $dataSuhu = $this->dataSuhu;
        foreach($data as $row) {
            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            $dataSuhu[$idx] = $row->data_suhu;
        }
        
        return $dataSuhu;
    }

    private function getDataKelembapan($data)
    {
        $dataKelembapan = $this->dataKelembapan;
        foreach($data as $row) {
            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            $dataKelembapan[$idx] = $row->data_kelembapan;
        }
        
        return $dataKelembapan;
    }

    private function getDataTekanan($data)
    {
        $dataTekanan = $this->dataTekanan;
        foreach($data as $row) {
            $idx = (int) explode(':', explode(' ', $row->waktu)[1])[0];
            $dataTekanan[$idx] = $row->data_tekanan;
        }
        
        return $dataTekanan;
    }
}
