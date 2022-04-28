<?php

namespace App\Http\Livewire\AccountGuides;

use App\Models\AccountGuide;
use Livewire\Component;

class AccountGuideDelete extends Component
{
    public $account_guide;

    public function mount($account_guide_id)
    {
        $this->account_guide = AccountGuide::find($account_guide_id);
    }

    public function delete()
    {
        $account_guide = AccountGuide::find($this->account_guide['id']);
        $account_guide->delete();

        $this->emit('refreshAccountGuidesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.account-guides.account-guide-delete');
    }
}
