<?php

namespace App\Http\Livewire\InvoiceDiscounts;

use App\Models\InvoiceDiscount;
use Livewire\Component;

class InvoiceDiscountShow extends Component
{
    public $invoice_discount;
    protected $listeners = [
        'refreshInvoiceDiscountShow' => 'ActionRefreshInvoiceDiscountShow'
    ];

    public function ActionRefreshInvoiceDiscountShow()
    {

    }

    public function mount($invoice_discount_id)
    {
        $this->invoice_discount = InvoiceDiscount::where('id', $invoice_discount_id)->first();
    }

    public function render()
    {
        return view('livewire.invoice-discounts.invoice-discount-show');
    }
}
