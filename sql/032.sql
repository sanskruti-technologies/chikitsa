UPDATE %dbprefix%navigation_menu SET menu_order = '200' WHERE menu_name ='patients';
UPDATE %dbprefix%navigation_menu SET menu_order = '100' WHERE menu_name ='appointments';
ALTER TABLE %dbprefix%users ADD contact_id INT( 11 ) NULL;
UPDATE %dbprefix%version SET current_version='0.3.2';