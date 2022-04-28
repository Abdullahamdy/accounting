<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceDelete extends Component
{
    public $invoice;

    public function mount($invoice_id)
    {
        $this->invoice = Invoice::find($invoice_id);
    }

    public function delete()
    {
        $invoice = Invoice::find($this->invoice['id']);
        $invoice->delete();

        $this->emit('refreshInvoicesList');
        $this->emit('refreshIndexAccountShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.invoices.invoice-delete');
    }
}
