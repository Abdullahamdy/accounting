<?php

namespace App\Http\Livewire\Categories;

use App\Models\Attachment;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryCreate extends Component
{
    use WithFileUploads;
    public $category;

    public function store()
    {
        $data = $this->validate([
            'category.name' => 'required',
            'category.path' => 'nullable|image|mimes:jpg,png',
            'category.description' => 'nullable',
        ]);

        $category = Category::create($data['category']);

        if (!empty($this->category['path'])) {
            $file = $this->category['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'category_id' => $category->id,
            ]);
        }

        $this->emit('refreshCategoriesList');
        $this->dispatchBrowserEvent('close-modal');
        $this->category = [];
    }

    public function render()
    {
        return view('livewire.categories.category-create');
    }
}
