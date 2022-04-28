<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\AccountGuide;
use App\Models\IndexAccount;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAccounts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $index_account_id, $account_guide_id, $basic;

    protected $listeners = [
        'refreshIndexAccountsList' => 'ActionRefreshIndexAccountsList'
    ];

    function ActionRefreshIndexAccountsList()
    {

    }

    public function mount()
    {
        if (request('search')) {
            $this->search = request('search');
        }

        if (request('index_account_id')) {
            $this->index_account_id = request('index_account_id');
        }

        if (array_key_exists(request('basic'),IndexAccount::basicList(false))){
            $this->basic = request('basic');
        }

        if (request('account_guide_id')) {
            $this->account_guide_id = request('account_guide_id');
        }
    }

    public function render()
    {
        $index_accounts = IndexAccount::query();
        if ($this->search) {
            $index_accounts = $index_accounts->where(function ($q){
                return $q->where('account_number', 'LIKE', "%$this->search%")
                    ->orWhere('account_name', 'LIKE', "%$this->search%");
            });
        }

        if ($this->index_account_id) {
            $index_accounts = $index_accounts->where('index_account_id', $this->index_account_id);
        }

        if (array_key_exists($this->basic, IndexAccount::basicList(false))) {
            $index_accounts = $index_accounts->where('basic', $this->basic);
        }

        if ($this->account_guide_id) {
            $index_accounts = $index_accounts->where('account_guide_id', $this->account_guide_id);
        }

        $index_accounts = $index_accounts->paginate(10);

        return view('livewire.index-accounts.index-accounts', [
            'index_accounts' => $index_accounts,
            'index_accounts_filter' => IndexAccount::all(),
            'account_guides' => AccountGuide::all(),
            'invoices_all'=>Invoice::all(),
        ]);
    }
}
