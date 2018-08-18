<?php
	//This file selects the activation code for the corresponding username from database::
	//This file is required in 'verificationPage2.php'
	require 'config.php'; //Opening database connection
	
	//Prevent SQL Injection type vulnerability::
	$eMail = mysqli_real_escape_string($conn, $eMail);
	$activationCode = mysqli_real_escape_string($conn, $activationCode); //'$activationCode' has only been ckecked but not been used

	//Prepared statement to prevent SQL-Injection:: activationCode
	$query = "SELECT * FROM registrationTable WHERE eMail = ?"; //Select query to check if the usename exists in the database
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $eMail); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$chkResult = $stmt->get_result(); //Get the result
	$chkResult->fetch_all(); //Fetch all the column values of the selected row

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Close database connection
?>
