<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class SeedEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-employees';

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
        $csv = Reader::createFromPath('C:\Users\Paul\Herd\NativePayroll\database\EPSEmployees.csv', 'r');
        $csv->setHeaderOffset(0);
        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords();
        foreach ($records as $record) {
            Employee::create($record);
        }
    }
}
