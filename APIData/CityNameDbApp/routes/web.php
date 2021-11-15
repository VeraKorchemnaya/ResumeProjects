<?php
/*  
Name: Vera Korchemnaya
Description: Database Setup
    This project taught me how to set up a database correctly,
    how to insert into a database, and how to use the Eloquent Model.
    These are some of the tasks:
    - create a migration called cities and add properties to it
    - create a City model
    - create a stand alone php file that brings in data from an API
    - insert the API data into the database using the City model and tinker
    - create a view to see all the cities in our database
    We worked with City data including city name, state, popluation in 2000,
    population in 2010, and population in 2020.

*/

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cities', function () {
    // Gets all the cities from the table 'cities' using the Model City
    $cities = \App\Models\City::all();
    // Sends the cities to view in an associative array
    return view('cities/index', ['city' => $cities]);
});
