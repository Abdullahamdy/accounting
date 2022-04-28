<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoryDelete extends Component
{
    public $category;

    public function mount($category_id)
    {
        $this->category = Category::find($category_id);
    }

    public function delete()
    {
        $category = Category::find($this->category['id']);
        $category->delete();

        $this->emit('refreshCategoriesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.categories.category-delete');
    }
}
