<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class ArrestReceiptCreate extends Component
{

    public $arrest_receipt = ['batch_quantity'=>0];
    public $invoice, $type = 0;
    public $invoice_id;

    public function mount($invoice_id = null)
    {



        $invoice_id = $this->invoice_id;


        if ($invoice_id) {
            if (is_object($invoice_id)) {
                $this->invoice = $invoice_id;
            } else {
                $this->invoice = Invoice::findOrFail($invoice_id);
            }
            $this->arrest_receipt['invoice_id'] = $this->invoice->id;
            // $this->arrest_receipt['user_id'] = $this->invoice->user_id;
            $this->arrest_receipt['user_id'] = 0;
        }
        if (array_key_exists(request('type'),ArrestReceipt::typeList(false))){
            $this->type = request('type');
        }
        $this->arrest_receipt['type'] = $this->type;
        if($this->arrest_receipt['batch_quantity']){
            $this->store();
        }

        if(!empty($this->arrest_receipt['batch_quantity'])){
        $this->arrest_receipt['batch_quantity']=($arrest = ArrestReceipt::where('invoice_id',$this->arrest_receipt['invoice_id'])->first()) ? $arrest->batch_quantity : 0;

        }


    }

  

    public function store()
    {



        $data = $this->validate([

            'arrest_receipt.user_id' => 'nullable|int',
            'arrest_receipt.batch_quantity' => 'required',
            // 'arrest_receipt.type' => 'in:0,1',
        ]);
    //   $user = User::find($data['arrest_receipt']['user_id']);
    //  $invoices =  $user->invoices()->where('type',$data['arrest_receipt']['type'])->where('status',0)->get();
         $data['arrest_receipt']['invoice_id'] =  $this->invoice_id;

         $data['arrest_receipt']['type'] = $this->type;

    if($data['arrest_receipt']['batch_quantity'] > 0 ){
        if($this->invoice_id){
            ArrestReceipt::updateOrCreate([
                'invoice_id'=>$data['arrest_receipt']['invoice_id']
            ],$data['arrest_receipt']);
        }else{
            ArrestReceipt::create($data['arrest_receipt']);
        }



    }


        $this->emit('refreshArrestReceiptsList');
            $this->emit('refreshInvoiceShow');
        $this->dispatchBrowserEvent('close-modal');
        if ($this->invoice) {
            $this->arrest_receipt = [];
            $this->arrest_receipt['invoice_id'] = $this->invoice->id;
            $this->arrest_receipt['type'] = $this->invoice->type;
            $this->arrest_receipt['user_id'] = $this->invoice->user_id;
        }
    }

    public function render()
    {
        return view('livewire.arrest-receipts.arrest-receipt-create', [
            'invoices' => Invoice::all(),
            'users' => User::role((($this->arrest_receipt and $this->arrest_receipt['type'] == 1) ? 'Customer': 'Supplier'))->get(),
        ]);
    }
}
