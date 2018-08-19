<?php
	require 'config.php';

	$sql = "SELECT tweets.* 
			FROM tweets 
			WHERE tweets.label_1 IS NOT NULL;
			";
	$result = $conn->query($sql);
	$num_labelled_tweets = $result->num_rows;
?>