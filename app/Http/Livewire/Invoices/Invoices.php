<?php

namespace App\Http\Livewire\Invoices;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class Invoices extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $from, $to, $user_id, $index_account_id, $status, $type;

    protected $listeners = [
        'refreshInvoicesList' => 'ActionRefreshInvoicesList'
    ];

    function ActionRefreshInvoicesList()
    {

    }

    public function mount()
    {

        if (request('search')) {
            $this->search = request('search');
        }

        if (request('user_id')) {
            $this->user_id = request('user_id');
        }

        if (request('index_account_id')) {
            $this->index_account_id = request('index_account_id');
        }

        if (array_key_exists(request('status'),Invoice::statusList(false))){
            $this->status = request('status');
        }

        if (array_key_exists(request('type'),Invoice::typeList(false))){
            $this->type = request('type');
        }

        $this->from = date('2022-01-01');
        $this->to = date('Y-m-d');

        $this->from = date('Y-m-d', strtotime($this->from));
        $this->to = date('Y-m-d', strtotime($this->to));

        if (request('from')) {
            $this->from = request('from');
        }

        if (request('to')) {
            $this->to = request('to');
        }
    }

    public function render()
    {
        $invoices = Invoice::query();
        if (auth()->user()->hasRole('Admin')) {
            $invoices = $invoices;
        } else {
            $invoices = Invoice::where('user_id', auth()->id());
        }

        if ($this->search) {
            $invoices = $invoices->where(function ($q){
                return $q->where('invoice_number', 'LIKE', "%$this->search%")->orWhere('description', 'LIKE', "%$this->search%");
            });
        }

        if (array_key_exists($this->status, Invoice::statusList(false))) {
            $invoices = $invoices->where('status', $this->status);
        }

        if (array_key_exists($this->type, Invoice::typeList(false))) {
            $invoices = $invoices->where('type', $this->type);
        }

        if ($this->user_id) {
            $invoices = $invoices->where('user_id', $this->user_id);
        }

        if ($this->index_account_id) {
            $invoices = $invoices->where('index_account_id', $this->index_account_id);
        }

        if ($this->from && $this->to) {
            $invoices = $invoices->where(function ($q){
                return $q->whereBetween('invoice_date', [$this->from.' 00:00:00', $this->to.' 23:59:59']);
            });
        
        $invoices = $invoices->paginate(10);

        return view('livewire.invoices.invoices', [
            'invoices' => $invoices,
            'users' => User::all(),
            'index_accounts' => IndexAccount::all()
        ]);
    }
}



    public function addinvoice($type){
        
        if ($type == 0 || $type == 1) {
            
            $invoice_num = Invoice::where('type',$type)->max('invoice_number')+1;
            $invoice =  Invoice::create([
         'invoice_number'=> $invoice_num,
         'user_id'=>0,
         'is_active'=>0,
         'type'=>$type,
     ]);
            if ($invoice) {
                return redirect()->route('invoices.show', ['invoice_id' => $invoice->id]);
            }
        }
    }
}
