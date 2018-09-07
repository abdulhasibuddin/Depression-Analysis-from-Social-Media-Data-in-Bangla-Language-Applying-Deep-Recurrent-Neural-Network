<?php
	require 'config.php';

	$sql = "SELECT COALESCE(tweets.label_1, 'Unlabeled') AS tweet_label, 
			COUNT(tweets.tweet_id) AS label_statistics 
			FROM tweets 
			GROUP BY tweets.label_1;
			";
	$result = $conn->query($sql);
	//$num_labelled_tweets = $result->num_rows;
?>
