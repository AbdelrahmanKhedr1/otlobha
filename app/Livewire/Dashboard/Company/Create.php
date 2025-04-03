<?php

namespace App\Livewire\Dashboard\Company;

use App\Models\Company;
use Livewire\Component;

class Create extends Component
{
    public $title;

    protected $rules = [
        'title' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Company::create([
            'title' => $this->title,
        ]);

        session()->flash('message', 'تمت إضافة الشركة بنجاح');
        $this->dispatch('refreshData'); // إرسال حدث لتحديث القائمة
        $this->reset(); // إعادة تعيين المدخلات

    }

    public function render()
    {
        return view('dashboard.company.create');
    }
}
