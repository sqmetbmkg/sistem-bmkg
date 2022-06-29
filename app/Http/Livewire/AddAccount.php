<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddAccount extends Component
{
    public $name, $username, $password, $repeatPassword;

    protected $rules= [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'repeatPassword' => 'required|same:password'
    ];

    public function addAccount()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password)
        ]);

        $this->emit('saved');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.add-account');
    }
}
