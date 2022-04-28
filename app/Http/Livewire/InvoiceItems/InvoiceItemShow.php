<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\InvoiceItem;
use Livewire\Component;

class InvoiceItemShow extends Component
{
    public $invoice_item;
    protected $listeners = [
        'refreshInvoiceItemShow' => 'ActionRefreshInvoiceItemShow'
    ];

    public function ActionRefreshInvoiceItemShow()
    {

    }

    public function mount($invoice_item_id)
    {
        $this->invoice_item = InvoiceItem::where('id', $invoice_item_id)->first();
    }

    public function render()
    {
        return view('livewire.invoice-items.invoice-item-show');
    }
}
