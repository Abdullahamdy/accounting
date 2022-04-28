<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'refreshItemsList' => 'ActionRefreshItemsList'
    ];

    function ActionRefreshItemsList()
    {

    }

    public function mount()
    {
        if (request('search')) {
            $this->search = request('search');
        }
    }

    public function render()
    {
        $items = Item::query();
        if ($this->search) {
            $items = $items->where(function ($q){
                return $q->where('name', 'LIKE', "%$this->search%")
                        ->orWhere('item_number', 'LIKE', "%$this->search%")
                        ->orWhere('serial_number', 'LIKE', "%$this->search%")
                        ->orWhere('place', 'LIKE', "%$this->search%");
                });
        }
        $items = $items->paginate(10);

        return view('livewire.items.items', [
            'items' => $items
        ]);
    }
}
