<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $query = '';

    protected $listeners = ['refreshData' => '$refresh'];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->query = '';  // إعادة ضبط البحث
        $this->resetPage(); // إعادة تعيين الترقيم
    }

    public function render()
    {
        $products = Product::where('title', 'like', "%{$this->query}%")
            ->paginate(9);

        return view('dashboard.product.data', compact('products'));
    }
}
