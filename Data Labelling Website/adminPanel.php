<?php require 'adminPanel2.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>
	<form method="post" action="">
		<div style="text-align: center; color: indigo;">
			<?php
				
				$total_labeled_tweets = 0;
				$info = '<table><tr><th>tweet_label</th><th>label_statistics</th></tr>';
				while($row = $result->fetch_assoc()){
					$info .= "<tr><td>".$row["tweet_label"]."</td><td>".$row["label_statistics"]."</td></tr>";

					if($row["tweet_label"] != 'Unlabeled'){
						$total_labeled_tweets += $row["label_statistics"];
					}
				}
				$info .= '</table>';
				echo $info;
				echo "<br>Total labeled tweets = ".$total_labeled_tweets;
				
				echo "<br><br><br>";

				$info2 = '<table><tr><th>Labeller</th><th>No. of labelled tweet(s)</th></tr>';
				while($row = $result2->fetch_assoc()){
					$info2 .= "<tr><td>".$row["labeller"]."</td><td>".$row["num_label"]."</td></tr>";
				}
				$info2 .= '</table>';
				echo $info2;

			?>
		</div>
		<br>
		<div>
			<?php
				$db_tables = 'Tables_in_'.$dbName;
				$info = '<table><tr><th>'.$db_tables.':</th></tr>';
				while($row = $show_tables->fetch_assoc()){
					$info .= "<tr><td>".$row[$db_tables]."</td></tr>";
				}
				$info .= '</table>';
				echo $info;
				echo "<br><br><br>";
			?>
		</div>
		<br>
		<div>
			<a href="adminPanel.php"><strong>Refresh</strong></a>
		</div>
		<br>
		<div>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<textarea name="queryText" rows="5" cols="50"><?php echo $query_sql; ?></textarea>
				</tr>
				<tr>
					<td>
						<input type="submit" name="querySubmitBtn" value="Run Query">
					</td>
				</tr>
				<tr>
					<td><b>Result:</b></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="5" cellspacing="2" border="2px;">
							<?php echo $queryResult; ?>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div>
			<a href="authenticatedUser.php"><strong><-Back</strong></a>
		</div>
		<br>
		<footer id="footerId"><a href="logOut.php"><strong>Logout</strong></a></footer> <!--Log-out link-->
	</form>
</body>
</html>
