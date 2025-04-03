<?php

namespace App\Livewire\Store\Offer;

use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search;
    public $store;
    protected $listeners = ['refreshData' => '$refresh'];
    public function mount($store)
    {
        $this->store = $store;
    }
    public function render()
    {
        return view(
            'store.offer.data',
            [
                'offers' => Offer::whereStoreId($this->store->id)->where('title', 'like', '%' . $this->search . '%')->paginate(10),
                'store'=>$this->store
            ]
        );
    }

}
