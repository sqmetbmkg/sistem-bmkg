<?php

namespace App\Http\Livewire\Threshold\Tekanan;

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
            $this->batasBawahSuspect = $data->rc_batasbawah_suspect_tekanan;
            $this->batasAtasSuspect = $data->rc_batasatas_suspect_tekanan;
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
                    'rc_batasatas_suspect_tekanan' => $this->batasAtasSuspect,
                    'rc_batasbawah_suspect_tekanan' => $this->batasBawahSuspect
                ]
            );
            $this->dispatchBrowserEvent('berhasil-menyimpan');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('gagal-menyimpan');
        }
    }
    
    public function render()
    {
        return view('livewire.threshold.tekanan.range-check');
    }
}
