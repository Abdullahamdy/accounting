<?php

namespace App\Http\Livewire\AccountGuides;

use App\Models\AccountGuide;
use Livewire\Component;
use Livewire\WithPagination;

class AccountGuides extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshAccountGuidesList' => 'ActionRefreshAccountGuidesList'
    ];

    function ActionRefreshAccountGuidesList()
    {

    }

    public function render()
    {
        return view('livewire.account-guides.account-guides', [
            'account_guides' => AccountGuide::paginate(5)
        ]);
    }
}
