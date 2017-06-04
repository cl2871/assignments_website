<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

	if(empty($_GET['sort'])){
		if(empty($_GET['sort_2'])){
			$sortby = "incurred";
		}else{
			if($_GET['sort_2']=="Activities"){
				$sort_type = "Activities";
			}elseif($_GET['sort_2']=="Food"){
				$sort_type = "Food";
			}elseif($_GET['sort_2']=="Home"){
				$sort_type = "Home";
			}elseif($_GET['sort_2']=="Personal"){
				$sort_type = "Personal";
			}elseif($_GET['sort_2']=="Transportation"){
				$sort_type = "Transportation";
			}elseif($_GET['sort_2']=="Other"){
				$sort_type = "Other";
			}
		}
	}else{
		if($_GET['sort']=="sort_incurred"){
			$sortby = "incurred";
		}elseif($_GET['sort']=="sort_item"){
			$sortby = "item";
		}elseif($_GET['sort']=="sort_type"){
			$sortby = "expense_type";
		}elseif($_GET['sort']=="sort_amount"){
			$sortby = "amount";
		}
	}

	if(empty($_GET['sortdir']) || $_GET['sortdir']=="desc"){
		$sortdirection = "DESC";
	}elseif($_GET['sortdir']=="asc"){
		$sortdirection = "ASC";
	}


	if(empty($_GET['sort']) && !empty($_GET['sort_2'])){
		$expenses = "SELECT * FROM expenses WHERE user_id='" . session_id() . "' AND expense_type='" . $sort_type . "';";
	}else {
		$expenses = "SELECT * FROM expenses WHERE user_id='" . session_id() . "' ORDER BY " . $sortby . " " . $sortdirection .";";
	}

	$result = $cxn->query($expenses);

	$expense_types = "SELECT * FROM expense_types;";
	$types_result = $cxn->query($expense_types);
	$types_result2 = $cxn->query($expense_types);

	$expense_type = "SELECT expense_type FROM expense_types;";
	$sort_type_result = $cxn->query($expense_type);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Expenses</title>
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
				<p>
					Hello! On this page you can add expenses at the bottom. The expenses you enter will populate this page based on their entry time. Additionally, you can use the "Sort Expenses" drop-down menu to sort your expenses either by field or by expense type. You can mark the expenses that you have paid for by clicking on an expense's respective "Paid" button, which will draw a line through the expense that you have marked paid. You can delete expenses by clicking their respective "Delete" button.
				</p>
			</section>
			<section>
				<form action="expenses.php" method="GET">
					<fieldset>
						<legend>Sort Expenses</legend>
						<label for="sort">Sort by Field:</label>
						<select name="sort">
							<option value="sort_item">Item</option>
							<option value="sort_type">Type</option>
							<option value="sort_amount">Amount</option>
							<option value="sort_incurred">Incurred</option>
						</select>
						<select name="sortdir">
							<option value="asc">Ascending</option>
							<option value="desc">Descending</option>
						</select>
						<input type="submit">
					</fieldset>
				</form>
				<form action="expenses.php" method="GET">
					<fieldset>
						<label for="sort_2">Select by Expense Type:</label>
						<select name="sort_2">
						<?php while($row4 = $sort_type_result->fetch_assoc()):?>
							<option value="<?php print ($row4['expense_type']);?>"><?php print ($row4['expense_type']);?></option>
						<?php endwhile; ?>
						</select>
						<input type="submit">
					</fieldset>
				</form>
				<br>	
			</section>
			<section>
				<table>
						<tr>
							<th width="65px">Mark </th>
							<th width="65px">Delete </th>
							<th width="250px">Item </th>
							<th width="150px">Expense Type </th>
							<th width="150px">Amount </th>
							<th width="300px">Memo </th>
							<th width="150px">Incurred </th>
						</tr>
					<?php if(mysqli_num_rows($result)>0): ?>
					<?php while($row = $result->fetch_assoc()): ?>
						<tr>
							<?php if ($row['paid']): ?>
								<td><a href="expenses_updater.php?action=undo&id=<?php print($row['expense_id']); ?>">Undo </a></td>
							<?php else: ?>
								<td><a href="expenses_updater.php?action=paid&id=<?php print($row['expense_id']); ?>">Paid </a></td>
							<?php endif; ?>

								<td><a href="expenses_updater.php?action=delete&id=<?php print($row['expense_id']); ?>">Delete</a></td>
								<td <?php if($row['paid']) {print("class='paid'");} ?>><?php print ($row["item"]);?> </td>
								<td <?php if($row['paid']) {print("class='paid'");} ?>><?php print ($row["expense_type"]);?> </td>
								<td <?php if($row['paid']) {print("class='paid'");} ?>><?php print ($row["amount"]);?> </td>
								<td <?php if($row['paid']) {print("class='paid'");} ?>><?php print ($row["memo"]);?> </td>
								<td <?php if($row['paid']) {print("class='paid'");} ?>><?php print ($row["incurred"]);?> </td>
						</tr>
					<?php endwhile; ?>
					<?php else: ?>
						<p><strong>No data to display.</strong></p>
					<?php endif; ?>
				</table>
			<section>
			</section>
				<footer>
					<form action="expenses_updater.php" method="POST">
						<fieldset>
							<legend>Add an Expense</legend>
							<article>
								<label for="item">Expense Item:</label>
								<input type="text" name="item">
								<label for="expense_type">Expense Type:</label>
								<select name="expense_type">
									<?php while($row2 = $types_result->fetch_assoc()): ?>
									<option value="<?php print $row2['expense_type']?>"><?php print ($row2['expense_type']); ?></option>
									<?php endwhile; ?>
								</select>
							</article>
							<article>	
								<label for="amount">Expense Amount:</label>
								<input type="text" name="amount">
								<label for="memo">Optional Memo:</label>
								<input type="text" name="memo">
								<input type="submit">
							</article>
						</fieldset>
					</form>

					<table class="table_2">
						<tr>
							<th width="100px">Expense Types</th>
							<th width="400px">Expense Descriptions</th>
						</tr>
						<?php while($row3 = $types_result2->fetch_assoc()): ?>
						<tr>
							<td><img src="<?php print ($row3['expense_img_path']); ?>" width="20px"> <?php print ($row3['expense_type']); ?></td>
							<td><?php print ($row3['expense_desc']); ?></td>
						</tr>
						<?php endwhile; ?>
					</table>
				</footer>
			</section>
		</div>
	</body>
</html>