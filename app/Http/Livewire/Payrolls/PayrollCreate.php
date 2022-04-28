<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\User;
use Livewire\Component;

class PayrollCreate extends Component
{
    public $payroll;

    public function store()
    {
        $data = $this->validate([
            'payroll.user_id' => 'required|int|exists:users,id',
            'payroll.advance' => 'nullable',
        ]);

        $payroll = Payroll::create($data['payroll']);

        $this->emit('refreshPayrollsList');
        $this->dispatchBrowserEvent('close-modal');
        $this->payroll = [];
    }

    public function render()
    {
        return view('livewire.payrolls.payroll-create', [
            'users' => User::all()
        ]);
    }
}
