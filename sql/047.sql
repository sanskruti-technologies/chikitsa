ALTER TABLE %dbprefix%modules CHANGE license_key license_key VARCHAR(100) NULL;
UPDATE %dbprefix%version SET current_version='0.4.7';