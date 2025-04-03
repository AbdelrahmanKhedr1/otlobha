<?php
namespace App\Livewire\Dashboard\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $listeners = ['refreshData' => '$refresh'];

    public $store;
    public $startDate;
    public $endDate;

    public function mount($store)
    {
        $this->store = $store;
    }

    public function searchPayments()
    {
        $this->resetPage(); // إعادة تعيين الصفحة عند البحث
    }

    public function resetSearch()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }



    public function render()
    {
        $query = Payment::whereStoreId($this->store->id);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        $payments = $query->orderByDesc('id')->paginate(10);

        return view('dashboard.payment.data', [
            'payments' => $payments
        ]);
    }
}
