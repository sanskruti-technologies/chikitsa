INSERT INTO %dbprefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('all_patients', 'patients', '0', 'patient/index', NULL, 'All Patients', NULL);
INSERT INTO %dbprefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('new_inquiry', 'patients', '200', 'patient/new_inquiry_report', NULL, 'New Inquiries', NULL);
INSERT INTO %dbprefix%menu_access(menu_name,category_name,allow) VALUES ( 'all_patients','Doctor',1);
INSERT INTO %dbprefix%menu_access(menu_name,category_name,allow) VALUES ( 'new_inquiry','Doctor',1);
INSERT INTO %dbprefix%menu_access(menu_name,category_name,allow) VALUES ( 'all_patients','Receptionist',1);
INSERT INTO %dbprefix%menu_access(menu_name,category_name,allow) VALUES ( 'new_inquiry','Receptionist',1);
UPDATE %dbprefix%version SET current_version='0.1.8';