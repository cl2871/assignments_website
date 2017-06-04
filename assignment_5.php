<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Database Design Assignment 5</title>
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
				<article>
					<h2>
						LAMP App Assignment: Personal Finances Manager
					</h2>
					<h3>
						Functional Specification
					</h3>
					<p>My LAMP application will serve as a site to help people manage their personal finances. This application will allow users to input their expenses and income, helping them to easily recognize and track their behavior. Based on a user's tracking ID assigned by their session, a user will be provided a experience tailored towards their personal finances. Since the web application's main feature is keeping track of expenses and capital gains, the web application will have a page to illustrate the different types of expenses and sources of income there are. This page will provide brief descriptions of the types as well as include pictures or links to aid a user's understanding of those transactions. Additionally, a page will be dedicated to user interactions, which will provide information such as the user's current financial position, highest expenditure, lowest income/capital gain source, etc. This page will portray a snapshot for the user, and will be the user's main page when accessing the application. Moreover, features such as a search bar and aggregate functions can be utilized to help a user perform a meaningful analysis of their transactions. Transactions are tracked by when they are entered into the system, which follows along with the accounting principle of recognizing expenses and gains when they are incurred rather than when they are actually paid or received. The application will track the transactions on two separate pages in reverse chronological order, and users can mark off whether they have paid off an expense or received a payment.</p>
				</article>
				<article>
					<h3>
						Technical Specification
					</h3>
					<p>As a LAMP web application, this personal finances manager will utilize i6 to host the information, MySQL to run queries on the database on the warehouse server, and PHP to address programming needs on the server side and pre-process data. HTML and CSS are used to structure and present the content to a user in an effective and smooth manner. After creating tables in the database that would hold reference and user data, SQL queries will be used in conjunction with PHP code to interact with the user. SELECT queries will post expenses and gains data to the web pages, and programming language such as loops and if statements will help control the information provided to users. GET queries will be useful in marking off transactions, while POST queries will be useful for when users type in transaction details. In addition, UPDATE and INSERT will be used alongside GET and POST to update the database with new information. Aggregate functions such as count, average, etc. will prove useful in helping a user analyze consumption and other behaviors. While the users table currently does not have passwords, user accounts can be made with some tweaking to the underlying SQL code to allow for account management, and PHP can be used for account verification. In general, the web application will be stylistically clean, so the HTML, CSS, and PHP will be used to ensure that the SQL queries put out information in a sensible manner. Web pages will be linked to each other with links in the header, and the header will be in a separate PHP page.</p>
				</article>
			</section>
		</div>
	</body>
</html>