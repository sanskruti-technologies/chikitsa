ALTER TABLE %dbprefix%data CHANGE ck_value ck_value TEXT NOT NULL DEFAULT ''; 
ALTER TABLE %dbprefix%data ADD UNIQUE(ck_key);
ALTER TABLE %dbprefix%modules ADD UNIQUE(module_name);
UPDATE %dbprefix%version SET current_version='0.8.5';