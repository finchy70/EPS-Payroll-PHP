<?php

namespace App\Livewire\Setup;

use App\Models\Employee;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Leaver extends Component
{
    public array $employees = [];
    public ?int $selectedLeaver = null;
    public ?Employee $leaver = null;

    public function back(): void
    {
        $this->redirect(route('setup.menu'));
    }

    public function save(): void
    {
        if($this->selectedLeaver == null)
        {
            flash()->error("You must select a leaver.");
        } else {
            $this->leaver = Employee::find($this->selectedLeaver);
            Flux::modal('leaver-modal')->show();
        }
    }

    public function confirm(): void
    {
        $this->leaver->update(['current' => false]);
        Flux::modal('leaver-modal')->close();
        flash()->success("You have made ".$this->leaver->name." a leaver.");
    }

    public function render(): View|Application|\Illuminate\View\View
    {
        $this->employees = Employee::query()->where('current', true)->where('emp_no', '!=', null)->orderBy('name')->get()->toArray();
        return view('livewire.setup.leaver');
    }
}
