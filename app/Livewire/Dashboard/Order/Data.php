<?php

namespace App\Livewire\Dashboard\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $store;
    public $startDate;
    public $endDate;
    public function mount($store)
    {
        $this->store = $store;
    }
    public function searchPayments()
    {
        // لا تحتاج إلى كتابة أي شيء هنا لأن العرض سيتم تحديثه تلقائيًا عند تغيير الخصائص
    }
    public function resetSearch()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function render()
    {

        $query = Order::whereStoreId($this->store->id);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        $orders = $query->orderByDesc('id')->paginate(1);
        return view('dashboard.order.data', ['orders' => $orders]);
    }
}

