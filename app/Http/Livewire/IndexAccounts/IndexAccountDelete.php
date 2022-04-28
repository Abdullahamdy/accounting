<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\IndexAccount;
use Livewire\Component;

class IndexAccountDelete extends Component
{
    public $index_account;

    public function mount($index_account_id)
    {
        $this->index_account = IndexAccount::find($index_account_id);
    }

    public function delete()
    {
        $index_account = IndexAccount::find($this->index_account['id']);
        $index_account->delete();

        $this->emit('refreshIndexAccountsList');
        $this->emit('refreshIndexAccountShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.index-accounts.index-account-delete');
    }
}
