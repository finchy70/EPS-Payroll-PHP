<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Console\Command;

class SeedTimesheets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-timesheets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()->where('current', true)->get();
        foreach ($users as $user) {
            $payrollUser = Employee::where('name', $user->name)->first();
            if($payrollUser != null) {
                dump($payrollUser->name);
                $user->update(['emp_no' => $payrollUser->emp_no]);
            } else
            {
                dump($user->name);
            }
        }

//        $users = User::get();
//        foreach ($users as $user) {
//            $payrollUser = Employee::where('name', $user->name)->first();
//            if($payrollUser != null) {
//                $user->update(['current' => 1]);
//                dump($user->name, $payrollUser->name);
//            } else {
//                $user->update(['current' => 0]);
//            }
//        }

    }
}
