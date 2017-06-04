<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

	if ($_GET["action"]=="delete") {
		$query = "DELETE FROM gains WHERE gain_id=". $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	else if ($_GET["action"]=="earned") {
		$query = "UPDATE gains SET earned=1 WHERE gain_id=" . $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	else if ($_GET["action"]=="undo") {
		$query = "UPDATE gains SET earned=0 WHERE gain_id=" . $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	
	if($_POST['item']) {
		$query = "INSERT INTO gains (item, gain_type, amount, memo, user_id) VALUES('". $_POST['item'] ."', '".$_POST['gain_type']."', '".$_POST['amount']."', '".$_POST['memo']."', '" . session_id() . "');";
		$result = $cxn->query($query);	}
	header( 'Location: http://i6.cims.nyu.edu/~cl2871/gains.php' ) ;
?>