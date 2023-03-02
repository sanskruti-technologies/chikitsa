INSERT INTO %dbprefix%menu_access ( menu_name, category_name, allow) VALUES ('visit_report', 'Doctor', 1), ('visit_report', 'System Administrator', 1), ('visit_report', 'Nurse', 1), ('visit_report', 'Administrator', 1), ('visit_report', 'Receptionist', 1) ;
INSERT INTO %dbprefix%navigation_menu ( menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, is_deleted, sync_status) VALUES ( 'visit_report', 'reports', 250, 'patient/visit_report', NULL, 'visit_report', NULL, NULL, NULL);
UPDATE  %dbprefix%version SET current_version='0.9.9';
