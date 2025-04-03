<?php

namespace App\Livewire\Dashboard\Unit;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $query = ''; // البحث
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function search()
    {
        $this->resetPage(); // تصفير الصفحات عند البحث
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->resetPage();
    }

    public function render()
    {
        $units = Unit::where('item_id', $this->item->id)
            ->when($this->query, function ($query) {
                $query->where('title', 'like', '%' . $this->query . '%');
            })
            ->paginate(10);

        return view('dashboard.unit.data', compact('units'));
    }

}
