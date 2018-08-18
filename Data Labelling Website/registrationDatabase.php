<?php
	//This file binds the data and inserts into into the database::
	//This file is required in 'registrationPage2.php'
	require 'config.php'; //Opening connection
//--------------------------------------------------------------------------------------------------------------------------------


	//Generating random code for account verification::
	$verLetter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'; //String containing characters to be used to generate the verification code
	$verLength = strlen($verLetter); //Getting the length (i.e. total number of characters) of the string to be used
	$verCode = ''; //Declaring an empty variable to hold the randomly generated characters

	for ($i=0; $i<8 ; $i++) { //Looping 8 times to generate 8 characters long verification code
		$verCode .= $verLetter[rand(0, $verLength-1)]; //Appending every randomly generated character to the variable $verCode
	}

	$verCode_hash = password_hash($verCode, PASSWORD_DEFAULT); //Password hashing
//--------------------------------------------------------------------------------------------------------------------------------


	//Prepared statement:: (prevents sql injection into the database)::
	$stmt = $conn->prepare("INSERT INTO registrationTable (firstName, lastName, eMail, instName, subject, batchNo, stdId, socialMedia, password, gender, activationCode) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?)");

	//Checking for SQL-Injection type vulnerability::(Escaping special characters in a string having special meaning in SQL statement)::
	$fName = mysqli_real_escape_string($conn, $fName);
	$lName = mysqli_real_escape_string($conn, $lName);
	$eMail = mysqli_real_escape_string($conn, $eMail);
	$instName = mysqli_real_escape_string($conn, $instName);
	$subject = mysqli_real_escape_string($conn, $subject);
	$batchNo = mysqli_real_escape_string($conn, $batchNo);
	$stdId = mysqli_real_escape_string($conn, $stdId);
	$socialMedia = mysqli_real_escape_string($conn, $socialMedia);
	$password = mysqli_real_escape_string($conn, $password);
	$gender = mysqli_real_escape_string($conn, $gender);

	$stmt->bind_param("sssssssssss", $fName, $lName, $eMail, $instName, $subject, $batchNo, $stdId, $socialMedia, $password, $gender, $verCode_hash); //Binding parameters into prepared statement
	$stmt->execute(); //Execute query

	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing connection
//--------------------------------------------------------------------------------------------------------------------------------

	
	$subject = 'Activate your account'; //Subject of the email
	$message = 'Your account activation code is: '.$verCode; //Message including the account activation code
	require 'sendEmail.php'; //This file mails the account activation code to the user

	//header('Location: verificationPage.php'); //Take the user to the account verification page
	$redirect = '<script>';
	$redirect .= 'window.location.href = "verificationPage.php";';
	$redirect .= '</script>';
	echo $redirect;
	//Note: The 'header()' function will function properly if this file is required at the first/top of the corresponding HTML file (registrationPage.php).
?>
