/*
The expense_types and gain_types tables are reference tables that indicate the types of expenses and gains that a user can choose from for their personal finances.
The application would also have a page to provide information about these types, as provided through the descriptions.
Additionally, the expenses would provide images as fun icons to mark the type of expense, while the gains would provide links to sites that act as examples.
*/

-- Create a table for the types of expenses as well as a brief description and an accompanying image.
CREATE TABLE expense_types (
	 expense_type VARCHAR(60) NOT NULL,
	 expense_desc VARCHAR(200) NOT NULL,
	 expense_img_path VARCHAR(200) NOT NULL,
	 PRIMARY KEY (expense_type)
);

-- insert reference data into the expenses table

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Activities','Expenses for activities such as entertainment, school, or gym membership.','images/Activities.png');

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Food','Expenses for foodstuff such as groceries or restaurant orders.','images/Food.png');

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Home','Expenses for the home such as rent, utilities, insurance, or property taxes.','images/Home.png');

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Personal','Expenses for personal needs such as life insurance, clothing, or medical expenses.','images/Personal.png');

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Transportation','Expenses for transportation such as gasoline, bus fare, or car insurance.','images/Transportation.png');

INSERT INTO expense_types (expense_type,expense_desc,expense_img_path)
VALUES ('Other','Expenses for other items such as gifts or projects.','images/Other.png');

-- Create a table for the types of income or capital gains as well as a brief description and a link to a site that could offer an example of that gain.
CREATE TABLE gain_types (
	 gain_type VARCHAR(60) NOT NULL,
	 gain_desc VARCHAR(200) NOT NULL,
	 gain_info_link VARCHAR(200) NOT NULL,
	 PRIMARY KEY (gain_type)
);

-- insert reference data into the gains table

INSERT INTO gain_types (gain_type,gain_desc,gain_info_link)
VALUES ('Work','Source of income such as from being paid wages or working for commissions.','http://www1.nyc.gov/jobs');

INSERT INTO gain_types (gain_type,gain_desc,gain_info_link)
VALUES ('Ownership Investment','Source of income derived from ownership such as through dividends, rent, interest, or capital gains.','https://www.nyse.com/index');

INSERT INTO gain_types (gain_type,gain_desc,gain_info_link)
VALUES ('Lending Investment','Source of income that arises from lending by buying bonds or depositing in a savings account.','https://www.chase.com/');

INSERT INTO gain_types (gain_type,gain_desc,gain_info_link)
VALUES ('Other',"Gains resulting from rebates, inheritance, worker's compensation, etc.",'https://labor.ny.gov/workerprotection/laborstandards/workprot/workcomp.shtm');

/*
-- There was originally an idea to include investments, although this could make things more complex.
-- This could be included in the finished application depending on how things go.
CREATE TABLE investments (
	investment_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	item VARCHAR(255) NOT NULL,
	amount FLOAT(13,2) NOT NULL,
	interest FLOAT(3,2) NULL,
	acquired DATE NULL,
	mature_date DATE NULL,
	matured TINYINT,
	memo VARCHAR(255) NULL,
	userid VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);
*/