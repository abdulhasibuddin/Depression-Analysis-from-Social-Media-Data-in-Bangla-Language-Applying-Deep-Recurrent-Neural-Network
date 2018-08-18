<?php
	//This file gets the password from the database of the corresponding username::
	//This file is required in 'loginPage2.php'
	require 'config.php'; //Opening database connection
	
	//Prevent SQL Injection type vulnerability::
	$eMail = mysqli_real_escape_string($conn, $eMail);
	//$checkPassword = mysqli_real_escape_string($conn, $checkPassword);

	//Prepared statement to prevent SQL-Injection::
	$query = "SELECT * FROM registrationTable WHERE eMail = ?"; //Select query to select the row corresponding to the password from the database
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $eMail); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$chkResult = $stmt->get_result(); //Get the result
	$chkResult->fetch_all(); //Fetch all the column values of the selected row

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Close database connection
?>
