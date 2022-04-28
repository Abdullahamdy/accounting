<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Settings extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshSettingsList' => 'ActionRefreshSettingsList'
    ];

    function ActionRefreshSettingsList()
    {

    }

    public function render()
    {
        return view('livewire.settings.settings', [
            'settings' => Setting::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
