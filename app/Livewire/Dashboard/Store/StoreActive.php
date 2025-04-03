<?php

namespace App\Livewire\Dashboard\Store;

use App\Models\Store;
use Livewire\Component;

class StoreActive extends Component
{
    public $store;

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    public function toggleActive()
    {
        $this->store->active = $this->store->active == 0 ? '1' : '0';
        $this->store->save();

        $this->dispatch('activeUpdated');
    }

    public function render()
    {
        return view('dashboard.store.store-active');
    }
}
