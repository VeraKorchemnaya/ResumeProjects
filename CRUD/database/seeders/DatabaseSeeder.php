<?php
// Name: Vera Korchemnaya
// Description: Seeder
//      Here we just added a call to our IssueSeeder

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
        $this->call(IssueSeeder::class);
    }
}
