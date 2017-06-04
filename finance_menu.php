<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

	$user = "INSERT INTO users (user_id) VALUES ('" . session_id() . "');";
	$update_user = $cxn->query($user);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Finance Menu</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/finance.css" />
		<script type="text/javascript" src="bootstrap/js/jquery-2.1.4.min.js"></script>
    	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<section>
<?php include ("finance_header.php"); ?>
			</section>
			<section>
				<h2>Greetings</h2>
				<p>
					Welcome to the Personal Finance Manager! This web application will serve to aid you in keeping track of your personal finances. On the expenses page, you can add expenses as well as sort your data based on fields or type of expense. On the Income and Gains page, you can add sources of income and gains as well as sort your data based on fields or type of income/gains. This web application is based on the principle of recording expenses and gains when they are recognized rather than when cash actually is exchanged.
				</p>
				<h2>Background and More</h2>
				<p>
					Over the course of this assignment, multiple changes were implemented that were beyond the original plan for this assignment. To learn more about the technical and functional specifications of this project, feel free to check out the assignment before this via this <a href="assignment_5.php">link</a>. Bootstrap was used to allow for javascript capabilities. In terms of style, this web application was left intentionally minimalistic to have a more professional feel to the application. Additionally, certain features, such as a login screen and aggregate functionalities were scrapped due to time constraints and technical issues. Instead, more emphasis was placed on having a smooth interface. This web application supports mobile usage. The user id is based on the session id.
				</p>
			</section>
			<section>
				<article>

				</article>
			</section>
		</div>
	</body>
</html>