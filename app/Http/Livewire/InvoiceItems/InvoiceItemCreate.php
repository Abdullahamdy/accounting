<?php

namespace App\Http\Livewire\InvoiceItems;
use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;

class InvoiceItemCreate extends Component
{
    public $invoice_item = ['item_id'=> 0,'unit_id'=>0];
    public $invoice;
     public $item_number;
     public $unitsele = array();
     public $invoice_it;

    public function mount($invoice_id)
    {

        $this->invoice_it= InvoiceItem::where('invoice_id',$invoice_id)->first();



        if (is_object($invoice_id)) {
            $this->invoice = $invoice_id;
        } else {
            $this->invoice = Invoice::findOrFail($invoice_id);
        }
        $this->invoice_item['invoice_id'] = $this->invoice->id;
        $this->invoice_item['user_id'] =  0;
        $this->invoice_item['index_account_id'] = $this->invoice->index_account_id;


    }



    public function store()
    {
        $data = $this->validate([
            'invoice_item.description' => 'nullable',
            'invoice_item.item_name' => 'string',
            'invoice_item.invoice_id' => 'required|int|exists:invoices,id',
            'invoice_item.item_id' => 'required|int|exists:items,id',
            'invoice_item.user_id' => 'required|int',
            'invoice_item.unit_id' => 'required|int|exists:units,id',
            'invoice_item.index_account_id' => 'nullable|int|exists:index_accounts,id',
            'invoice_item.purchasing_price' => 'nullable',
            'invoice_item.selling_price' => 'nullable',
            'invoice_item.quantity' => 'nullable',
        ]);



        $item = Item::where('id', $data['invoice_item']['item_id'])->first();
        $data['invoice_item']['item_name'] = $item->name;
        ///////////////////////// فواتير البيع ///////////////////////////////



        if($this->invoice->type == 0 ){
            $item_unit = $item->units->where('id',$data['invoice_item']['unit_id'])->first();
                $item_unit->update([
                    'selling_price'=>$data['invoice_item']['selling_price'],
                ]);


            $quantity = $data['invoice_item']['quantity'];
            if($item->qut > $item_unit->pieces * $quantity){
                $item->update(['qut'=> ($item->qut) - $item_unit->pieces * $quantity]);
                $item_unit->update(['selling_price'=>$data['invoice_item']['selling_price']]);

            }else{
                $this->emit('alertFailed','the quantity not avaliable');
                return false;
            }


            $check_item_exists = InvoiceItem::where('invoice_id',$data['invoice_item']['invoice_id'])->where('item_name',$data['invoice_item']['item_name'])->where('unit_id',$data['invoice_item']['unit_id'])->first();
            if($check_item_exists ){

                $data['invoice_item']['quantity'] = $check_item_exists->quantity + $data['invoice_item']['quantity'];
                $check_item_exists->update($data['invoice_item']);

            }else{
                InvoiceItem::create($data['invoice_item']);
            }
        }




        ///////////////////// فواتير الشراء /////////////////////////

        if($this->invoice->type == 1)
        {

            $item_unit = $item->units->where('id',$data['invoice_item']['unit_id'])->first();
            $oldprice = $item_unit->purchasing_price;
            $oldquntity = $item->qut;
            $newPrice = $data['invoice_item']['purchasing_price'];
            $newquntity = $data['invoice_item']['quantity'] * $item_unit->pieces;
            $update_price = ($oldprice * $oldquntity + $newPrice * $newquntity) /($oldquntity + $newquntity);
            $item_unit->update(['purchasing_price'=>$update_price]);


            $item->update(['qut'=> $oldquntity + ($data['invoice_item']['quantity'] * $item_unit->pieces)]);
            $ifitemexist = InvoiceItem::where('invoice_id',$data['invoice_item']['invoice_id'])->where('item_name',$data['invoice_item']['item_name'])->where('unit_id',$data['invoice_item']['unit_id'])->first();


            if($ifitemexist){
                $data['invoice_item']['quantity'] =  ($data['invoice_item']['quantity'] * $item_unit->pieces) + $ifitemexist->quantity ;
                $ifitemexist->update($data['invoice_item']);
                 }else{

                 InvoiceItem::create($data['invoice_item']);

            }

        }

        $this->emit('refreshInvoiceItemsList');
        // $this->reset('invoice_item');
        // $this->invoice_item = ['item_id'=> 0,'unit_id'=> 0];



    }

    public function render()
    {


        $item = Item::find($this->invoice_item['item_id']);
        if ($item) {

            $this->invoice_item['quantity'] = 1;
            $newunit = $item->units->where('id',$this->invoice_item['unit_id'])->first();

            if (!$newunit) {
            $newunit = $item->units->where('item_id', $this->invoice_item['item_id'])->first();

           }


           $this->invoice_item['unit_id'] = $newunit ? $newunit->id : 0;


         $this->invoice_item['purchasing_price'] =  $newunit? $newunit->purchasing_price : 0 ;


        $this->invoice_item['selling_price'] =  $newunit? $newunit->selling_price : 0 ;



        }

        return view('livewire.invoice-items.invoice-item-create', [
            'items' => Item::all(),
            'invoices' => Invoice::all(),
            'users' => User::all(),
            'index_accounts' => IndexAccount::all(),
            'units'=>$item ? $item->units : []  ,
        ]);
    }

}

