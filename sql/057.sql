ALTER TABLE %dbprefix%modules ADD license_status VARCHAR(10) NULL AFTER license_key;
UPDATE %dbprefix%modules SET module_display_name = 'Treatment' WHERE module_name = 'treatment';
UPDATE %dbprefix%version SET current_version='0.5.7';