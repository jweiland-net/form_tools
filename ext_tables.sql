#
# Table structure for table 'tx_formtools_requests'
#
CREATE TABLE tx_formtools_requests (
	email varchar(255) DEFAULT '' NOT NULL,
	subject varchar(255) DEFAULT '' NOT NULL,
	content text,
	xml text
);
