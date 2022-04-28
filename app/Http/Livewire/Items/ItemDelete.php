<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class ItemDelete extends Component
{
    public $item;

    public function mount($item_id)
    {
        $this->item = Item::find($item_id);
    }

    public function delete()
    {
        $item = Item::find($this->item['id']);
        $item->unit_item()->delete();
        $item->delete();

        $this->emit('refreshItemsList');
        $this->emit('refreshCategoryShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.items.item-delete');
    }
}
