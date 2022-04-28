<?php

namespace App\Http\Livewire\AccountGuides;

use App\Models\AccountGuide;
use Livewire\Component;

class AccountGuideEdit extends Component
{
    public $account_guide;
    public function mount($account_guide_id)
    {
        $this->account_guide = AccountGuide::find($account_guide_id);
        $this->account_guide = $this->account_guide->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'account_guide.title' => 'required',
        ]);

        $account_guide_update = AccountGuide::find($this->account_guide['id']);
        $account_guide_update->update($data['account_guide']);

        $this->emit('refreshAccountGuidesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.account-guides.account-guide-edit');
    }
}
