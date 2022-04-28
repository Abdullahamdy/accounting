<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\InvoiceItem;
use Livewire\Component;

class InvoiceItemDelete extends Component
{
    public $invoice_item;

    public function mount($invoice_item_id)
    {
        $this->invoice_item = InvoiceItem::find($invoice_item_id);
    }

    public function delete()
    {
        $invoice_item = InvoiceItem::find($this->invoice_item['id']);
        $invoice_item->delete();

        $this->emit('refreshInvoiceItemsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.invoice-items.invoice-item-delete');
    }
}
