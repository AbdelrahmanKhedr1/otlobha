<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Delete extends Component
{
    public $modelClass;
    public $modelId;

    protected $listeners = [
        'deleteItem' => 'confirmDelete',
    ];

    public function confirmDelete($model, $id)
    {
        $this->modelClass = 'App\\Models\\' . $model;
        $this->modelId = $id;
    }


    public function delete()
    {
        if ($this->modelClass && $this->modelId) {
            $model = app($this->modelClass)::find($this->modelId);
            if ($model) {
                $model->delete();
                session()->flash('message', 'تم الحذف بنجاح');
                $this->dispatch('refreshData');
            }
        }
    }
    public function render()
    {
        return view('dashboard.delete');
    }
}
