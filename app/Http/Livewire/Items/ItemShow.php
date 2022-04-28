<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class ItemShow extends Component
{
    public $item;
    protected $listeners = [
        'refreshItemShow' => 'ActionRefreshItemShow'
    ];

    public function ActionRefreshItemShow()
    {

    }

    public function mount($item_id)
    {
        $this->item = Item::where('id', $item_id)->first();
    }

    public function render()
    {
        return view('livewire.items.item-show');
    }
}
