<?php

namespace App\Http\Livewire\Invoices;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceEdit extends Component
{
    public $invoice = ['type' => 0];
    public function mount($invoice_id)
    {
        $this->invoice = Invoice::find($invoice_id);
        $this->invoice = $this->invoice->toArray();
    }

    public function update()
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

        $invoice_update = Invoice::find($this->invoice['id']);
        $invoice_update->update($data['invoice']);

        $this->emit('refreshInvoicesList');
        $this->emit('refreshInvoiceShow');
        $this->emit('refreshIndexAccountShow');
        $this->dispatchBrowserEvent('close-modal');
        return $this->redirect(route('invoices.show', ['invoice_id' => $invoice_update->id]));
    }

    public function render()
    {
        return view('livewire.invoices.invoice-edit', [
            'users' => User::all(),
            'index_accounts' => IndexAccount::all()
        ]);
    }
}
