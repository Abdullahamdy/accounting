<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\ArrestReceipt;
use Livewire\Component;

class ArrestReceiptDelete extends Component
{
    public $arrest_receipt;

    public function mount($arrest_receipt_id)
    {
        $this->arrest_receipt = ArrestReceipt::find($arrest_receipt_id);
    }

    public function delete()
    {
        $arrest_receipt = ArrestReceipt::find($this->arrest_receipt['id']);
        $arrest_receipt->delete();

        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.arrest-receipts.arrest-receipt-delete');
    }
}
