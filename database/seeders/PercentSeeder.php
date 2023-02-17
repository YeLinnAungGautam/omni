<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Percentages;

class PercentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Percentages::create([
            'percentage' => '1'
        ]);
    }
}
