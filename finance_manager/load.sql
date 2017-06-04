/*
These sql queries help to load the sample data into the user centric tables: users, expenses, and gains.

Note: On i6 my csv files are in my finance_manager folder.
Additionally, the sample data files may not have "correct" information.
*/

LOAD DATA LOCAL INFILE 'finance_manager/user_examples.csv' 
 INTO TABLE users 
 FIELDS TERMINATED BY ',' 
 ENCLOSED BY ''
 LINES TERMINATED BY '\n'
 IGNORE 1 LINES (user_id,joined,financial_position,secure_position,display_name);

LOAD DATA LOCAL INFILE 'finance_manager/expense_examples.csv' 
 INTO TABLE expenses 
 FIELDS TERMINATED BY ',' 
 ENCLOSED BY ''
 LINES TERMINATED BY '\n'
 IGNORE 1 LINES (expense_id,item,expense_type,amount,incurred,paid,memo,user_id);

 LOAD DATA LOCAL INFILE 'finance_manager/gain_examples.csv' 
 INTO TABLE gains 
 FIELDS TERMINATED BY ',' 
 ENCLOSED BY ''
 LINES TERMINATED BY '\n'
 IGNORE 1 LINES (gain_id,item,gain_type,amount,acknowledged,earned,memo,user_id);
 