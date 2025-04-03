<?php

namespace App\Livewire\Dashboard\Company;

use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    public $companyId; // لتخزين ID الشركة
    public $title;     // لتخزين اسم الشركة

    protected $listeners = [
        'editCompany' => 'loadCompany', // الاستماع لحدث تحميل بيانات الشركة
    ];

    // دالة تحميل بيانات الشركة بناءً على ID
    public function loadCompany($id)
    {
        $company = Company::find($id);
        if ($company) {
            $this->companyId = $company->id;
            $this->title = $company->title;
            // dd($company);
        }
    }

    // دالة تحديث بيانات الشركة
    public function update()
    {
        // التحقق من صحة البيانات
        $this->validate([
            'title' => 'required|string|max:255',
        ], [
            'title.required' => 'اسم الشركة مطلوب',
            'title.string' => 'اسم الشركة يجب أن يكون نصًا',
            'title.max' => 'اسم الشركة يجب ألا يتجاوز 255 حرفًا',
        ]);

        $company = Company::find($this->companyId);
        if ($company) {
            $company->update([
                'title' => $this->title,
            ]);
            session()->flash('message', 'تم تعديل الشركة بنجاح');
            $this->reset(['companyId', 'title']); // إعادة تعيين الحقول
            $this->dispatch('refreshData')->to(Data::class); // إرسال حدث لتحديث مكون Data
        }
    }
    public function render()
    {
        return view('dashboard.company.edit');
    }
}
