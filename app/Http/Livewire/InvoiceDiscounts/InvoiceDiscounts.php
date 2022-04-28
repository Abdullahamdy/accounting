<?php

namespace App\Http\Livewire\InvoiceDiscounts;

use App\Models\Invoice;
use App\Models\InvoiceDiscount;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceDiscounts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $invoice, $invoice_id, $user_id, $type;

    public function mount(?Invoice $invoice_id)
    {
        if ($invoice_id) {
            if (is_object($invoice_id)) {
                $this->invoice = $invoice_id;
            } else {
                $this->invoice = Invoice::findOrFail($invoice_id);
            }
        }

        if (request('invoice_id')) {
            $this->invoice_id = request('invoice_id');
        }

        if (request('user_id')) {
            $this->user_id = request('user_id');
        }

        if (array_key_exists(request('type'),Invoice::typeList(false))){
            $this->type = request('type');
        }
    }

    protected $listeners = [
        'refreshInvoiceDiscountsList' => 'ActionRefreshInvoiceDiscountsList'
    ];

    function ActionRefreshInvoiceDiscountsList()
    {

    }

    public function render()
    {
        $invoice_discounts = InvoiceDiscount::query();
        if ($this->invoice->id) {
            $invoice_discounts = $invoice_discounts->where('invoice_id', $this->invoice->id);
        } else {
            $invoice_discounts = InvoiceDiscount::query();
        }

        if ($this->invoice_id) {
            
            $invoice_discounts = $invoice_discounts->where('invoice_id', $this->invoice_id);
        }

        if (array_key_exists($this->type, Invoice::typeList(false))) {
            $invoice_discounts = $invoice_discounts->whereHas('invoice', function ($q){
                return $q->where('type', $this->type);
            });
        }

        if ($this->user_id) {
            $invoice_discounts = $invoice_discounts->where('user_id', $this->user_id);
        }

        $invoice_discounts = $invoice_discounts->paginate(10);

        return view('livewire.invoice-discounts.invoice-discounts', [
            'invoice_discounts' => $invoice_discounts,
            'users' => User::all(),
            'invoices' => Invoice::all()
        ]);
    }
}
