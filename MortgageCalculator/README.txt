Note: This program requires that you start the localhost

Step 1: Open Command Prompt 
	Windows:
	   Option 1: Press Windows and type "Command Prompt". Hit enter when the Command Prompt application shows up.
	   Option 2: Press Windows+R to open a "Run" box. Type "cmd" and click "OK" to open Command Prompt.
	   Option 3: Open Task Manager and click on File from the menu in the top left corner. Then click on "Run new task". 
		     Type in "cmd" and click "OK".
	Mac:
	   Option 1: Open your Applications folder, then open Utilities and double-click on Terminal.
	   Option 2: Press Command-space to launch Spotlight and type "Terminal," then double-click the search result. 

Step 2: Navigate into the folder that contains the sources files
	Right click on "index.html" in the folder that contains this README.txt document.
	Click on "Properties" and copy the location address.
	In the command prompt type the command "cd", add a space, and then paste the copied address.
	Hit enter. 

	Tips
	- You will need to use the "cd" command to change the directory.
	- Windows users will need to use back slahes to navigate to the correct path. 
	- Mac users will use use forward slashes to navigate to the correct path.
	Ex: 
	    My files are in a folder called Assignment4 that is located on my desktop.
	    I type in the following command to change into that directory:
	    cd C:\Users\Vera\Desktop\Assignment4

Step 3: Start the Server
	Now that we are in the correct directory we will run the following command:
	php -S localhost:8000
	This will start the localhost server.

Step 4: Run the application
	Now open your favorite web browser (Google Chrome, Firefox, Safari, Microsoft Edge, Opera, Internet Explorer, etc.).
	Into the search bar enter the following: 
	http://localhost:8000/index.html
	Hit enter and enjoy the application.
	
	