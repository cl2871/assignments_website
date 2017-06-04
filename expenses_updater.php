<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

	if ($_GET["action"]=="delete") {
		$query = "DELETE FROM expenses WHERE expense_id=". $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	else if ($_GET["action"]=="paid") {
		$query = "UPDATE expenses SET paid=1 WHERE expense_id=" . $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	else if ($_GET["action"]=="undo") {
		$query = "UPDATE expenses SET paid=0 WHERE expense_id=" . $_GET["id"] . ";";
		$result = $cxn->query($query);
	}
	
	if($_POST['item']) {
		$query = "INSERT INTO expenses (item, expense_type, amount, memo, user_id) VALUES('". $_POST['item'] ."', '".$_POST['expense_type']."', '".$_POST['amount']."', '".$_POST['memo']."', '" . session_id() . "');";
		$result = $cxn->query($query);	}
	header( 'Location: http://i6.cims.nyu.edu/~cl2871/expenses.php' ) ;



/*
	if ($_POST["Username"] && $_POST["Password"]){
		$get_info = "SELECT user_id, password FROM users WHERE user_id='". $_POST["Username"] . "';";
		$row = mysqli_fetch_assoc($get_info);
		if($row["user_id"] == $_POST["Username"] && $row["password"] == $_POST["Password"]){
			header( 'Location: http://i6.cims.nyu.edu/~cl2871/finance_manager/finance_menu' ) ;
		}else{
			$create_account = "INSERT INTO users (user_id, financial_position, secure_position, password) VALUES('". $_POST['Username'] ."', 0, 1,'" . $_POST["Password"] . "');";
			$result = $cxn->query($create_account);

		}
	}else{
		print("Sorry, please check for valid input");
	}
	header( 'Location: http://i6.cims.nyu.edu/~cl2871/assignment_7' ) ;
*/
?>