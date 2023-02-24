ALTER TABLE %dbprefix%invoice ADD number_of_decimal INT(10) NOT NULL DEFAULT '2'; 
ALTER TABLE %dbprefix%invoice ADD decimal_symbol VARCHAR(12) NOT NULL DEFAULT '.'; 
ALTER TABLE %dbprefix%invoice ADD thousands_separator VARCHAR(12) NULL DEFAULT ','; 
UPDATE %dbprefix%version SET current_version='0.9.2';
