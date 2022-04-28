<?php

namespace App\Http\Livewire\AccountGuides;

use App\Models\AccountGuide;
use Livewire\Component;

class AccountGuideCreate extends Component
{
    public $account_guide;

    public function store()
    {
        $data = $this->validate([
            'account_guide.title' => 'required',
        ]);

        $account_guide = AccountGuide::create($data['account_guide']);

        $this->emit('refreshAccountGuidesList');
        $this->dispatchBrowserEvent('close-modal');
        $this->account_guide = [];
    }

    public function render()
    {
        return view('livewire.account-guides.account-guide-create');
    }
}
