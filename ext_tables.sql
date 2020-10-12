#
# Table structure for table 'tx_formtools_requests'
#
CREATE TABLE tx_formtools_requests (
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(30) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	message text,
	xml text
);
