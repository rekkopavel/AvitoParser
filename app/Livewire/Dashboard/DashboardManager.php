<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DashboardManager extends Component
{
    public $currentModule = 'query-manager';

    public function render()
    {
        return view('livewire.dashboard.dashboard-manager');
    }

    public function switchModule($module)
    {
        $this->currentModule = $module; // Меняем модуль
    }
}
