<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\AccountGuide;
use App\Models\IndexAccount;
use Livewire\Component;

class IndexAccountCreate extends Component
{
    public $index_account;

    public function store()
    {
        $data = $this->validate([
            'index_account.account_number' => 'required',
            'index_account.account_name' => 'required',
            'index_account.index_account_id' => 'int|exists:index_accounts,id|numeric|gt:0',
            'index_account.account_guide_id' => 'required|int|exists:account_guides,id',
            'index_account.balance' => 'required',
            'index_account.basic' => 'in:0,1,2',
        ]);

        $index_account = IndexAccount::create($data['index_account']);

        $this->emit('refreshIndexAccountsList');
        $this->dispatchBrowserEvent('close-modal');
        $this->index_account = [];
    }

    public function render()
    {
        return view('livewire.index-accounts.index-account-create', [
            'index_accounts' => IndexAccount::all(),
            'account_guides' => AccountGuide::all()
        ]);
    }
}
