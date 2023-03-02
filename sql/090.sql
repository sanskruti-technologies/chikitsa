ALTER TABLE %dbprefix%users ADD prefered_language VARCHAR(25) NULL; 
UPDATE %dbprefix%version SET current_version='0.9.0';