<?php
	//This file checks if the username input by the user already exists or not
	//This file is required in 'registrationPage2.php' & 'resetAccount2.php'
	require 'config.php'; //Opening database connection

	//Prevent SQL Injection type vulnerability::
	$stdId = mysqli_real_escape_string($conn, $stdId);

	//Prepared statement to prevent SQL-Injection::
	$query = "SELECT * FROM registrationTable WHERE stdId = ?"; //Select the row if the username already exists
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $stdId); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$result = $stmt->get_result(); //Get the result
	$result->fetch_all(); //Fetch all the column values of the selected row
	
	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing database connection
?>
