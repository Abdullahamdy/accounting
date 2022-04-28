<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class SettingShow extends Component
{
    public $setting;
    protected $listeners = [
        'refreshSettingShow' => 'ActionRefreshSettingShow'
    ];

    public function ActionRefreshSettingShow()
    {

    }

    public function mount($setting_id)
    {
        $this->setting = Setting::where('id', $setting_id)->first();
    }

    public function render()
    {
        return view('livewire.settings.setting-show');
    }
}
