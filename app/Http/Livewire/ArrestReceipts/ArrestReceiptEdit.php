<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class ArrestReceiptEdit extends Component
{
    public $arrest_receipt;
    public function mount($arrest_receipt_id)
    {
        $this->arrest_receipt = ArrestReceipt::find($arrest_receipt_id);
        $this->arrest_receipt = $this->arrest_receipt->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            
            'arrest_receipt.user_id' => 'nullable|int|exists:users,id',
            'arrest_receipt.batch_quantity' => 'required',
            'arrest_receipt.type' => 'in:0,1',
        ]);

        $arrest_receipt_update = ArrestReceipt::find($this->arrest_receipt['id']);
        $arrest_receipt_update->update($data['arrest_receipt']);

        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.arrest-receipts.arrest-receipt-edit', [
            'invoices' => Invoice::all(),
            'users' => User::all()
        ]);
    }
}
