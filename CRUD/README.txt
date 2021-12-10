Note: This program requires PHP and Composer to run.
I use Composer version 2.1.9 and PHP 8.0.11

To run the application:

Step 1:
	Open a command prompt and navigate to the directory of the 
	application (the directory containing this README.txt).

Step 2: 
	Restore the application's vendor directory
    	In the terminal run the command 'composer install'

	Note: This step may take a while
    
Step 3: 
	Start the Laravel Server
    	In the terminal run the command 'php artisan serve'

Step 4: 
	Open a browser and go to the URL 'http://127.0.0.1:8000/issues'

Option to reseed the database:
	In the terminal run the command 'php artisan db:seed'


Routes that may be of interest: 

routes\web.php (Start off page ***)
app\Http\Controllers\IssueController.php (Resourceful controller)
app\Models\Issue.php (Eloquent Model)
app\Providers\AppServiceProvider.php  (For Pagination)
database\migrations\2021_11_23_122848_create_issues_table.php (Migration)
database\seeders\DatabaseSeeder.php (Just calls IssueSeeder)
database\seeders\IssueSeeder.php (Seed the database)
resources\views\issues\create.blade.php (Create a record)
resources\views\issues\edit.blade.php (Edit a record)
resources\views\issues\form.blade.php (Form for creating and editing)
resources\views\issues\index.blade.php (List all records)
resources\views\issues\layout.blade.php (Layout for all pages)
resources\views\issues\show.blade.php (Display details of single record)
