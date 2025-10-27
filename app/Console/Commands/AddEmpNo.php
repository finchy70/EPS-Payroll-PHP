<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\LocalUser;
use App\Models\User;
use Illuminate\Console\Command;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class AddEmpNo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-emp-no';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws UnavailableStream
     * @throws Exception
     */
    public function handle()
    {
        $localUsersWithEmpNumbers = Employee::query()->whereNotNull('emp_no')->get();
        foreach ($localUsersWithEmpNumbers as $localUser) {
            $user = User::query()->where('name', $localUser->name)->first();
            if($user != null){
                $user->update(['emp_no' => $localUser->emp_no]);
                dd($user);
            }
        }
    }
}
