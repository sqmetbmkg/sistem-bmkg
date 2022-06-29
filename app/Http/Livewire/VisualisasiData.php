<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VisualisasiData extends Component
{
    public $isShow = false;
    public $isEmpty = false;
    public $date;
    public $namaUPT;
    protected $listeners = ['toggleModal', 'toggleEmpty', 'initEmpty'];

    public function initEmpty()
    {
        $this->isEmpty = false;
    }

    public function toggleEmpty()
    {
        $this->isEmpty = !$this->isEmpty;
    }

    public function toggleModal($nama)
    {
        $this->namaUPT = $nama;
        $this->isShow = !$this->isShow;
    }

    public function render()
    {
        return view('livewire.visualisasi-data');
    }
}
