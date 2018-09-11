<?php
	require 'config.php';

	$sql = "SELECT COALESCE(tweets.label_1, 'Unlabeled') AS tweet_label, 
			COUNT(tweets.tweet_id) AS label_statistics 
			FROM tweets 
			GROUP BY tweets.label_1;
			";
	$result = $conn->query($sql);
	
	$sql = "SELECT registrationTable.eMail AS labeller,
			 COUNT(tweets.tweet_id) AS num_label
             FROM registrationTable, tweets
             WHERE registrationTable.id=tweets.labeller_1
             OR registrationTable.id=tweets.labeller_2
             GROUP BY registrationTable.eMail;
			 ";
	$result2 = $conn->query($sql);

	$sql = "SHOW TABLES;";
	$show_tables = $conn->query($sql);


	//Show query results:
	$query_sql = "";
	$queryResult = "";
	if(isset($_POST['querySubmitBtn']) and isset($_POST['queryText']) and $_POST['queryText']!="")
	{
		$query_sql = $_POST['queryText'];
		$result = $conn->query($query_sql);
		if($result->num_rows>0)
		{
			$th = FALSE;
			while($row = $result->fetch_assoc())
			{
				if($th==FALSE)
				{
					$th = TRUE;
					$queryResult .= "<tr>";
					foreach($row as $key=>$value){
						$queryResult .= "<td><b>".$key."</b></td>";
						continue;
					}
					$queryResult .= "</tr>";
				}
				$queryResult .= "<tr>";
				foreach($row as $key=>$value){
					$queryResult .= "<td>".$value."</td>";
				}
				$queryResult .= "</tr>";
			}
		}
		else{ $queryResult = "0 results!"; }
	}
?>
