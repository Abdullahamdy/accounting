<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\Item;
use App\Models\Unit;
use App\Models\User;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceItem;
use App\Models\IndexAccount;

class InvoiceItemEdit extends Component
{
    public $invoice_item;
    public $invoice;

    public function mount($invoice_item_id, $invoice_id)
    {
        $this->invoice_item = InvoiceItem::find($invoice_item_id);
        $this->invoice_item = $this->invoice_item->toArray();

        if (is_object($invoice_id)) {
            $this->invoice = $invoice_id;
        } else {
            $this->invoice = Invoice::findOrFail($invoice_id);
        }
        $this->invoice_item['invoice_id'] = $this->invoice->id;
        $this->invoice_item['user_id'] = $this->invoice->user_id;
        $this->invoice_item['index_account_id'] = $this->invoice->index_account_id;
    }

    public function update()
    {
        $data = $this->validate([
            'invoice_item.description' => 'nullable',
            'invoice_item.item_name' => 'string',
            'invoice_item.invoice_id' => 'required|int|exists:invoices,id',
            'invoice_item.item_id' => 'required|int|exists:items,id',
            'invoice_item.user_id' => 'required|int|exists:users,id',
            'invoice_item.unit_id' => 'required|int|exists:units,id',
            'invoice_item.index_account_id' => 'nullable|int|exists:index_accounts,id',
            'invoice_item.purchasing_price' => 'nullable',
            'invoice_item.selling_price' => 'nullable',
            'invoice_item.quantity' => 'nullable',
        ]);
        $item = Item::where('id', $data['invoice_item']['item_id'])->first();
        $data['invoice_item']['item_name'] = $item->name;
        $invoice_item_update = InvoiceItem::find($this->invoice_item['id']);
        $invoice_item_update->update($data['invoice_item']);
        if(!empty($invoice_item_update))
        {
            $oldqut = $item->qut;
            $newqut = $invoice_item_update->quantity;
            $oldprice = $item->purchasing_price;
            $newprice = $invoice_item_update->purchasing_price;
            $purchasing_price =  ($oldprice*$oldqut+$newprice*$newqut)/($oldqut+$newqut);
            $piecesqut = $invoice_item_update->unit->pieces * $data['invoice_item']['quantity'];
            $item->update(['purchasing_price'=> $purchasing_price,'qut'=>$piecesqut]);
        }


        $this->emit('refreshInvoiceItemsList');
        $this->emit('refreshInvoiceShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.invoice-items.invoice-item-edit', [
            'items' => Item::all(),
            'invoices' => Invoice::all(),
            'users' => User::all(),
            'index_accounts' => IndexAccount::all(),
            'units'=>Unit::all()
        ]);
    }
}
