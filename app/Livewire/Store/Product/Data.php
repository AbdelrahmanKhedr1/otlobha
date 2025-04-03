<?php

namespace App\Livewire\Store\Product;

use App\Models\Product;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $query = '';
    public $store;
    public $selectedProducts = [];
    public $selectAll = false;
    public $showAvailableProducts = false;

    protected $listeners = ['refreshData' => '$refresh'];

    public function mount($store)
    {
        $this->store = $store;
        $this->loadAddedProducts();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->resetPage();
    }

    public function toggleShowAvailable()
    {
        $this->showAvailableProducts = !$this->showAvailableProducts;
        $this->selectedProducts = [];
        $this->selectAll = false;
        $this->resetPage();
    }

    public function toggleSelectAll()
    {
        $products = $this->getProductsQuery()->pluck('id')->toArray();
        $this->selectedProducts = $this->selectAll ? [] : $products;
        $this->selectAll = !$this->selectAll;
    }

    public function addSelectedProducts()
    {
        if (empty($this->selectedProducts)) {
            return;
        }

        // تحسين الأداء باستخدام عملية دفعة واحدة
        $itemsToCreate = array_map(function ($productId) {
            return [
                'store_id' => $this->store->id,
                'product_id' => $productId,
                'category_id' => $this->store->category->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $this->selectedProducts);

        Item::insert($itemsToCreate); // إدراج جماعي لتحسين الأداء
        $this->loadAddedProducts();
        $this->selectedProducts = [];
        $this->selectAll = false;

        session()->flash('message', 'تمت إضافة المنتجات المحددة بنجاح!');
    }

    private function loadAddedProducts()
    {
        $this->selectedProducts = Item::where('store_id', $this->store->id)
            ->pluck('product_id')
            ->toArray();
    }

    protected function getProductsQuery()
    {
        return Product::where('category_id', $this->store->category->id)
            ->when($this->query, fn($query) => $query->where('title', 'like', '%' . $this->query . '%'))
            ->when($this->showAvailableProducts,
                fn($query) => $query->whereNotIn('id', Item::where('store_id', $this->store->id)->pluck('product_id')),
                fn($query) => $query->whereIn('id', Item::where('store_id', $this->store->id)->pluck('product_id'))
            );
    }

    public function getItemId($productId)
    {
        return Item::where('store_id', $this->store->id)
            ->where('product_id', $productId)
            ->value('id');
    }

    public function render()
    {
        $products = $this->getProductsQuery()->paginate(10);
        return view('store.product.data', compact('products'));
    }
}
