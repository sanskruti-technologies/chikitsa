ALTER TABLE %dbprefix%modules ADD required_modules VARCHAR(250) NULL AFTER license_key;
UPDATE %dbprefix%version SET current_version='0.5.2';