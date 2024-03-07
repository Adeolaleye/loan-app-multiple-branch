<?php

use App\Branch;
use Illuminate\Database\Seeder;
use Database\Seeders\BranchSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchSeeder::class);
    }
}

