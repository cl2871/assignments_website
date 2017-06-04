<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

	if(empty($_GET['sort'])){
		if(empty($_GET['sort_2'])){
			$sortby = "acknowledged";
		}else{
			if($_GET['sort_2']=="Work"){
				$sort_type = "Work";
			}elseif($_GET['sort_2']=="Ownership Investment"){
				$sort_type = "Ownership Investment";
			}elseif($_GET['sort_2']=="Lending Investment"){
				$sort_type = "Lending Investment";
			}elseif($_GET['sort_2']=="Other"){
				$sort_type = "Other";
			}
		}
	}else{
		if($_GET['sort']=="sort_acknowledged"){
			$sortby = "acknowledged";
		}elseif($_GET['sort']=="sort_item"){
			$sortby = "item";
		}elseif($_GET['sort']=="sort_type"){
			$sortby = "gain_type";
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
		$gains = "SELECT * FROM gains WHERE user_id='" . session_id() . "' AND gain_type='" . $sort_type . "';";
	}else {
		$gains = "SELECT * FROM gains WHERE user_id='" . session_id() . "' ORDER BY " . $sortby . " " . $sortdirection .";";
	}

	$result = $cxn->query($gains);

	$gain_types = "SELECT * FROM gain_types;";
	$types_result = $cxn->query($gain_types);
	$types_result2 = $cxn->query($gain_types);

	$expense_type = "SELECT gain_type FROM gain_types;";
	$sort_type_result = $cxn->query($gain_types);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Gains</title>
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
					Hello, on this page you may add income and gains at the bottom. The gains you enter will populate this page based on their entry time. Additionally, you can use the "Sort Gains" drop-down menu to sort your expenses either by field or by gain type. You can mark the gains that you have earned by clicking on a gain's respective "Earned" button, which will draw a line through the gain that you have marked earned. You can delete gains by clicking their respective "Delete" button.
				</p>
			</section>
			<section>
				<form action="gains.php" method="GET">
					<fieldset>
						<legend>Sort Gains</legend>
						<label for="sort">Sort by Field:</label>
						<select name="sort">
							<option value="sort_item">Item</option>
							<option value="sort_type">Type</option>
							<option value="sort_amount">Amount</option>
							<option value="sort_acknowledged">Acknowledged</option>
						</select>
						<select name="sortdir">
							<option value="asc">Ascending</option>
							<option value="desc">Descending</option>
						</select>
						<input type="submit">
					</fieldset>
				</form>
				<form action="gains.php" method="GET">
					<fieldset>
						<label for="sort_2">Select by Gain Type:</label>
						<select name="sort_2">
						<?php while($row4 = $sort_type_result->fetch_assoc()):?>
							<option value="<?php print ($row4['gain_type']);?>"><?php print ($row4['gain_type']);?></option>
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
							<th width="150px">Gain Type </th>
							<th width="150px">Amount </th>
							<th width="300px">Memo </th>
							<th width="150px">Acknowledged </th>
						</tr>
					<?php if(mysqli_num_rows($result)>0): ?>
					<?php while($row = $result->fetch_assoc()): ?>
						<tr>
							<?php if ($row['earned']): ?>
								<td><a href="gains_updater.php?action=undo&id=<?php print($row['gain_id']); ?>">Undo </a></td>
							<?php else: ?>
								<td><a href="gains_updater.php?action=earned&id=<?php print($row['gain_id']); ?>">Earned </a></td>
							<?php endif; ?>

								<td><a href="gains_updater.php?action=delete&id=<?php print($row['gain_id']); ?>">Delete</a></td>
								<td <?php if($row['earned']) {print("class='earned'");} ?>><?php print ($row["item"]);?> </td>
								<td <?php if($row['earned']) {print("class='earned'");} ?>><?php print ($row["gain_type"]);?> </td>
								<td <?php if($row['earned']) {print("class='earned'");} ?>><?php print ($row["amount"]);?> </td>
								<td <?php if($row['earned']) {print("class='earned'");} ?>><?php print ($row["memo"]);?> </td>
								<td <?php if($row['earned']) {print("class='earned'");} ?>><?php print ($row["acknowledged"]);?> </td>
						</tr>
					<?php endwhile; ?>
					<?php else: ?>
						<p><strong>No data to display.</strong></p>
					<?php endif; ?>
				</table>
			</section>
			<section>
				<footer>
					<form action="gains_updater.php" method="POST">
						<fieldset>
							<legend>Add an Income or Gain</legend>
							<article>
								<label for="item">Gain Item:</label>
								<input type="text" name="item">
								<label for="gain_type">Gain Type:</label>
								<select name="gain_type">
									<?php while($row2 = $types_result->fetch_assoc()): ?>
									<option value="<?php print $row2['gain_type']?>"><?php print ($row2['gain_type']); ?></option>
									<?php endwhile; ?>
								</select>
							</article>
							<article>	
								<label for="amount">Gain Amount:</label>
								<input type="text" name="amount">
								<label for="memo">Optional Memo:</label>
								<input type="text" name="memo">
								<input type="submit">
							</article>
						</fieldset>
					</form>

					<table class="table_2">
						<tr>
							<th width="100px">Gain Types</th>
							<th width="500px">Gain Descriptions</th>
							<th width="300px">Example</th>
						</tr>
						<?php while($row3 = $types_result2->fetch_assoc()): ?>
						<tr>
							<td><?php print ($row3['gain_type']); ?></td>
							<td><?php print ($row3['gain_desc']); ?></td>
							<td><a href="<?php print ($row3['gain_info_link']); ?>"><?php print ($row3['gain_info_link']); ?></a></td>
						</tr>
						<?php endwhile; ?>
					</table>
				</footer>
			</section>
		</div>
	</body>
</html>