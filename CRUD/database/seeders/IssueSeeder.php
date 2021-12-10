<?php

// Name: Vera Korchemnaya
// Description: Database Seeder
//      This class is used to seed the database
//      with made up data for testing

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the database of existing issues
        \App\Models\Issue::truncate();

        // Iterate n times to create n issues using faker
        $faker = \Faker\Factory::create();

        // We will make 100 records
        foreach (range(1, 100) as $number) {

            \App\Models\Issue::create(
                [
                    'title' => ucwords($faker->words($faker->numberBetween(1, 2), true)),
                    'volume' => $faker->numberBetween(1, 100),
                    'issue_number' => $faker->numberBetween(1, 100),
                    'month' => $faker->numberBetween(1, 12),
                    'year' => $faker->numberBetween(1837, 2021),
                    'condition' => $faker->numberBetween(1, 8),
                    'writer_last_name' => $faker->lastName(),
                    'writer_first_name' => $faker->firstName(),
                    'artist_last_name' => $faker->lastName(),
                    'artist_first_name' => $faker->firstName(),
                ]
            );
        }
    }
}
