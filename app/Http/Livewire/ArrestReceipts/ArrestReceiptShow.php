<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\User;
use Livewire\Component;
use App\Models\ArrestReceipt;
class ArrestReceiptShow extends Component
{
    public $arrest_receipt;
    public $batch_quantity;
    public $user;
    protected $listeners = [
        'refreshArrestReceiptShow' => 'ActionRefreshArrestReceiptShow'
    ];

    public function ActionRefreshArrestReceiptShow()
    {

    }

    public function mount($arrest_receipt_id)
    {
        
        $this->arrest_receipt = ArrestReceipt::where('id', $arrest_receipt_id)->first();
    }
    public function selectUser($user_id){
       
        
        $this->user = User::find($user_id);
        $this->arrest_receipt->user_id = $this->user->id;
        $this->arrest_receipt->batch_quantity = $this->batch_quantity;
        $this->arrest_receipt->save();
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');

   
    

    
}

    public function render()
    {
        return view('livewire.arrest-receipts.arrest-receipt-show',[
            'users' => User::role((($this->arrest_receipt and $this->arrest_receipt['type'] == 1) ? 'Customer': 'Supplier'))->get(),
        ]);
    }
}
