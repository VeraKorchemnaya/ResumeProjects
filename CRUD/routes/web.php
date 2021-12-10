<?php
/*
    Name: Vera Korchemnaya
    Description: CRUD Assignment
        In this project I made a comic book collection. The user
        is able to edit, create, list, show and delete comic books. The 
        page is user friendly, providing messages, sorting and much more. 

        I utilized the following:
            - HTTP concepts like POST, GET, PUT, DELETE
            - Resourceful controller and views
                - Views allowed for listing, showing, updating, creation and deletion
                  of comic book issues
            - Eloquent Model
            - Spectre CSS
                - I used the spectre component 'card'
            - Used layouts for overall cohesion and injected forms into create
              and edit views
            - Success and information messages for editing/creating/validating/etc.
            - Form validation in form and in store/update methods
            - Used Faker in a seeder for the database
            - Used pagination for better user expirence
            - Sorted the records in ascending and descending order depending on 
              which column the user clicks
                - Used query string values from the URL
                - Also used Eloquent Model methods like orderBy
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

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

// Resourceful routes controller for comic book database
Route::resource('issues', IssueController::class);
