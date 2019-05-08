CREATE TABLE IF NOT EXISTS %dbprefix%data (ck_data_id int(11) NOT NULL AUTO_INCREMENT,ck_key varchar(50) NOT NULL DEFAULT '',ck_value varchar(100) NOT NULL DEFAULT '',PRIMARY KEY (ck_data_id));
INSERT INTO %dbprefix%data (ck_key, ck_value) VALUES ('default_language', 'english');
INSERT INTO %dbprefix%data (ck_key, ck_value) VALUES ('default_timezone', 'UTC');
INSERT INTO %dbprefix%data (ck_key, ck_value) VALUES ('default_timeformate', 'h:i A');
INSERT INTO %dbprefix%data (ck_key, ck_value) VALUES ('default_dateformate', 'd-m-Y');
ALTER TABLE %dbprefix%appointments ADD end_date date  NULL DEFAULT NULL;
ALTER TABLE %dbprefix%appointments ADD visit_id INT(11) NOT NULL DEFAULT '0';
UPDATE %dbprefix%version SET current_version='0.0.9';