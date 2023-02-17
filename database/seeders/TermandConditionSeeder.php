<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TermAndCondition;

class TermandConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       TermAndCondition::create([
            'description' => 'Hello I am term and condition'
        ]);
    }
}
