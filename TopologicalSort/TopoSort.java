/*
 * Author: Vera Korchemnaya
 * Email: vkorchemnaya@ewu.edu
 */

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class TopoSort {

	public static void main(String[] args) {
		File myFile = new File(args[0]);
		Scanner scan = null;
		int lineNumber = lineCounter(myFile); // Count # of lines
		Graph G = new Graph(lineNumber); // Create new graph

		// Try to open file
		try {
			scan = new Scanner(myFile);
		} catch (FileNotFoundException e) {
			System.out.println("File not found.");
		}

		// Insert all the nodes into the Graph
		for (int i = 0; i < lineNumber; i++) {
			String nextLine = scan.nextLine();
			String[] splitting = nextLine.split(":");

			if (splitting.length == 2) {
				String[] furtherSplit = splitting[1].split(",");
				for (int j = 0; j < furtherSplit.length; j++) {
					// insert into the LinkedList that corresponds to the first element in the file line
					G.adjacencyList[Integer.parseInt(splitting[0])].add(new Node(Integer.parseInt(furtherSplit[j])));
				}
			}
		}

		// System.out.println(G.toString()); // To see the structure.
		// Format: vertex ---> connected node

		// Main function call ****
		DFS(G);
		System.out.println(G.results.toString());
	}

	// Count the number of lines in the file
	public static int lineCounter(File filename) {
		int counter = 0;
		try {
			Scanner scan = new Scanner(filename);
			while (scan.hasNext()) {
				scan.next();
				counter++;
			}
			scan.close();
		} catch (FileNotFoundException e) {
			System.out.println("File not found.");
		}
		return counter;
	}

	// Depth-first search function
	public static void DFS(Graph G) {
		for (int i = 0; i < G.numberOfVertices; i++) { // Already done in my constructor but doing it again
			G.adjacencyList[i].setColor("WHITE");
			G.adjacencyList[i].setP(null);
		}

		G.setTime(0);

		for (int i = 0; i < G.numberOfVertices; i++) { // check each vertex in G until all vertices are visited
			if (G.adjacencyList[i].getColor().equals("WHITE"))
				graph_DFS(G, G.adjacencyList[i]);
		}
	}

	// Helper function to check every vertex in G
	public static void graph_DFS(Graph G, LinkedList u) { // for every vertex in G
		G.setTime(G.getTime() + 1);
		u.setD(G.getTime()); // time that u was first visited
		u.setColor("GRAY");

		// Check all the nodes attached to the vertex
		for (Node v = u.head; v != null; v = v.getNext()) {
			if (G.adjacencyList[v.getValue()].getColor().equals("WHITE")) {
				G.adjacencyList[v.getValue()].setP(u);
				graph_DFS(G, G.adjacencyList[v.getValue()]); // recursive call
			}
		}
		
		G.setTime(G.getTime() + 1);
		u.setF(G.getTime()); // set finishing time when all recursive calls return
		u.setColor("BLACK"); // turn on the visited flag
		G.results.add(new Node(u.parentValue)); // add finished node to a linked list
	}

}

// Graph class for topological search
class Graph {
	protected int numberOfVertices; 
	private int time; // global time
	public LinkedList[] adjacencyList; 
	public LinkedList results; // List for topological sort

	public Graph(int vertices) {
		this.numberOfVertices = vertices;
		this.adjacencyList = new LinkedList[vertices];
		time = 0;

		// create a linked list for every element in the array
		for (int i = 0; i < vertices; i++) {
			adjacencyList[i] = new LinkedList(i);
		}
		results = new LinkedList(0); // create list for sort
	}

	// Getters and setters
	public int getVertices() {
		return numberOfVertices;
	}
	public int getTime() {
		return time;
	}
	public void setTime(int time) {
		this.time = time;
	}

	// ToString method
	@Override
	public String toString() {
		String result = "";
		for (int i = 0; i < numberOfVertices; i++)
			result += i + " ---> " + adjacencyList[i].toString() + "\n";
		return result;
	}

}

// Special LinkedList class for adjacency 
class LinkedList {

	protected Node head; // To keep track of the begging of the LinkedList
	protected int parentValue; // Vertex value
	private String color; // Vertex flag
	protected LinkedList p; // The LinkedList that points to this LinkedList
	protected int d; // the time stamp when u is visited
	protected int f; // the time stamp when the search of u’s all next-hops is done + 1
	protected int size;

	// in constructor we set color to white and p to null
	public LinkedList(int parentValue) {
		this.parentValue = parentValue;
		this.head = null;
		this.color = "WHITE";
		this.p = null;
	}

	// add first method
	public void add(Node x) {
		if (x == null)
			return;
		x.setNext(head);
		head = x;
		size++;
	}

	// Getters and setters 
	public int getParentValue() {
		return parentValue;
	}
	public String getColor() {
		return color;
	}
	public LinkedList getP() {
		return p;
	}
	public int getD() {
		return d;
	}
	public int getF() {
		return f;
	}
	public void setColor(String color) {
		this.color = color;
	}
	public void setP(LinkedList p) {
		this.p = p;
	}
	public void setD(int d) {
		this.d = d;
	}
	public void setF(int f) {
		this.f = f;
	}

	// ToString method
	@Override
	public String toString() {
		String result = "";
		for (Node cur = head; cur != null; cur = cur.getNext())
			result += cur.toString();
		return result;
	}
}

// Node class made for LinkedList
class Node {
	private int value;
	private Node next;

	public Node(int value) {
		this.value = value;
		this.next = null;
	}

	// Getters and setters
	public int getValue() {
		return value;
	}
	public Node getNext() {
		return next;
	}
	public void setNext(Node x) {
		this.next = x;
	}
	
	// ToString method
	@Override
	public String toString() {
		return String.valueOf(value) + " ";
	}

}