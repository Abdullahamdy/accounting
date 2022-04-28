<?php

namespace App\Http\Livewire\InvoiceDiscounts;

use App\Models\InvoiceDiscount;
use Livewire\Component;

class InvoiceDiscountDelete extends Component
{
    public $invoice_discount;

    public function mount($invoice_discount_id)
    {
        $this->invoice_discount = InvoiceDiscount::find($invoice_discount_id);
    }

    public function delete()
    {
        $invoice_discount = InvoiceDiscount::find($this->invoice_discount['id']);
        $invoice_discount->delete();

        $this->emit('refreshInvoiceDiscountsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.invoice-discounts.invoice-discount-delete');
    }
}
