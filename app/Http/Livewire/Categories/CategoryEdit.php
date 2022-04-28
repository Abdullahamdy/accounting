<?php

namespace App\Http\Livewire\Categories;

use App\Models\Attachment;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryEdit extends Component
{
    use WithFileUploads;
    public $category;
    public function mount($category_id)
    {
        $this->category = Category::find($category_id);
        $this->category = $this->category->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'category.name' => 'required',
            'category.path' => 'nullable|image|mimes:jpg,png',
            'category.description' => 'nullable',
        ]);

        if (empty($data['category']['path']) || $data['category']['path'] == "") {
            if (!empty($data['category']['path'])) {
                unset($data['category']['path']);
            }
        }

        $category_update = Category::find($this->category['id']);
        $category_update->update($data['category']);

        if (!empty($this->category['path'])) {
            $file = $this->category['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'category_id' => $category_update['id'],
            ]);
        }

        $this->emit('refreshCategoriesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.categories.category-edit');
    }
}
