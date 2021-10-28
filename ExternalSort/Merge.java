
/*
 * Author: Vera Korchemnaya
 * Email: vkorchemnaya@eagles.ewu.edu
 * 
 */

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class Merge {

public static void main(String[] args) {
		
		int fileNumber = args.length; // Number of files the user wants to merge

		try {
			Scanner[] scannerArray = new Scanner[fileNumber]; // Array of scanner objects
			ArrayQueue[] arrayOfQueues = new ArrayQueue[fileNumber]; // Array of array queues

			for (int j = 0; j < fileNumber; j++) {
				File myfile = new File(args[j]);
				scannerArray[j] = new Scanner(myfile); // Make a new scanner for every file
				arrayOfQueues[j] = new ArrayQueue(); // Load the files into the array of array queues

				for (int i = 0; i < 10; i++) {
					// Load 10 elements into the array queues
					arrayOfQueues[j].enqueue(scannerArray[j].nextInt());

					if (!scannerArray[j].hasNext()) { // If the file contains less than 10 elements then exit the loop
						break;
					}
				}
			}

			// Linked list queue to hold the large sorted data set
			ListQueue ListQ = new ListQueue();
			
			// While loop picks smallest number from the array queues and puts them into the linked list
			while (arrayIsNotEmpty(arrayOfQueues, fileNumber)) {
				
				// initialize the variables first
				ArrayQueue smallest = arrayOfQueues[0];
				Scanner smallestScan = scannerArray[0];
				
				// make sure the above variables don't point to null values
				for(int i = 0; i < fileNumber; i++) {
					if(arrayOfQueues[i].front() != null) {
						smallest = arrayOfQueues[i];
						smallestScan = scannerArray[i];
					}
				}
	
				// find the smallest value among all the array queue heads
				for (int i = 0; i < fileNumber; i++) {
					if(arrayOfQueues[i].front() == null) {
						continue;
					}
					if (arrayOfQueues[i].front() < smallest.front()) {
						smallest = arrayOfQueues[i];
						smallestScan = scannerArray[i];
					}
				}
				
				// enqueue the smallest value into the linked list
				ListQ.enqueue(smallest.dequeue());
				
				// enqueue a new element into the slot freed up by the dequeue
				if(smallestScan.hasNext()) {					
					smallest.enqueue(smallestScan.nextInt());
				}
			}

			// Print the linked list containing the large merged data set
			while (ListQ.size() != 0) {
				System.out.println(ListQ.dequeue());
			}

		} catch (FileNotFoundException e) {
			// catch file not found exceptions
			System.out.println("File not found");
		}

	}
	
	// This method is specifically for the while loop 
	// This method checks
	public static boolean arrayIsNotEmpty(ArrayQueue[] array, int fileNumber) {
		for(int i = 0; i < fileNumber; i ++) {
			if (array[i].size() > 0) {
				return true;
			}
		}
		return false;
	}

}

// This interface is used for both array based and linked list based queues
interface Queue {
	public Integer size();

	public Integer front();

	public void enqueue(Integer item);

	public Integer dequeue();
}

// Array based queue used to hold the file values
// Logically view as a ring*
class ArrayQueue implements Queue {
	public static final int CAPACITY = 10;

	protected Integer[] ArrayQ;
	protected int head;
	protected int tail;

	protected int size;

	public ArrayQueue() {
		ArrayQ = new Integer[CAPACITY];
		head = -1;
		tail = -1;
		size = 0;
	}

	public Integer size() {
		return size;
	}

	// Return item at the head of the array
	public Integer front() {
		if (size == 0)
			return null;
		return ArrayQ[head];
	}

	// Add item to the tail of the array
	public void enqueue(Integer item) {
		if (size == CAPACITY)
			return;
		if (size == 0) {
			ArrayQ[0] = item;
			head = 0;
			tail = 0;
		} else {
			tail = (tail + 1) % CAPACITY;
			ArrayQ[tail] = item;
		}
		size++;
	}

	// Remove item from the head of the array
	public Integer dequeue() {
		if (size == 0) {
			return null;
		}
		Integer ret = ArrayQ[head];
		ArrayQ[head] = null;

		if (size == 1) {
			head = -1;
			tail = -1;
		} else {
			head = (head + 1) % CAPACITY;
		}
		size--;
		return ret;
	}
}

// Basic node class used for linked list based queue
class Node {
	private int element;
	private Node next;

	Node(int element, Node next) {
		this.element = element;
		this.next = next;
	}

	// Getter methods
	public int getElement() {
		return this.element;
	}
	public Node getNext() {
		return this.next;
	}

	// Setter methods
	public void setElement(int element) {
		this.element = element;
	}
	public void setNext(Node next) {
		this.next = next;
	}
}

// Linked list based queue used to hold final, sorted, large, data set
class ListQueue implements Queue {
	protected Node head;
	protected Node tail;
	protected int size;

	public ListQueue() {
		head = null;
		tail = null;
		size = 0;
	}

	public Integer size() {
		return size;
	}

	// returns the element at the head of the linked list
	public Integer front() {
		if (size == 0)
			return null;
		return head.getElement();
	}

	// Add item to the tail end of the linked list
	public void enqueue(Integer item) {
		if (item == null)
			return;
		Node new_node = new Node(item, null);
		if (size == 0) {
			head = new_node;
			tail = new_node;
		} else {
			tail.setNext(new_node);
			tail = new_node;
		}
		size++;
	}

	// Remove item from the head end of the linked list
	public Integer dequeue() {
		if (size == 0)
			return null;

		Integer ret = head.getElement();

		if (size == 1) {
			head = null;
			tail = null;
		} else {
			Node old_head = head;
			head = head.getNext();
			old_head.setNext(null);
		}
		size--;
		return ret;
	}
}
