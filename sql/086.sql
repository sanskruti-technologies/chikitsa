UPDATE %dbprefix%navigation_menu SET parent_name = 'administration' WHERE menu_name='pending_payments'; 
UPDATE %dbprefix%version SET current_version='0.8.6';