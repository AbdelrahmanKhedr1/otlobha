<?php

namespace App\Livewire\Dashboard\DashOffers;

use App\Models\DashboardOffer;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refreshData' => '$refresh'];

    public function render()
    {
        return view('dashboard.dash-offers.data', [
            'dashOffers' => DashboardOffer::orderByDesc('id')->paginate(8)
        ]);
    }

}
