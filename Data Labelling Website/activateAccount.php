<?php
	//This page gets the username and activates the corresponding account::
	//This file is required in 'verificationPage2.php'
	require 'config.php'; //Opening database connection

	/*Setting status to 1 indicates that account is activated.
	 *Once account is activated, set activationCode empty to pervent reusing of the same code by the user.*/
	$status = 1;
	$activationCode = "";

	//Prepared statement to prevent SQL-Injection::
	$query = "UPDATE registrationTable SET status = ?, activationCode = ? WHERE eMail = ?"; //Update query
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("iss", $status, $activationCode, $eMail); //Binding parameters
	$stmt->execute(); //Executing prepared statement

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing the database connection
?>
