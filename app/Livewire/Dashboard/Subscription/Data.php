<?php

namespace App\Livewire\Dashboard\Subscription;

use App\Models\subscription;
use Livewire\Component;

class Data extends Component
{
    public $search;

    public function render()
    {
        $subscriptions = subscription::where('end_at', '>=', now())
            ->whereHas('store', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->with('store')->orderBy('id', 'desc')->get();
        return view(
            'dashboard.subscription.data',
            [
                'subscriptions' => $subscriptions
            ]
        );
    }
}
