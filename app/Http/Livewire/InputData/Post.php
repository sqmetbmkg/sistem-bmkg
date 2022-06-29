<?php

namespace App\Http\Livewire\InputData;

use App\Models\InputData;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Post extends Component
{
    public $upt;
    public $tanggal;
    public $jam;
    public $suhu;
    public $kelembapan;
    public $tekanan;

    public function mount()
    {
        if (session('username') == 'admin') {
            $this->upt = 0;
        } else {
            $this->upt = DB::table('stasiun')->where('wmo_id', '=', session('username'))->first()->id;
        }
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

    private function getPreviousData()
    {
        $data = DB::table('data')->where('waktu', 'LIKE', $this->tanggal . '%')->orderBy('waktu', 'desc')->get();

        $dataSuhu = NULL;
        $dataKelembapan = NULL;
        $dataTekanan = NULL;
        foreach ($data as $row) {
            if ($this->jam == explode(' ', $row->waktu)[1]) {
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

    public function simpan()
    {
        try {
            $dataError = DB::table('threshold_error')->orderBy('data', 'asc')->get();
            $dataSebelumnya = $this->getPreviousData();
            $thresholdSuspect = DB::table('threshold')->where('stasiun_id', '=', $this->upt)->first();
            $thresholdError['kelembapan'] = $dataError[0];
            $thresholdError['suhu'] = $dataError[1];
            $thresholdError['tekanan'] = $dataError[2];
            InputData::updateOrCreate(
                [
                    'stasiun_id' => $this->upt,
                    'waktu' => $this->tanggal . ' ' . $this->jam
                ],
                [
                    'data_suhu' => $this->suhu == "" ? NULL : $this->suhu,
                    'data_kelembapan' => $this->kelembapan == "" ? NULL : $this->kelembapan,
                    'data_tekanan' => $this->tekanan == "" ? NULL : $this->tekanan,
                    'hasil_rc_suhu' => $this->getHasilRC($this->suhu == "" ? NULL : $this->suhu, [
                        'bawah' => $thresholdSuspect->rc_batasbawah_suspect_suhu,
                        'atas' => $thresholdSuspect->rc_batasatas_suspect_suhu,
                    ], [
                        'bawah' => $thresholdError['suhu']->batas_bawah_error,
                        'atas' => $thresholdError['suhu']->batas_atas_error
                    ]),
                    'hasil_rc_kelembapan' => $this->getHasilRC($this->kelembapan == "" ? NULL : $this->kelembapan, [
                        'bawah' => $thresholdSuspect->rc_batasbawah_suspect_kelembapan,
                        'atas' => $thresholdSuspect->rc_batasatas_suspect_kelembapan,
                    ], [
                        'bawah' => $thresholdError['kelembapan']->batas_bawah_error,
                        'atas' => $thresholdError['kelembapan']->batas_atas_error
                    ]),
                    'hasil_rc_tekanan' => $this->getHasilRC($this->tekanan == "" ? NULL : $this->tekanan, [
                        'bawah' => $thresholdSuspect->rc_batasbawah_suspect_tekanan,
                        'atas' => $thresholdSuspect->rc_batasatas_suspect_tekanan,
                    ], [
                        'bawah' => $thresholdError['tekanan']->batas_bawah_error,
                        'atas' => $thresholdError['tekanan']->batas_atas_error
                    ]),
                    'hasil_sc_suhu' => $this->getHasilSC(($this->suhu == "" ? NULL : $this->suhu), $dataSebelumnya['suhu'], [
                        'bawah' => $thresholdSuspect->sc_batasbawah_suspect_suhu,
                        'atas' => $thresholdSuspect->sc_batasatas_suspect_suhu,
                    ]),
                    'hasil_sc_kelembapan' => $this->getHasilSC(($this->kelembapan == "" ? NULL : $this->kelembapan), $dataSebelumnya['kelembapan'], [
                        'bawah' => $thresholdSuspect->sc_batasbawah_suspect_kelembapan,
                        'atas' => $thresholdSuspect->sc_batasatas_suspect_kelembapan,
                    ]),
                    'hasil_sc_tekanan' => $this->getHasilSC(($this->tekanan == "" ? NULL : $this->tekanan), $dataSebelumnya['tekanan'], [
                        'bawah' => $thresholdSuspect->sc_batasbawah_suspect_tekanan,
                        'atas' => $thresholdSuspect->sc_batasatas_suspect_tekanan,
                    ]),
                ]
            );
            $this->dispatchBrowserEvent('berhasil-menyimpan');
            $this->resetExcept(['upt', 'tanggal', 'jam']);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('gagal-menyimpan');
        }
    }

    public function render()
    {
        $stations = DB::table('stasiun')->get(['id', 'nama_stasiun']);
        return view('livewire.input-data.post', [
            'stations' => $stations,
        ]);
    }
}
