<?php

namespace App\Http\Livewire\Settings;

use App\Models\Attachment;
use App\Models\IndexAccount;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingCreate extends Component
{
    use WithFileUploads;
    public $setting;

    public function store()
    {
        $data = $this->validate([
            'setting.company_name' => 'required',
            'setting.company_phone' => 'nullable',
            'setting.company_email' => 'nullable|email',
            'setting.company_address' => 'nullable',
            'setting.company_manager' => 'nullable',
            'setting.company_description' => 'nullable',
            'setting.path' => 'nullable|image|mimes:jpg,png',
            'setting.payment_selling_account_index_id'=>'required',
            'setting.payment_parchasing_account_index_id'=>'required',
            'setting.inbox_account_index_id'=>'required',
            'setting.salary_account_index_id'=>'required',
            'setting.customers_account_index_id'=>'required',
            'setting.discount_earned_account_index_id'=>'required',
            'setting.allowed_discount_account_index_id'=>'required',
        ]);



        $setting = Setting::create($data['setting']);

        if (!empty($this->setting['path'])) {
            $file = $this->setting['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'setting_id' => $setting->id,
            ]);
        }

        $this->emit('refreshSettingsList');
        $this->dispatchBrowserEvent('close-modal');
        $this->setting = [];
    }

    public function render()
    {
        return view('livewire.settings.setting-create',[
            'index_accounts'=>IndexAccount::all(),
        ]);
    }
}
