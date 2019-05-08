UPDATE %dbprefix%navigation_menu SET menu_url =  'patient/insert' WHERE  menu_name = 'new_patient';
UPDATE %dbprefix%version SET current_version='0.4.0';