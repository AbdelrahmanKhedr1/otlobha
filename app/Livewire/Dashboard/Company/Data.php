<?php

namespace App\Livewire\Dashboard\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $query = '';

    protected $listeners = ['refreshData' => '$refresh'];

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
        $companies = Company::where('title', 'like', "%{$this->query}%")
            ->orderByDesc('id')
            ->paginate(10);
        return view('dashboard.company.data', compact('companies'));
    }
}
