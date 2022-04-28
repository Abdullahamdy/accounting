<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use Livewire\Component;

class PayrollDelete extends Component
{
    public $payroll;

    public function mount($payroll_id)
    {
        $this->payroll = Payroll::find($payroll_id);
    }

    public function delete()
    {
        $payroll = Payroll::find($this->payroll['id']);
        $payroll->delete();

        $this->emit('refreshPayrollsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.payrolls.payroll-delete');
    }
}
