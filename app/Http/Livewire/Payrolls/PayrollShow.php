<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use Livewire\Component;

class PayrollShow extends Component
{
    public $payroll;
    protected $listeners = [
        'refreshPayrollShow' => 'ActionRefreshPayrollShow'
    ];

    public function ActionRefreshPayrollShow()
    {

    }

    public function mount($payroll_id)
    {
        $this->payroll = Payroll::where('id', $payroll_id)->first();
    }

    public function render()
    {
        return view('livewire.payrolls.payroll-show');
    }
}
