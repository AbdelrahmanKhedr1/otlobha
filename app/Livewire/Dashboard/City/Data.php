<?php

namespace App\Livewire\Dashboard\City;

use Livewire\Component;

class Data extends Component
{
    public $city;

    public function mount($city)
    {
        $this->city = $city;
    }

    public function toggleStatus()
    {
        $this->city->status = $this->city->status == 0 ? '1' : '0';
        $this->city->save();

        $this->dispatch('statusUpdated');
    }

    public function render()
    {
        return view('dashboard.city.data');
    }
}
