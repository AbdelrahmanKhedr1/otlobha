<?php

namespace App\Livewire\Dashboard\Store;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search = '';
    public $id;
    public $category;
    public $startDate;
    public $endDate;

    public function mount($id, $category)
    {
        $this->id = $id;
        $this->category = $category;
    }

    public function searchStores()
    {
        $this->resetPage(); // إعادة تعيين الصفحة عند البحث
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
        $query = Store::whereCategoryId($this->id);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $stores = $query->orderByDesc('id')->paginate(10);

        return view('dashboard.store.data', [
            'stores' => $stores,
            'category' => $this->category
        ]);
    }
}
