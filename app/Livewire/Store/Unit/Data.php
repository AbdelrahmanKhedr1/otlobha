<?php

namespace App\Livewire\Store\Unit;

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $query = ''; // البحث
    public $item;

    protected $listeners = ['refreshData' => '$refresh'];

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
        // dd(Auth::user()->store->id);
        $units = Unit::where('item_id', $this->item->id)
            ->where('store_id', Auth::user()->store->id)
            ->when($this->query, function ($query) {
                $query->where('title', 'like', '%' . $this->query . '%');
            })
            ->paginate(10);

        return view('store.unit.data', compact('units'));
    }

}
