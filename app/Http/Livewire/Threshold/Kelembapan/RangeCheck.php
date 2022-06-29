<?php

namespace App\Http\Livewire\Threshold\Kelembapan;

use App\Http\Livewire\Threshold\Threshold as ThresholdThreshold;
use App\Models\Threshold;
use Exception;
use Livewire\Component;

class RangeCheck extends Component
{
    public $batasAtasSuspect;
    public $batasBawahSuspect;
    public $id_stasiun;

    protected $listeners = ['changeUPT' => 'changeStasiun'];

    public function changeStasiun($id_stasiun)
    {
        $this->id_stasiun = $id_stasiun;
        $data = Threshold::where('stasiun_id', $id_stasiun)->first();

        if ($data) {
            $this->batasBawahSuspect = $data->rc_batasbawah_suspect_kelembapan;
            $this->batasAtasSuspect = $data->rc_batasatas_suspect_kelembapan;
        } else {
            $this->resetExcept('id_stasiun');
        }
    }

    public function simpan()
    {
        try {
            Threshold::updateOrCreate(
                [
                    'stasiun_id' => $this->id_stasiun,
                ],
                [
                    'rc_batasatas_suspect_kelembapan' => $this->batasAtasSuspect,
                    'rc_batasbawah_suspect_kelembapan' => $this->batasBawahSuspect
                ]
            );
            $this->dispatchBrowserEvent('berhasil-menyimpan');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('gagal-menyimpan');
        }
    }

    public function render()
    {
        return view('livewire.threshold.kelembapan.range-check');
    }
}
