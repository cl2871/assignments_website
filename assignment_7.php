<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);
$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Database Design Assignment 7</title>
		<link rel="stylesheet" media="only screen and (max-width: 800px)" href="css/mobile.css" />
		<link rel="stylesheet" media="only screen and (min-width: 801px) and (max-width: 1205px)" href="css/tablet.css" />
		<link rel="stylesheet" media="only screen and (min-width: 1206px)" href="css/desktop.css" />
		<meta name="viewport" content="initial-scale=1" />
	</head>
	<body>
		<div class="container">
			<section>
<?php include ("database_header.php"); ?>
			</section>
			<section>
				<h2>Assignment 7: Personal Finance Manager</h2>
				<p>
					qweqweqe
					<a href="finance_menu.php">Press here to go!</a>
				</p>
			</section>
		</div>
	</body>
</html>