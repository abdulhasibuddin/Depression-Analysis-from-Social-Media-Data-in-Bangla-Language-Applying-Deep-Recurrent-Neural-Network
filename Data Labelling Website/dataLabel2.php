<?php
	session_start();

	$user = $tweet = $string = "";

	$rowcount = $tweet_no = $user_id = 0;


	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		echo "<div style='float: left; color: indigo;'>" . $user . "</div><br>";
	}
	else{
		//header("location: loginPage.php");
		$redirect = '<script>';
		$redirect .= 'window.location.href = "loginPage.php";';
		$redirect .= '</script>';
		echo $redirect;
	}

	require 'config.php';

	$sql = "SELECT registrationtable.id 
				FROM registrationtable 
				WHERE registrationtable.eMail='$user';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$user_id = $row['id'];
		}
	}
	//echo "<br>user id = ".$user_id;

	if (isset($_POST['labels_submit'])) {
		$sql = "";
		//echo "<br>sql1=".$sql.'<br>';
		$rowcount = $_SESSION['rowcount'];
		$tweet_no = $_SESSION['tweet_no'];
		//echo "rowcount=".$rowcount."<br>tweet_no=".$tweet_no."<br>";
		for ($i=$rowcount; $i >= 1; $i--) {
			$option_no = "label".$tweet_no;
			$label = $_POST[$option_no];
			$sql = "UPDATE registrationTable, tweets 
					SET tweets.label_1='$label', 
						tweets.labeller_1=registrationTable.id 
					WHERE tweets.tweet_id='$tweet_no' 
					AND registrationTable.eMail='$user'
					;";
			$tweet_no--;

			if ($conn->query($sql) === FALSE) {
				echo "Error updating record: " . $conn->error;
			}
		}
		//echo "<br>sql=".$sql.'<br>';
		//$conn->multi_query($sql);
		/*if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}*/
	}

	$sql = "SELECT * FROM tweets 
			WHERE label_1 IS NULL 
			AND labeller_1 IS NULL 
			LIMIT 10";

	mysqli_set_charset($conn, 'utf8');
	$result = $conn->query($sql);
?>