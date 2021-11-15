Note: This program requires PHP and Composer to run.
I use Composer version 2.1.9 and PHP 8.0.11

Step 1: Open Command Prompt in the current folder
	Windows:
	   Open the folder CityNameDbApp.
	   Hold shift and right click. (Be careful to not click on other files)
	   Select "Open PowerShell window here".
	Mac: 
	   In the parent directory of the folder CityNameDbApp,
 	   single-click on the unzipped folder and click on "Finder"
	   followed by "Services" and then select "New Terminal at Folder".

Step 2: Install required libraries
	In the terminal type in the following command and hit enter:
	   composer install

	Notes: this step may take a while

Step 3: Start the server
	In the terminal type in the following command and hit enter:
	   php artisan serve

Step 4: Run the program
	Open your favorite web browser (Google Chrome, Firefox, Safari, Microsoft Edge, etc.).
	Into the search bar enter the following and hit enter:
	    http://127.0.0.1:8000/cities

Notes: Pages of interest where my work is located: 
	CityNameDbApp\routes\web.php
	CityNameDbApp\app\Domain\API\Data.php
	CityNameDbApp\app\Models\City.php
	CityNameDbApp\resources\views\cities\index.blade.php
	CityNameDbApp\database\migrations\2021_11_08_233225_create_cities_table.php