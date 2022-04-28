<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Attachment;
use App\Models\IndexAccount;
use Livewire\WithFileUploads;

class SettingEdit extends Component
{
    use WithFileUploads;
    public $setting;
    public function mount($setting_id)
    {
        $this->setting = Setting::find($setting_id);
        $this->setting = $this->setting->toArray();
    }

    public function update()
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

        if (empty($data['setting']['path']) || $data['setting']['path'] == "") {
            if (!empty($data['setting']['path'])) {
                unset($data['setting']['path']);
            }
        }

        $setting_update = Setting::find($this->setting['id']);
        $setting_update->update($data['setting']);

        if (!empty($this->setting['path'])) {
            $file = $this->setting['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'setting_id' => $setting_update['id'],
            ]);
        }

        $this->emit('refreshSettingsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.settings.setting-edit',[
            'index_accounts'=>IndexAccount::all(),
        ]);
    }
}
