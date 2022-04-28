<?php

namespace App\Http\Livewire\Items;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use App\Models\UnitItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class ItemCreate extends Component
{

    use WithFileUploads;
    public $item,$categories,$units;
    public $addItem = array();
    public function mount(){

         $this->categories  = Category::all();
         $this->units = Unit::all();

    }


    public function store()
    {
        $data = $this->validate([
            'item.name' => 'required',
            'item.path' => 'nullable|image|mimes:jpg,png',
            'item.item_number' => 'nullable',
            'item.serial_number' => 'nullable',
            'item.place' => 'nullable|string',
            'item.category_id' => 'nullable|int|exists:categories,id',
            'item.serial_multi' => 'required',
        ]);
        

      $item = Item::create($data['item']);

        if (!empty($this->item['path'])) {
            $file = $this->item['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'item_id' => $item->id,
            ]);
        }

        $this->emit('refreshItemsList');
        $this->dispatchBrowserEvent('close-modal');
        $this->reset('item','addItem');

    }

    public function render()
    {
        return view('livewire.items.item-create');
    }
}
