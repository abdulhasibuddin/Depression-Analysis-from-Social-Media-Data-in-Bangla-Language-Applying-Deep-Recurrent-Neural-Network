<?php
	//This file destorys any existing session related to the current user::
	session_start(); //Start session
	session_destroy(); //Destroy session
	//header("location: loginPage.php"); //Take the user to the login page
	$redirect = '<script>';
	$redirect .= 'window.location.href = "loginPage.php";';
	$redirect .= '</script>';
	echo $redirect;
?>
