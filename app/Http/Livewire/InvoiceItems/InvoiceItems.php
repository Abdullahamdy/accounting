<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceItem;
use Livewire\WithPagination;
use App\Models\InvoiceDiscount;

class InvoiceItems extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $invoice;
    public $discount;
    public $sumdesc;

    public function mount($invoice_id)
    {
        if (is_object($invoice_id)) {
            $this->invoice = $invoice_id;
        } else {
            $this->invoice = Invoice::findOrFail($invoice_id);
            $this->discount = InvoiceDiscount::where('invoice_id', $this->invoice->id)->get();
             $this->sumdesc = 0;
            foreach($this->discount as $disc){
                $this->sumdesc = $this->sumdesc + ($disc->discount_quantity);

                 }
        }
    }

    protected $listeners = [
        'refreshInvoiceItemsList' => 'ActionRefreshInvoiceItemsList'
    ];

    function ActionRefreshInvoiceItemsList()
    {

    }

    public function render()
    {


        return view('livewire.invoice-items.invoice-items', [
            'invoice_items' => InvoiceItem::where('invoice_id', $this->invoice->id)->paginate(9),
            'invoice'=>Invoice::findOrFail($this->invoice->id),


        ]);
    }

    public function updateActivite(){
     $invoice =   Invoice::find($this->invoice->id);


         $invoice->update(['is_active'=>1]);

    }
}
