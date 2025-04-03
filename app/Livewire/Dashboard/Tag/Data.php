<?php

namespace App\Livewire\Dashboard\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $listeners = ['refreshData' => '$refresh'];
    public $query = '';

    public function updatingQuery()
    {
        $this->resetPage(); // إعادة تعيين الصفحة عند البحث الجديد
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
        $tags = Tag::where('name_en', 'like', "%{$this->query}%")
            ->orWhere('name_ar', 'like', "%{$this->query}%")
            ->orderByDesc('id')
            ->paginate(10); // تحديد عدد العناصر لكل صفحة

        return view('dashboard.tag.data', compact('tags'));
    }
}
