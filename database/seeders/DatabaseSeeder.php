<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PercentSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(TermandConditionSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
