<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\AccountGuide;
use App\Models\IndexAccount;
use Livewire\Component;

class IndexAccountEdit extends Component
{
    public $index_account;
    public function mount($index_account_id)
    {
        $this->index_account = IndexAccount::find($index_account_id);
        $this->index_account = $this->index_account->toArray();
        if ($this->index_account['index_account_id'] == 0) {
            $this->index_account['index_account_id'] = "";
        }
    }

    public function update()
    {
        $data = $this->validate([
            'index_account.account_number' => 'required',
            'index_account.account_name' => 'required',
            'index_account.index_account_id' => 'gt:0|exists:index_accounts,id',
            'index_account.account_guide_id' => 'required|int|exists:account_guides,id',
            'index_account.balance' => 'required',
            'index_account.basic' => 'in:0,1,2',
        ]);

        if ($data['index_account']['index_account_id'] == "") {
            unset($data['index_account']['index_account_id']);
        }

        $index_account_update = IndexAccount::find($this->index_account['id']);
        $index_account_update->update($data['index_account']);

        $this->emit('refreshIndexAccountsList');
        $this->emit('refreshIndexAccountShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.index-accounts.index-account-edit', [
            'index_accounts' => IndexAccount::all(),
            'account_guides' => AccountGuide::all()
        ]);
    }
}
