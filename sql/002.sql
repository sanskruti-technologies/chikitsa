RENAME TABLE %dbprefix%settings TO %dbprefix%clinic;
ALTER TABLE %dbprefix%clinic ADD clinic_name VARCHAR(50);
ALTER TABLE %dbprefix%clinic ADD tag_line VARCHAR(100);
ALTER TABLE %dbprefix%clinic ADD clinic_address VARCHAR(500);
ALTER TABLE %dbprefix%clinic ADD landline VARCHAR(50);
ALTER TABLE %dbprefix%clinic ADD mobile VARCHAR(50);
ALTER TABLE %dbprefix%clinic ADD email VARCHAR(50);
ALTER TABLE %dbprefix%clinic CHANGE  settings_id  clinic_id INT( 11 ) NOT NULL
ALTER TABLE %dbprefix%visit ADD visit_time VARCHAR(50);
CREATE TABLE IF NOT EXISTS %dbprefix%bill (bill_id int(11) NOT NULL AUTO_INCREMENT, bill_date date NOT NULL,patient_id int(11) NOT NULL,visit_id int(11) NOT NULL,total_amount decimal(10,0) NOT NULL,due_amount decimal(11,2) NOT NULL,PRIMARY KEY (bill_id));
CREATE TABLE IF NOT EXISTS %dbprefix%bill_detail (bill_detail_id int(11) NOT NULL AUTO_INCREMENT,bill_id int(11) NOT NULL,particular varchar(50) NOT NULL, amount decimal(10,2) NOT NULL, quantity int(11) NOT NULL, mrp decimal(10,2) NOT NULL, type varchar(25) NOT NULL, purchase_id int(11), PRIMARY KEY (bill_detail_id));
CREATE TABLE IF NOT EXISTS %dbprefix%payment ( payment_id int(11) NOT NULL AUTO_INCREMENT, bill_id int(11) NOT NULL, pay_date date NOT NULL, pay_mode varchar(50) NOT NULL, amount decimal(10,0) NOT NULL, cheque_no varchar(50) NOT NULL, PRIMARY KEY (payment_id) );
CREATE TABLE IF NOT EXISTS %dbprefix%invoice ( invoice_id INT(11) NOT NULL AUTO_INCREMENT , static_prefix VARCHAR( 10 ) NOT NULL , left_pad INT(11) NOT NULL , next_id INT(11) NOT NULL , currency_symbol VARCHAR(10) NOT NULL, currency_postfix char(10) NOT NULL DEFAULT '/-', PRIMARY KEY ( invoice_id ) );
UPDATE %dbprefix%version SET current_version='0.0.2';