<?php

namespace App\Http\Livewire\AccountGuides;

use App\Models\AccountGuide;
use Livewire\Component;

class AccountGuideShow extends Component
{
    public $account_guide;
    protected $listeners = [
        'refreshAccountGuideShow' => 'ActionRefreshAccountGuideShow'
    ];

    public function ActionRefreshAccountGuideShow()
    {

    }

    public function mount($account_guide_id)
    {
        $this->account_guide = AccountGuide::where('id', $account_guide_id)->first();
    }

    public function render()
    {
        return view('livewire.account-guides.account-guide-show');
    }
}
