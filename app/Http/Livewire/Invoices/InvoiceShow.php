<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class InvoiceShow extends Component
{
    public $invoice;
    public $date ;
    public $user;
    protected $listeners = [
        'refreshInvoiceShow' => 'ActionRefreshInvoiceShow'
    ];

    public function ActionRefreshInvoiceShow()
    {

    }

    public function mount($invoice_id)
    {
        if(auth()->user()->hasRole('Admin')) {
            $this->invoice = Invoice::where('id', $invoice_id)->firstOrFail();
        } else {
            $this->invoice = Invoice::where('id', $invoice_id)->where('user_id', auth()->id())->firstOrFail();
        }
    }
    public function selectUser($user_id){
       
        
            $this->user = User::find($user_id);
            $this->invoice->user_id = $this->user->id;
            $this->invoice->invoice_date = $this->date;
            $this->invoice->save();
            $this->emit('refreshInvoiceShow');
            $this->dispatchBrowserEvent('close-modal');

       
        

        
    }

    public function render()
    {
        return view('livewire.invoices.invoice-show',[
            'users' => User::role((($this->invoice and $this->invoice['type'] == 1 ) ? 'Customer': 'Supplier'))->get(),
        ]);
    }
  
}
