This progect is run from the Command Prompt 
and requires that a java compiler is installed.

To run this program: 
Step 1: Open Command Prompt 
	Windows:
	   Press Windows and type "Command Prompt". Hit enter when the Command Prompt application shows up.
	Mac:
	   Press Command-space to launch Spotlight and type "Terminal," then double-click the search result. 

Step 2: Navigate into the folder that contains the sources files
	Right click on "TopoSort.java" in the folder that contains this README.txt document.
	Click on "Properties" and copy the location address.
	In the command prompt type the command "cd", add a space, and then paste the copied address.
	Hit enter. 

	Ex: 
	    My files are in a folder called TopologicalSort that is located on my desktop.
	    I type in the following command to change into that directory:
	    cd C:\Users\Vera\Desktop\TopologicalSort

Step 3: Compile the source file
	Once you are in the correct directory we need to compile the source file.
	To do this run the following line in Command Prompt:
		javac TopoSort.java

Step 4: Run the program
	To run the program we need to call java, followed by the class name, followed by the data set to be sorted topologically. 
	To do this run the following line in Command Prompt:
		java TopoSort data1.txt

Step 5: Manipulate the data in the txt files and have fun!
	You can add whatever values you want into the data1.txt, just make sure that it follows the correct format.
