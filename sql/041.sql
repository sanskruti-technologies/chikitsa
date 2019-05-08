UPDATE %dbprefix%clinic SET max_patient = '1' WHERE clinic_id = 1;
CREATE TABLE IF NOT EXISTS %dbprefix%user_verification ( verification_id int(11) NOT NULL AUTO_INCREMENT, user_email varchar(50) NOT NULL, verification_code int(6) NOT NULL, code_generated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, code_is_verified int(1) DEFAULT NULL,  PRIMARY KEY (verification_id));
ALTER TABLE %dbprefix%modules ADD license_key VARCHAR( 100 ) NULL AFTER module_version;
UPDATE %dbprefix%version SET current_version='0.4.1';