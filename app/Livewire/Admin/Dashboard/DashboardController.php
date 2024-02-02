<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\Traits\Notifies;
use App\Services\Admin\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardController extends Component
{
    use Notifies;

    public function render(DashboardService $dashboardService): View
    {
        return view('livewire.admin.dashboard.dashboard-controller', $dashboardService->getData());
    }

}
