<?php

namespace App\Livewire\Store\Item;

use App\Models\Item;
use App\Models\Tag as ModelsTag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tag extends Component
{
    public $item_id;
    public $tags = [];
    public $allTags = [];
    public $productTitle;

    protected $rules = [
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
    ];

    public function mount($itemId)
    {
        $this->item_id = $itemId;
        $this->loadTags();
    }

    public function loadTags()
    {
        $item = Item::with('product')->find($this->item_id);

        if (!$item) {
            abort(404, 'العنصر غير موجود');
        }

        $this->tags = $item->tags()->pluck('tags.id')->toArray();
        $this->allTags = ModelsTag::where('category_id', Auth::user()->store->category_id)->get(['id', 'name_ar', 'name_en']);
        $this->productTitle = $item->product->title ?? 'منتج غير معروف';
    }

    public function syncTags()
    {
        $item = Item::findOrFail($this->item_id);
        $validTags = ModelsTag::whereIn('id', $this->tags)
            ->where('category_id', Auth::user()->store->category_id)
            ->pluck('id')->toArray();

        $item->tags()->sync($validTags);

        session()->flash('message', "تم تحديث التاجات بنجاح للمنتج: {$this->productTitle}");
    }

    public function render()
    {
        return view('store.item.tag', [
            'productTitle' => $this->productTitle,
        ]);
    }
}
