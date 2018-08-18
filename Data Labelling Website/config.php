<?php
	//This file connects to the database engine and creates database and/or table if they does not exist::
	//Give the information below according to your database server::
	//Note: In this file the database is created with query syntax. But when uploading at the hosting sites, the database might be needed to be created with the GUI interface. In that case, the part of this file deaing with creating database is not needed!

	$serverName = "localhost"; //Your database server name
	$username = "id2253717_sentimentdbuser"; //Your database password
	$pass = "11111"; //Your database password
	//$username = "root";
	//$pass = "";

	/*//Create connection:
	$conn = new mysqli($serverName, $username, $pass) ;
	if($conn->connect_error) //Check if there is any error connecting to the database server
	{
		die("Connection failed: " . $conn->connect_error); //Show error message for connetion error
	}

	//Create database::
	$createDB = "CREATE DATABASE IF NOT EXISTS id2253717_myregistrationdb"; //Query to create the database if it does not exists
	if ($conn->query($createDB) == FALSE) { //Execute the query and check if there is any error in creating the database
		die("Unable to create database: " . $conn->error); //Show error message for error
	}
	$conn->close(); //Closing connection
	//After creating database, the connection has to be closed and re-opened to refresh the database.
	*/

	//Selecting database::
	$dbName = "id2253717_sentimentdb"; //Your database name
	//$dbName = "sentimentdb";
	$conn = new mysqli($serverName, $username, $pass, $dbName) ; //Reconnecting to the database server
	if($conn->connect_error) //Check for any connection error to the database
	{
		die("Connection failed: " . $conn->connect_error); ////Show error message for connetion error
	}

	//Create table::
	$createTable = "CREATE TABLE IF NOT EXISTS registrationTable (
	id INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(50) NOT NULL,
	lastName VARCHAR(50) NOT NULL,
	eMail VARCHAR(150) UNIQUE KEY NOT NULL,
	instName VARCHAR(150),
	subject VARCHAR(50),
	batchNo VARCHAR(50),
	stdId VARCHAR(50),
	socialMedia VARCHAR(10),
	password VARCHAR(255) NOT NULL,
	gender VARCHAR(10),
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	status INT DEFAULT 0,
	admin INT DEFAULT 0,
	activationCode VARCHAR(255)
	)";
	
	if ($conn->query($createTable) === FALSE) { //Execute the query and check if there is any error in creating the table
		echo "Error creating Registration table: " . $conn->error; //Show error message for error
	}

	$createTable = "CREATE TABLE IF NOT EXISTS tweets (
    tweet_id INT AUTO_INCREMENT PRIMARY KEY,
    label_1 VARCHAR(100),
    label_2 VARCHAR(100),
    tweet TEXT NOT NULL,
    tweet_date VARCHAR(20) NOT NULL,
    labeller_1 INT,
    labeller_2 INT,
    labeling_date_1 TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    labeling_date_2 TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )CHARACTER SET utf8 COLLATE utf8_general_ci";
	
	if ($conn->query($createTable) === FALSE) { //Execute the query and check if there is any error in creating the table
		echo "Error creating Tweets table: " . $conn->error; //Show error message for error
	}
?>
