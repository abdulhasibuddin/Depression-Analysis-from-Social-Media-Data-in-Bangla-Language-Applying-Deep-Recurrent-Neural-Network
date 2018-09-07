<?php require 'adminPanel2.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>
	<form>
		<div style="text-align: center; color: indigo;">
			<?php
				$info = '<table><tr><th>tweet_label</th><th>label_statistics</th></tr>';
				//echo "Total ".$num_labelled_tweets." row(s) are labelled!";
				while($row = $result->fetch_assoc()){
					$info .= "<tr><td>".$row["tweet_label"]."</td><td>".$row["label_statistics"]."</td></tr>";
				}
				$info .= '</table>';
				echo $info;
			?>
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
