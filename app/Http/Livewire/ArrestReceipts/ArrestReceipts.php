<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ArrestReceipts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $invoice, $invoice_id, $user_id, $type;

    public function mount($invoice_id = null)
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

        if (array_key_exists(request('type'),ArrestReceipt::typeList(false))){
            $this->type = request('type');
        }
    }

    protected $listeners = [
        'refreshArrestReceiptsList' => 'ActionRefreshArrestReceiptsList'
    ];

    function ActionRefreshArrestReceiptsList()
    {

    }
    public function add_arrest($type){


        if ($type == 0 || $type == 1) {

       $arrest =  ArrestReceipt::create([
         'user_id'=>0,
         'type'=>$type,
     ]);

     if($arrest){
        return redirect()->route('details-receipts.show', ['arrest_receipt_id' => $arrest->id]);
     }

        }

        $this->type = $this->type;
    }

    public function render()
    {
        $arrest_receipts = ArrestReceipt::query();
        if ($this->invoice AND $this->invoice->id) {

            $arrest_receipts = $arrest_receipts->where('invoice_id', $this->invoice->id);

        }

        if ($this->user_id) {
            $arrest_receipts = $arrest_receipts->where('user_id', $this->user_id);
        }

        if (array_key_exists($this->type, ArrestReceipt::typeList(false))) {
            $arrest_receipts = $arrest_receipts->where('type', $this->type);
        }

        if ($this->type == 0) {
            $invoices = Invoice::whereHas('arrest_receipts', function ($q){
                return $q->where('type', 0);
            })->get();
        } elseif($this->type == 1) {
            $invoices = Invoice::whereHas('arrest_receipts', function ($q){
                return $q->where('type', 1);
            })->get();
        }

        $arrest_receipts = $arrest_receipts->paginate(10);
        return view('livewire.arrest-receipts.arrest-receipts', [
            'arrest_receipts' => $arrest_receipts,
            'users' => User::all(),
            'invoices' => $invoices,
        ]);

    }
}
