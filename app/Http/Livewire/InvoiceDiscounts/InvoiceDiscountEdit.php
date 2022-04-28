<?php

namespace App\Http\Livewire\InvoiceDiscounts;

use App\Models\Invoice;
use App\Models\InvoiceDiscount;
use App\Models\User;
use Livewire\Component;

class InvoiceDiscountEdit extends Component
{
    public $invoice_discount;
    public function mount($invoice_discount_id)
    {
        $this->invoice_discount = InvoiceDiscount::find($invoice_discount_id);
        $this->invoice_discount = $this->invoice_discount->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'invoice_discount.invoice_id' => 'nullable|int|exists:invoices,id',
            'invoice_discount.user_id' => 'nullable|int|exists:users,id',
            'invoice_discount.discount_quantity' => 'required',
        ]);

        $invoice_discount_update = InvoiceDiscount::find($this->invoice_discount['id']);
        $invoice_discount_update->update($data['invoice_discount']);

        $this->emit('refreshInvoiceDiscountsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.invoice-discounts.invoice-discount-edit', [
            'invoices' => Invoice::all(),
            'users' => User::all()
        ]);
    }
}
