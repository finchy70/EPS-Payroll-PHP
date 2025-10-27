<?php

namespace App\Livewire\Payroll;

use App\Models\Period;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class PayrollSelect extends Component
{
    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.payroll.payroll-select');
    }
}
