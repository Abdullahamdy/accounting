<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;
use App\Models\Category;
use App\Models\UnitItem;
use App\Models\Attachment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class ItemEdit extends Component
{
    use WithFileUploads;
    public $item;
    public $unitsele = array();

    public function mount($item_id)
    {
        $this->item = Item::find($item_id);
        $this->unitsele = $this->item->units->pluck('id')->toArray();
        $this->item = $this->item->toArray();
    }
    public function update()
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

        if (empty($data['item']['path']) || $data['item']['path'] == "") {
            if (!empty($data['item']['path'])) {
                unset($data['item']['path']);
            }
        }

        $item_update = Item::find($this->item['id']);
    //     if(!empty($this->unitsele)){
    //         $item_update->unit_item()->delete();
    //         foreach($this->unitsele as $el){
    //             UnitItem::create([
    //                 'unit_id'=>$el,
    //                 'item_id'=>$this->item['id']
    //             ]);
    //             unset($this->unitsele);


    //         }
    //    }
        $item_update->update($data['item']);


        if (!empty($this->item['path'])) {
            $file = $this->item['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'item_id' => $item_update['id'],
            ]);
        }


        $this->emit('refreshItemsList');
        $this->emit('refreshCategoryShow');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function render()
    {

        return view('livewire.items.item-edit', [
            'categories' => Category::all(),
            'unititems' => Unit::all(),



        ]);
    }
}
