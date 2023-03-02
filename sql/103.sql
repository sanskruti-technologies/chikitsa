
ALTER TABLE %dbprefix%language_master ADD is_loaded INT(1) NULL AFTER is_default; 
ALTER TABLE %dbprefix%language_data ADD file_name VARCHAR(200) NULL AFTER l_value; 
UPDATE %dbprefix%language_master SET is_loaded = '1' WHERE 1 ;
UPDATE  %dbprefix%version SET current_version='1.0.3';
