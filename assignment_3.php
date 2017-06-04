<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
$cxn = new mysqli("warehouse", "cl2871", "f23jb4zx", "cl2871_luo_db_design");

$describeTable = "describe tsla_stock_prices;";
$resultTable = $cxn->query($describeTable);

$query1 = "SELECT COUNT(id) AS num FROM tsla_stock_prices;";
$result1 = $cxn->query($query1);
$query2 = "SELECT YEAR(date) as year, MAX(open) AS max_open, MAX(high) AS max_high, MAX(low) AS max_low, MAX(close) AS max_close, MAX(volume) AS max_vol, MAX(adj_close) AS max_adj_close FROM tsla_stock_prices GROUP BY year;";
$result2 = $cxn->query($query2);
$query3 = "SELECT id, date, open, close FROM tsla_stock_prices ORDER BY date DESC LIMIT 10;";
$result3 = $cxn->query($query3);
$query4 = "SELECT YEAR(date) as year, AVG(volume) AS avg_vol, AVG(open) AS avg_open, AVG(close) AS avg_close FROM tsla_stock_prices GROUP BY year;";
$result4 = $cxn->query($query4);
$query5 = "SELECT * FROM tsla_stock_prices ORDER BY date DESC LIMIT 15;";
$result5 = $cxn->query($query5);
$query6 = "SELECT date, open, high, low, close, volume FROM tsla_stock_prices WHERE volume > 20000000 ORDER BY volume DESC;";
$result6 = $cxn->query($query6);
$query7 = "SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close DESC LIMIT 10;";
$result7 = $cxn->query($query7);
$query8 = "SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close ASC LIMIT 10;";
$result8 = $cxn->query($query8);
$query9 = "SELECT date, open, high, low, close, volume FROM tsla_stock_prices WHERE close > open ORDER BY close-open DESC LIMIT 15;";
$result9 = $cxn->query($query9);
$query10 = "SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close * volume DESC LIMIT 15;";
$result10 = $cxn->query($query10);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Assignment 3</title>
		<link rel="stylesheet" media="only screen and (max-width: 800px)" href="css/mobile.css" />
		<link rel="stylesheet" media="only screen and (min-width: 801px) and (max-width: 1205px)" href="css/tablet.css" />
		<link rel="stylesheet" media="only screen and (min-width: 1206px)" href="css/desktop.css" />
		<meta name="viewport" content="initial-scale=1" />
		<style>
			table.query, table.query th, table.query td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			table.query td {
				text-align: center;
			}
			h4 {
				padding-left: 10px;
			}
			h5{
				padding-left: 75px;
				font-size: 18px;
				font-family: calibri;
			}
			li#TSLA{
				list-style-type: none;
				padding-left: 100px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<section>
				<header>
					<h1 id="chris_heading">Chris Luo's Database Design Assignments</h1>
					<nav id="main">
						<ul>
							<li><a href="index.html">Homepage</a></li>
							<li><a href="about_me_3.html">About Me</a></li>
							<li><a href="glorious_food_3.html">Glorious Food</a></li>
							<div class="clear"></div>
						</ul>
					</nav>
					<div class="clear"></div>
				</header>
			</section>
			<section>
				<h2>Assignment 3: Tesla Historical Stock Price Data</h2>
				<h3>Data Description</h2>
				<p>My dataset includes the historical stock price information for Tesla Motors, Inc as of February 24, 2016. My dataset comes from Yahoo! Finance, and it includes key values such as open, high, low, close, and volume for each trading day. This dataset includes 1424 records, from Tesla's IPO until February 24, 2016.</p>
				<p>I find this dataset rather interesting considering that Tesla is a fairly innovative company headed by Elon Musk, making its valuation rather unique. Additionally, historical stock price analysis can provide a lot of useful information and remarkable insights about both the company and how market participants value it.</p>
				<li id = "TSLA"><a href="http://finance.yahoo.com/q/hp?s=TSLA+Historical+Prices">Link to Yahoo! Finance TSLA Prices</a></li>
			</section>
			<section>
				<h3>Table Structure</h3>
				<table border="1">
					<tr>
						<th width="100">Field</th>
						<th width="100">Type</th>
						<th width="100">Null</th>
						<th width="100">Key</th>
						<th width="200">Default</th>
						<th width="100">Extra</th>
					</tr>
<?php while ($row = $resultTable->fetch_assoc()) : ?>
					<tr>
						<td><?php print $row['Field']; ?></td>
						<td><?php print $row['Type']; ?></td>
						<td><?php print $row['Null']; ?></td>
						<td><?php print $row['Key']; ?></td>
						<td><?php print $row['Default']; ?></td>
						<td><?php print $row['Extra']; ?></td>
					</tr>
<?php endwhile; ?>
				</table>
				<p>The 'id' field keeps the primary key information for each record, so I use a int datatype and auto_increment for each record.</p>
				<p>The 'date' field marks each trading day, so I use the date datatype.</p>
				<p>The 'open' field carries the open price for each record, and the format is 9 digits with 6 after the period so I use a float(9,6) datatype.</p>
				<p>The 'high' field has the same format as the 'open' field.</p>
				<p>The 'low' field has the same format as the 'open' field.</p>
				<p>The 'close' field has the same format as the 'open' field.</p>
				<p>The 'volume' field represents the total shares traded that day, so an int datatype with 10 digits is able to hold those values.</p>
				<p>The 'adj_close' field has the same format as the 'open' field.</p>
				<p>The 'created' field marks the time at which each record was created, and so it has the timestamp datatype and is defaulted to CURRENT_TIMESTAMP to capture the time.</p>
			</section>
			<section>
				<h3>SQL Queries</h3>
				<article>
					<h4>1) Total Records</h4>
					<h5>SELECT COUNT(id) AS num FROM tsla_stock_prices;</h5>
					<p>This query returns the total amount of records within the tsla_stock_prices table.</p>
					<table class="query">
						<tr>
							<th width="100">num</th>
						</tr>
<?php while ($row = $result1->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['num']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>2) Maximum Values</h4>
					<h5>SELECT YEAR(date) as year, MAX(open) AS max_open, MAX(high) AS max_high, MAX(low) AS max_low, MAX(close) AS max_close, MAX(volume) AS max_vol, MAX(adj_close) AS max_adj_close FROM tsla_stock_prices GROUP BY year;</h5>
					<p>This query returns the highest values for each numerical field organized by year (this does not return highest values for the id, date, and created fields).</p>
					<table class="query">
						<tr>
							<th width="100">year</th>
							<th width="125">max_open</th>
							<th width="125">max_high</th>
							<th width="125">max_low</th>
							<th width="125">max_close</th>
							<th width="125">max_vol</th>
							<th width="125">max_adj_close</th>
						</tr>
<?php while ($row = $result2->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['year']; ?></td>
							<td><?php print $row['max_open']; ?></td>
							<td><?php print $row['max_high']; ?></td>
							<td><?php print $row['max_low']; ?></td>
							<td><?php print $row['max_close']; ?></td>
							<td><?php print $row['max_vol']; ?></td>
							<td><?php print $row['max_adj_close']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>3) First 10 Records</h4>
					<h5>SELECT id, date, open, close FROM tsla_stock_prices ORDER BY date DESC LIMIT 10;</h5>
					<p>This query returns the first 10 records in the table, or rather the 10 most recent records. The id field is provided to express this.</p>
					<table class="query">
						<tr>
							<th width="75">id</th>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">close</th>
						</tr>
<?php while ($row = $result3->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['id']; ?></td>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['close']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>4) Averages for Volume, Open, and Close by Year</h4>
					<h5>SELECT YEAR(date) as year, AVG(volume) AS avg_vol, AVG(open) AS avg_open, AVG(close) AS avg_close FROM tsla_stock_prices GROUP BY year;</h5>
					<p>This query returns averages on three numerical fields for the stock data grouped by year.</p>
					<table class="query">
						<tr>
							<th width="100">year</th>
							<th width="125">avg_vol</th>
							<th width="125">avg_open</th>
							<th width="125">avg_close</th>
						</tr>
<?php while ($row = $result4->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['year']; ?></td>
							<td><?php print $row['avg_vol']; ?></td>
							<td><?php print $row['avg_open']; ?></td>
							<td><?php print $row['avg_close']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>5) First 15 Records (by Date)</h4>
					<h5>SELECT * FROM tsla_stock_prices ORDER BY date DESC LIMIT 15;</h5>
					<p>This query returns a user-friendly listing of the first 15 records ordered by date.</p>
					<table class="query">
						<tr>
							<th width="75">id</th>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
							<th width="125">adj_close</th>
							<th width="125">created</th>
						</tr>
<?php while ($row = $result5->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['id']; ?></td>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
							<td><?php print $row['adj_close']; ?></td>
							<td><?php print $row['created']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>6) Trading Volume Greater Than 20,000,000</h4>
					<h5>SELECT date, open, high, low, close, volume FROM tsla_stock_prices WHERE volume > 20000000 ORDER BY volume DESC;</h5>
					<p>This query returns all records/days with trading volume greater than 20,000,000 ordered from highest to lowest.</p>
					<table class="query">
						<tr>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
						</tr>
<?php while ($row = $result6->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>7) Highest Closing Prices</h4>
					<h5>SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close DESC LIMIT 10;</h5>
					<p>This query returns the records/days with the 10 highest closing prices.</p>
					<table class="query">
						<tr>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
						</tr>
<?php while ($row = $result7->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>8) Lowest Closing Prices</h4>
					<h5>SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close ASC LIMIT 10;</h5>
					<p>This query returns the records/days with the 10 lowest closing prices.</p>
					<table class="query">
						<tr>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
						</tr>
<?php while ($row = $result8->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>9) Greatest Intraday Increases</h4>
					<h5>SELECT date, open, high, low, close, volume FROM tsla_stock_prices WHERE close > open ORDER BY close-open DESC LIMIT 15;</h5>
					<p>This query returns the records/days with the 15 greatest increases from opening price to closing price.</p>
					<table class="query">
						<tr>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
						</tr>
<?php while ($row = $result9->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
				<article>
					<h4>10) Greatest Value Traded</h4>
					<h5>SELECT date, open, high, low, close, volume FROM tsla_stock_prices ORDER BY close * volume DESC LIMIT 15;</h5>
					<p>This query returns the records/days with the 15 highest value traded over the day (value traded = price * volume, closing price used in this case).</p>
					<table class="query">
						<tr>
							<th width="100">date</th>
							<th width="125">open</th>
							<th width="125">high</th>
							<th width="125">low</th>
							<th width="125">close</th>
							<th width="125">volume</th>
						</tr>
<?php while ($row = $result10->fetch_assoc()) : ?>
						<tr>
							<td><?php print $row['date']; ?></td>
							<td><?php print $row['open']; ?></td>
							<td><?php print $row['high']; ?></td>
							<td><?php print $row['low']; ?></td>
							<td><?php print $row['close']; ?></td>
							<td><?php print $row['volume']; ?></td>
						</tr>
<?php endwhile; ?>
					</table>
				</article>
			</section>
			<section>
				<h3>Summary of Results</h3>
				<p>Based on the queries on the Tesla stock dataset, it appears that Tesla's stock price has experienced dramatic growth over time, rising from its low IPO pricing to averaging $200 in recent years. In general, Tesla is a very actively traded stock, with its highest daily trading volume in 2013 and 2014 and highest closing prices in 2014 and 2013. Through the data, it appears that Tesla's stock was quite popular between 2013-2015, but it has fallen in price recently.</p>
			</section>
		</div>
	</body>
</html>