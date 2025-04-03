<?php

namespace App\Livewire\Store\Order;

use App\Models\Order;
use App\Models\Store;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $store;
    public $search = '';
    public $startDate = null;
    public $endDate = null;

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    public function searchPayments()
    {
        // تحديث البيانات عند البحث
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('store_id', $this->store->id)
            ->when($this->search, function ($query) {
                $query->whereHas('customer', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', Carbon::parse($this->startDate));
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', Carbon::parse($this->endDate));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('store.order.data', compact('orders'));
    }

}
