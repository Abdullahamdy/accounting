<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshCategoriesList' => 'ActionRefreshCategoriesList'
    ];

    function ActionRefreshCategoriesList()
    {

    }

    public function render()
    {
        return view('livewire.categories.categories', [
            'categories' => Category::paginate(5)
        ]);
    }
}
