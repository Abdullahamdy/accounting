<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\User;
use Livewire\Component;

class PayrollEdit extends Component
{
    public $payroll;
    public function mount($payroll_id)
    {
        $this->payroll = Payroll::find($payroll_id);
        $this->payroll = $this->payroll->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'payroll.user_id' => 'required|int|exists:users,id',
            'payroll.advance' => 'nullable',
        ]);

        $payroll_update = Payroll::find($this->payroll['id']);
        $payroll_update->update($data['payroll']);

        $this->emit('refreshPayrollsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.payrolls.payroll-edit', [
            'users' => User::all()
        ]);
    }
}
