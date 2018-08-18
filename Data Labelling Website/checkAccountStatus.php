<?php
	//This file checks if an existing account is active or not::
	//This file is required in 'loginPage2.php'

	require 'config.php'; //Creating database connection
	$status = 0; //Declaring an int type variable '$status' with default value 0
	$eMail = mysqli_real_escape_string($conn, $eMail); //Checking if the input text from the username field contains any SQL-injection type vulnerability

	//Prepared statement to prevent SQL-Injection::
	$query = "SELECT * FROM registrationTable WHERE eMail = ?"; //Select query to check if the usename exists in the database
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $eMail); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$result = $stmt->get_result(); //Get the result
	$result->fetch_all(); //Fetch all the column values of the selected row

	foreach($result as $value){ //Traversing columns of the selected row
		if(count(array_filter($value)) > 0){ //If account exists...
			$status = $value['status']; //assign the status value of that account to '$status' variable
		}
	}

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing database connection
?>
