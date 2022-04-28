<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class SettingDelete extends Component
{
    public $setting;

    public function mount($setting_id)
    {
        $this->setting = Setting::find($setting_id);
    }

    public function delete()
    {
        $setting = Setting::find($this->setting['id']);
        $setting->delete();

        $this->emit('refreshSettingsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.settings.setting-delete');
    }
}
