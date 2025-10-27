<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Period;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Period::query()->create([
            'month' => 'July',
            'year' => '2025',
            'we1' => '2025-06-08',
            'we2' => '2025-06-15',
            'we3' => '2025-06-22',
            'we4' => '2025-06-29',
            'current' => true,
            'imported' => false
        ]);
    }
}
