<?php
	//This file checks if the account [corresponding to the email] extsts or not::
	//This file is required in 'forgotUsernamePassword2.php' & 'registrationPage2.php'
	require 'config.php'; //Opening database connection

	//Prevent SQL-Injection type vulnerability::
	$eMail = mysqli_real_escape_string($conn, $eMail);

	//Prepared statement to prevent SQL-Injection::
	$query = "SELECT * FROM registrationTable WHERE eMail = ?"; //Select query to check if the account exists in the database
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $eMail); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$result = $stmt->get_result(); //Get the result
	$result->fetch_all(); //Fetch all the column values of the selected row

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing database connection
?>
