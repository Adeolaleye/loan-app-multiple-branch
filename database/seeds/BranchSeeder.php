<?php

namespace Database\Seeders;

use DB;
use App\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('branches')->truncate();

        $branches = [
            [
                'name' => 'Tanke Branch',
                'logo' => 'logo.png',
                'address' => 'Tanke Ilorin Kwara State',
                'email' => 'info@consode.com',
                'phone_number' => '08160540083',
                'is_active' => '1'
            ],
            [
                'name' => 'Maraba Branch',
                'logo' => 'logo.png',
                'address' => 'Maraba Ilorin Kwara State',
                'email' => 'adeola@consode.com',
                'phone_number' => '08160540083',
                'is_active' => '1'  
            ]
        ];
    
        foreach ($branches as $branchData) {
            Branch::create($branchData);
        }
    }
}
