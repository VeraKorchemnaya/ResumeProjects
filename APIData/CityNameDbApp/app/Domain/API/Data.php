<?php

/*  
Name: Vera Korchemnaya
Description: 
    Instead of entering data manually using tinker I have created
    this file to add data into the database automatically.
    This class pulls city data from an API and adds it to the
    database using the City Model.

    This is a run-and-done file, as you will only need to insert once 
    into the database not everytime the program is run. 
    This is what I did to insert into the database:
        - Open command line and navigate into the directory CityNameDbApp
        - Run the command: php artisan tinker
        - Run the command: use App\Domain\API\Data;
        - Run the command: Data::fetchCities();
    
    Note: 
        - inserting into database is only plausible if the vendor directory
          is set up and all the required libraries are installed.
        - To empty a table in tinker use the command: DB::table('tableName')->truncate();

*/

namespace App\Domain\API;

use App\Models\City;

class Data
{

    static function fetchCities()
    {
        // Reads in data and converts to json
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $res = $client->request('GET', 'https://data.wa.gov/resource/2hia-rqet.json');
        $cityData = json_decode($res->getBody()->getContents(), true);

        // Filter cities and create city array
        foreach ($cityData as $city) {
            if ($city['filter'] == 4) {
                $cityArray[] = array('city' => $city['jurisdiction'], 'state' => 'Washington', 'pop_2000' => $city['pop_2000'], 'pop_2010' => $city['pop_2010'], 'pop_2020' => $city['pop_2020']);
            }
        }

        // Put each city into data base using City Model to create
        foreach ($cityArray as $city) {
            City::create([
                'name' => $city['city'], 'state' => $city['state'], 'population_2000' => $city['pop_2000'],
                'population_2010' => $city['pop_2010'], 'population_2020' => $city['pop_2020']
            ]);
        }
    }
}
