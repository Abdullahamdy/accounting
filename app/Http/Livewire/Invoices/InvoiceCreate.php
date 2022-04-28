<?php

namespace App\Http\Livewire\Invoices;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceCreate extends Component
{
    public $invoice, $type;

  
    public function mount()
    {

        if (array_key_exists(request('type'),Invoice::typeList(false))){
            $this->type = request('type');
        }
        $this->invoice['type'] = $this->type;

    }

    public function store()
    {

        $data = $this->validate([
            'invoice.invoice_number' => 'required',
            'invoice.description' => 'nullable',
            'invoice.invoice_date' => 'date',
            'invoice.last_invoice_payment_date' => 'date',
            'invoice.invoice_payment_date' => 'date',
            'invoice.total_price' => 'nullable',
            'invoice.status' => 'in:0,1',
            'invoice.type' => 'in:0,1',
            'invoice.user_id' => 'required|int|exists:users,id',
            'invoice.index_account_id' => 'nullable|int|exists:index_accounts,id',
        ]);
        $data['invoice']['invoice_date'] = Carbon::now();

        $invoice = Invoice::create($data['invoice']);

        $this->emit('refreshInvoicesList');
        $this->emit('refreshInvoiceShow');
        $this->dispatchBrowserEvent('close-modal');
        $this->invoice = [];
        return $this->redirect(route('invoices.show', ['invoice_id' => $invoice->id]));
    }

    public function render()
    {

        if ($this->invoice['type'] == 0) {
            $role = 'Customer';
        } else {
            $role = 'Supplier';
        }
        return view('livewire.invoices.invoice-create', [
            'users' => User::whereHas('roles', function ($q) use ($role){
                return $q->where('name', $role);
            })->get(),
            'index_accounts' => IndexAccount::all()
        ]);
    }
}
