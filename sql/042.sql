UPDATE %dbprefix%navigation_menu SET menu_url = '#' WHERE menu_name = 'patients';
UPDATE %dbprefix%navigation_menu SET menu_url = 'patient/insert' WHERE menu_name = 'new_patient';
ALTER TABLE %dbprefix%modules ADD username VARCHAR(100) NULL;
UPDATE %dbprefix%version SET current_version='0.4.2';