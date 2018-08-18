<?php
	//This file executes if the session 'user' is set i.e. an autheticated user exists::
	//This file is required in 'resetAccount2.php'
	session_start(); //Starting session
	$user = ""; //Username of the current session will be assigned in this variable

	//If session 'user' is set (i.e. an autheticated user exists), print it; else go to the login page::
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user']; //Getting username from the current session
		echo "<div style='float: left; color: indigo;'>" . $user . "</div>"; //print the username on the top-right corner of the page
		//echo "<h1 style='color:green'>Welcome " . $user ."</h1><h2 style='color:green;'>You're now Logged In!</h2>"; //Welcome mssage for the authenticated user
	}
	else{
		//header("location: loginPage.php");
		$redirect = '<script>';
		$redirect .= 'window.location.href = "loginPage.php";';
		$redirect .= '</script>';
		echo $redirect;
	}

	if(isset($_POST['labelData'])){
		//header("Location:dataLabel.php");
		//header("location: dataLabel.php",  true,  301 );  exit;
		$redirect = '<script>';
		$redirect .= 'window.location.href = "dataLabel.php";';
		$redirect .= '</script>';
		echo $redirect;
	}
?>