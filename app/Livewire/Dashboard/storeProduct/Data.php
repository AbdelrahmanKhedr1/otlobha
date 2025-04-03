<?php

namespace App\Livewire\Dashboard\storeProduct;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $search;
    public $id;
    public $store;
    public $startDate;
    public $endDate;
    public function mount($id,$store)
    {
        $this->id = $id;
        $this->store = $store;
    }
    public function searchPayments()
    {
        // لا تحتاج إلى كتابة أي شيء هنا لأن العرض سيتم تحديثه تلقائيًا عند تغيير الخصائص
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
        $query = Item::whereStoreId($this->store->id);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        } elseif ($this->search) {
            // $query->whereHas('product', function ($q) {
            //     $q->where('title', 'like', '%' . $this->search . '%');
            // });
            $query->join('products', 'items.product_id', '=', 'products.id')
            ->where('products.title', 'like', '%' . $this->search . '%');
        }
        $items = $query->orderByDesc('id')->paginate(15);




        return view(
            'dashboard.storeProduct.data',
            [
                'items' => $items,
                'store'=>$this->store
            ]
        );
    }
}
