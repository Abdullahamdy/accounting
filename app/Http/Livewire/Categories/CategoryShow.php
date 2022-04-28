<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryShow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category;

    protected $listeners = [
        'refreshCategoryShow' => 'ActionRefreshCategoryShow'
    ];

    public function ActionRefreshCategoryShow()
    {

    }

    public function mount($category_id)
    {
        $this->category = Category::where('id', $category_id)->first();
    }

    public function render()
    {
        $items = Item::where('category_id', $this->category->id)->paginate(10);
        return view('livewire.categories.category-show', [
            'items' => $items
        ]);
    }
}
