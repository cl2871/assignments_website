/*
Create tables with variable data to store user information.
Personal user information will be stored in the users table and their personal finances will be stored in the other two tables.
Expenses and gains will store information on individual transactions that the user has made.

Note: The sample data within the csv files may not have "correct" information.
In the finished application user_ids will probably be based on session id and TIMESTAMPs should be in chronological order.
*/

-- Create a table to store the id and join date of each user.
CREATE TABLE users (
	user_id VARCHAR(50) NOT NULL,
	joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (user_id)
);

-- Create a table to store the transaction id, transaction name, the type of expense, the amount of the transaction, and the user it is linked to.
-- The incurred field will mark when the transaction is entered into the database, and the paid field will indicate whether the user has marked the transaction paid.
-- The user can include a short memo about the transaction.
CREATE TABLE expenses (
	expense_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	item VARCHAR(60) NOT NULL,
	expense_type VARCHAR(60) NOT NULL,
	amount FLOAT(13,2) NOT NULL,
	incurred TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	paid TINYINT DEFAULT 0,
	memo VARCHAR(120) NULL,
	user_id VARCHAR(50) NOT NULL,
	PRIMARY KEY (expense_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create a table for gains that is fairly similar to the expenses table.
CREATE TABLE gains (
	gain_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	item VARCHAR(60) NOT NULL,
	gain_type VARCHAR(60) NOT NULL,
	amount FLOAT(13,2) NOT NULL,
	acknowledged TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	earned TINYINT DEFAULT 0,
	memo VARCHAR(120) NULL,
	user_id VARCHAR(50) NOT NULL,
	PRIMARY KEY (gain_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);
