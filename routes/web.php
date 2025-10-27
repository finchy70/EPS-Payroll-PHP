<?php

use App\Livewire\EndPeriod;
use App\Livewire\Payroll\EmployeeSelect;
use App\Livewire\Payroll\HoursSelectEmployee;
use App\Livewire\Payroll\PayrollEntry;
use App\Livewire\Payroll\PayrollSelect;
use App\Livewire\Payroll\TimesheetImport;
use App\Livewire\PeriodSummary;
use App\Livewire\ProjectExport;
use App\Livewire\ProjectHours;
use App\Livewire\ProjectHoursEmployee;
use App\Livewire\Setup\Leaver;
use App\Livewire\Setup\NewStarter;
use App\Models\Period;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $period = Period::query()->where('current', 1)->first();
    $periodString = $period->month.'-'.$period->year;
    return view('welcome', [
        'period' => $periodString,
    ]);
})->name('welcome');

Route::get('/employee-select', EmployeeSelect::class)->name('employee-select');
Route::get('/payroll-select', PayrollSelect::class)->name('payroll-select');
Route::get('/timesheet-import', TimesheetImport::class)->name('timesheet-import');
Route::get('/hours-select-employee', HoursSelectEmployee::class)->name('hours-select-employee');
Route::get('/view-hours/{data}', action: PayrollEntry::class)->name('payroll-entry');
Route::get('/period-summary', action: PeriodSummary::class)->name('period-summary');
Route::get('/project-hours', action: ProjectHours::class)->name('project-hours');
Route::get('/project-export', action: ProjectExport::class)->name('project-export');
Route::get('/project-hours-employee', action: ProjectHoursEmployee::class)->name('project-hours-employee');

Route::get('/setup-menu', function () {
    return view('setup.setup-menu');
})->name('setup.menu');

Route::get('/setup-new-starter', NewStarter::class)->name('setup.new-starter');
Route::get('/setup-leaver', Leaver::class)->name('setup.leaver');

Route::get('/quit', function () {
    Menu::quit();
})->name('quit');

Route::get('/setup-end-period', EndPeriod::class)->name('setup.end-period');
