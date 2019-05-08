ALTER TABLE %dbprefix%users ADD is_active INT(1) NOT NULL DEFAULT '1' ;
ALTER TABLE %dbprefix%modules ADD UNIQUE(module_name);
ALTER TABLE %dbprefix%navigation_menu ADD required_module VARCHAR(25) NULL;
UPDATE %dbprefix%version SET current_version='0.1.6';