<?php

namespace App\Http\Livewire\InvoiceDiscounts;

use App\Models\User;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceItem;
use App\Models\InvoiceDiscount;

class InvoiceDiscountCreate extends Component
{


    public $invoice_discount = ['discount_quantity'=>0];
    public $invoice, $type;
    public $total = 0;
    public $sumdesc = 0 ;
    public $discount;

    public function mount($invoice_id)
    {

        if ($invoice_id) {
            if (is_object($invoice_id)) {
                $this->invoice = $invoice_id;
            } else {
                $this->invoice = Invoice::findOrFail($invoice_id);
                $invoice_items = InvoiceItem::where('invoice_id', $invoice_id)->get();
                $this->total = 0;
                if ($this->invoice->type == 1) {
                    foreach ($invoice_items as $invoice_item) {
                        $this->total = $this->total + ($invoice_item->purchasing_price * $invoice_item->quantity);
                    }
                    $this->discount = InvoiceDiscount::where('invoice_id', $this->invoice->id)->get();
                    foreach ($this->discount as $disc) {
                        $this->sumdesc = $this->sumdesc + ($disc->discount_quantity);
                    }
                }
                else{
                    $invoice_items = InvoiceItem::where('invoice_id', $invoice_id)->get();
                    foreach ($invoice_items as $invoice_item) {

                        $this->total = $this->total + ($invoice_item->unit->selling_price * $invoice_item->quantity);                    }

                }


            }
            $this->invoice_discount['invoice_id'] = $this->invoice->id;
            $this->invoice_discount['user_id'] = $this->invoice->user_id;
        }
        if (array_key_exists(request('type'),Invoice::typeList(false))){
            $this->type = request('type');
        }
        $this->invoice_discount['type'] = $this->type;
        if($this->invoice_discount['discount_quantity']){
            $this->store();

        }
        $this->invoice_discount['discount_quantity']=($discount = InvoiceDiscount::where('invoice_id',$this->invoice_discount['invoice_id'])->first()) ? $discount->discount_quantity : 0;

    }

    public function store()
    {
        $totalPrice = $this->total - $this->sumdesc;


        $data = $this->validate([
            'invoice_discount.invoice_id' => 'nullable|int|exists:invoices,id',
            'invoice_discount.user_id' => 'nullable|int|exists:users,id',
            'invoice_discount.discount_quantity' => 'required',
        ]);
        $discountquntity = $data['invoice_discount']['discount_quantity'] ;
        if( $discountquntity <= $totalPrice){
            InvoiceDiscount::updateOrCreate([
                'invoice_id'=>$data['invoice_discount']['invoice_id']
            ],$data['invoice_discount']);
        }else{

        }




        $this->emit('refreshInvoiceDiscountsList');
        $this->emit('refreshInvoiceShow');
        $this->emit('refreshInvoiceItemsList');


        $this->dispatchBrowserEvent('close-modal');


    }

    public function render()
    {
        return view('livewire.invoice-discounts.invoice-discount-create', [
            'invoices' => Invoice::all(),
            'users' => User::all()
        ]);
    }
}
