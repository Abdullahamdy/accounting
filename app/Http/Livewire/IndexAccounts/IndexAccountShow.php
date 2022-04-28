<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\IndexAccount;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAccountShow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $index_account;
    protected $listeners = [
        'refreshIndexAccountShow' => 'ActionRefreshIndexAccountShow'
    ];

    public function ActionRefreshIndexAccountShow()
    {

    }

    public function mount($index_account_id)
    {
        $this->index_account = IndexAccount::where('id', $index_account_id)->first();
    }

    public function render()
    {
        $invoices = Invoice::where('index_account_id', $this->index_account->id)->paginate(5);
        return view('livewire.index-accounts.index-account-show', compact('invoices'));
    }
}
