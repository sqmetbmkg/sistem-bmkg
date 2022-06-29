<?php

namespace App\Http\Livewire\Threshold;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Threshold extends Component
{
    public $id_stasiun;

    public function render()
    {
        $stations = DB::table('stasiun')->get(['id', 'nama_stasiun']);
        return view('livewire.threshold.threshold', [
            'stations' => $stations,
            'id_stasiun' => $this->id_stasiun
        ]);
    }

    public function changeUPT()
    {
        $this->emit('changeUPT', $this->id_stasiun);
    }
}
