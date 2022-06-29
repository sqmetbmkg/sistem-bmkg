<?php

namespace App\Http\Livewire\Threshold\Kelembapan;

use App\Models\Threshold;
use Exception;
use Livewire\Component;

class StepCheck extends Component
{
    public $batasAtas;
    public $batasBawah;
    public $id_stasiun;

    protected $listeners = ['changeUPT' => 'changeStasiun'];

    public function changeStasiun($id_stasiun)
    {
        $this->id_stasiun = $id_stasiun;
        $data = Threshold::where('stasiun_id', $id_stasiun)->first();

        if ($data) {
            $this->batasBawah = $data->sc_batasbawah_suspect_tekanan;
            $this->batasAtas = $data->sc_batasatas_suspect_tekanan;
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
                    'sc_batasatas_suspect_tekanan' => $this->batasAtas,
                    'sc_batasbawah_suspect_tekanan' => $this->batasBawah
                ]
            );
            $this->dispatchBrowserEvent('berhasil-menyimpan');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('gagal-menyimpan');
        }
    }
    
    public function render()
    {
        return view('livewire.threshold.kelembapan.step-check');
    }
}
