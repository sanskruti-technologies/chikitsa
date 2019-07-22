INSERT IGNORE INTO %db_prefix%modules (module_name,module_display_name,module_description,module_status) VALUES ('doctor', 'Doctors',"Doctor's Profile, Schedule, Fees and more", '1');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('doctor', '', 300,'doctor', 'fa-user-md', 'Doctor','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('doctor_detail', 'doctor', 200, 'doctor/index', '', 'Doctor Detail','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('department', 'doctor', 300, 'doctor/department', '', 'Departments','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('fees_detail', 'doctor', 500, 'doctor/fees', '', 'Fees','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('doctor_schdule', 'doctor', 600, 'doctor/doctor_schedule', '', 'Doctor Schedule','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('doctor_inavailability', 'doctor', 700, 'doctor/inavailability', '', 'Doctor Inavailability','doctor');
INSERT IGNORE INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ('doctor_preferences', 'doctor', 800, 'doctor/doctor_preference', '', 'Doctor Preferences','doctor');
CREATE TABLE IF NOT EXISTS %db_prefix%department ( department_id int(11) NOT NULL AUTO_INCREMENT,  department_name varchar(100) NOT NULL,  PRIMARY KEY (department_id));
CREATE TABLE IF NOT EXISTS %db_prefix%doctor (  doctor_id int(11) NOT NULL AUTO_INCREMENT,  contact_id int(11) NOT NULL, degree varchar(150) NULL, specification varchar(300) NULL,experience varchar(300) NULL, joining_date date NULL, licence_number varchar(50) NULL,  department_id int(11) NULL,  gender varchar(10) NULL,userid VARCHAR(16) NULL , PRIMARY KEY (doctor_id));
CREATE TABLE IF NOT EXISTS %db_prefix%doctor_schedule ( schedule_id int(11) NOT NULL AUTO_INCREMENT, doctor_id int(11) NOT NULL,  schedule_day varchar(500) NOT NULL,  from_time time NOT NULL, to_time time NOT NULL,  PRIMARY KEY (schedule_id));
CREATE TABLE IF NOT EXISTS %db_prefix%fee_master ( id int(11) NOT NULL AUTO_INCREMENT,  doctor_id int(11) NOT NULL,  detail varchar(100) NOT NULL,  fees int(11) NOT NULL,  PRIMARY KEY (id));
-- 0.0.2
UPDATE %db_prefix%modules SET module_version = '0.0.2' WHERE module_name = 'doctor';
UPDATE %db_prefix%navigation_menu SET menu_text = 'Doctor Schedule' WHERE menu_name = 'doctor_schdule';
-- 0.0.3
UPDATE %db_prefix%modules SET module_version = '0.0.3' WHERE module_name = 'doctor';
-- 0.0.4
UPDATE %db_prefix%modules SET module_version = '0.0.4' WHERE module_name = 'doctor';
-- 0.0.5
UPDATE %db_prefix%modules SET module_version = '0.0.5' WHERE module_name = 'doctor';
-- 0.0.6
UPDATE %db_prefix%modules SET module_version = '0.0.6' WHERE module_name = 'doctor';
-- 0.0.7
ALTER TABLE %db_prefix%doctor ADD  description VARCHAR( 250 ) NULL ;
UPDATE %db_prefix%modules SET module_version = '0.0.7' WHERE module_name = 'doctor';
CREATE TABLE IF NOT EXISTS %db_prefix%doctor_preferences ( preference_id int(11) NOT NULL AUTO_INCREMENT, doctor_id int(11) NOT NULL, max_patient int(11) NOT NULL,  PRIMARY KEY (preference_id));
ALTER TABLE %db_prefix%doctor ADD  dob DATE NULL AFTER description;
UPDATE %db_prefix%modules SET module_version = '0.0.8' WHERE module_name = 'doctor';
CREATE OR REPLACE VIEW %db_prefix%view_fee_master AS SELECT fee_master.id, fee_master.doctor_id, fee_master.detail, fee_master.fees,doctor.userid FROM  %db_prefix%fee_master as fee_master JOIN %db_prefix%doctor as doctor ON doctor.doctor_id = fee_master.doctor_id;
UPDATE %db_prefix%modules SET module_version = '0.0.9' WHERE module_name = 'doctor';
-- 0.1.0
ALTER TABLE %db_prefix%doctor_schedule CHANGE schedule_day schedule_day VARCHAR( 500 ) NULL ;
ALTER TABLE %db_prefix%doctor_schedule ADD  schedule_date DATE NULL AFTER schedule_day;
UPDATE %db_prefix%modules SET module_version = '0.1.0' WHERE module_name = 'doctor';
-- 0.1.1
ALTER TABLE %db_prefix%department ADD  is_deleted INT NULL;
ALTER TABLE %db_prefix%doctor ADD is_deleted INT NULL;
ALTER TABLE %db_prefix%doctor_preferences ADD  is_deleted INT NULL;
ALTER TABLE %db_prefix%doctor_schedule ADD  is_deleted INT NULL;
ALTER TABLE %db_prefix%fee_master ADD  is_deleted INT NULL;
ALTER TABLE %db_prefix%department ADD  sync_status INT NULL;
ALTER TABLE %db_prefix%doctor ADD  sync_status INT NULL;
ALTER TABLE %db_prefix%doctor_preferences ADD  sync_status INT NULL;
ALTER TABLE %db_prefix%doctor_schedule ADD  sync_status INT NULL;
ALTER TABLE %db_prefix%fee_master ADD  sync_status INT NULL;
UPDATE %db_prefix%modules SET module_version = '0.1.1' WHERE module_name = 'doctor';
CREATE OR REPLACE VIEW %db_prefix%view_doctor AS SELECT CONCAT(ifnull(contacts.first_name,''),' ',ifnull(contacts.middle_name,''),' ',ifnull(contacts.last_name,'')) AS name,users.centers,		contacts.first_name,		contacts.middle_name,		contacts.last_name,		doctor.doctor_id AS doctor_id,		doctor.userid AS userid,		doctor.degree AS degree,		doctor.specification AS specification,		doctor.experience AS experience,		doctor.joining_date AS joining_date,		doctor.licence_number AS licence_number,		doctor.department_id AS department_id,		doctor.gender AS gender,		doctor.description AS description,		doctor.dob AS dob,		doctor.contact_id AS contact_id   from %db_prefix%doctor doctor join %db_prefix%contacts contacts on contacts.contact_id = doctor.contact_id join %db_prefix%users users on users.userid = doctor.userid;
UPDATE %db_prefix%modules SET module_version = '0.1.2' WHERE module_name = 'doctor';
-- 0.1.3
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_preferences' WHERE menu_name = 'doctor_preferences';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_inavailability' WHERE menu_name = 'doctor_inavailability';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_schedule' WHERE menu_name = 'doctor_schdule';
UPDATE %db_prefix%navigation_menu SET menu_text = 'fees_detail' WHERE menu_name = 'fees_detail';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor' WHERE menu_name = 'doctor';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_detail' WHERE menu_name = 'doctor_detail';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor' WHERE menu_name = 'doctor';
UPDATE %db_prefix%navigation_menu SET menu_text = 'department' WHERE menu_name = 'department';
UPDATE %db_prefix%navigation_menu SET menu_text = 'fees_detail' WHERE menu_name = 'fees_detail';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_schedule' WHERE menu_name = 'doctor_schdule';
UPDATE %db_prefix%navigation_menu SET menu_text = 'doctor_inavailability' WHERE menu_name = 'doctor_inavailability';
UPDATE %db_prefix%modules SET module_version = '0.1.3' WHERE module_name = 'doctor';
-- 0.1.4
ALTER TABLE %db_prefix%doctor CHANGE department_id department_id VARCHAR(25) NULL DEFAULT NULL;
DELETE FROM %db_prefix%navigation_menu WHERE menu_name = 'doctor_preferences';
UPDATE %db_prefix%modules SET module_version = '0.1.4' WHERE module_name = 'doctor';
CREATE OR REPLACE VIEW %db_prefix%view_fee_master AS SELECT fee_master.id AS id, fee_master.doctor_id AS doctor_id, fee_master.detail AS detail, fee_master.fees AS fees,doctor.userid AS userid FROM %db_prefix%fee_master fee_master JOIN %db_prefix%doctor doctor on doctor.doctor_id = fee_master.doctor_id WHERE IFNULL(fee_master.is_deleted,0) != 1;
INSERT IGNORE INTO %db_prefix%navigation_menu ( menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('nurse', 'doctor', '110', 'doctor/nurse', NULL, 'nurse', 'doctor');
--CREATE OR REPLACE VIEW %db_prefix%view_doctor AS SELECT doctor.contact_id,concat(ifnull(contacts.title,''),' ',ifnull(contacts.first_name,''),' ',ifnull(contacts.middle_name,''),' ',ifnull(contacts.last_name,'')) AS name,doctor.doctor_id AS doctor_id,doctor.userid AS userid,users.centers AS centers from %db_prefix%doctor doctor      join %db_prefix%contacts contacts on contacts.contact_id = doctor.contact_id	 join %db_prefix%users users on users.userid = doctor.userid;
CREATE OR REPLACE VIEW %db_prefix%view_doctor AS SELECT CONCAT(ifnull(contacts.first_name,''),' ',ifnull(contacts.middle_name,''),' ',ifnull(contacts.last_name,'')) AS name,users.centers,	contacts.title,	contacts.first_name,		contacts.middle_name,		contacts.last_name,		doctor.doctor_id AS doctor_id,		doctor.userid AS userid,		doctor.degree AS degree,		doctor.specification AS specification,		doctor.experience AS experience,		doctor.joining_date AS joining_date,		doctor.licence_number AS licence_number,		doctor.department_id AS department_id,		doctor.gender AS gender,		doctor.description AS description,		doctor.dob AS dob,		doctor.contact_id AS contact_id   from %db_prefix%doctor doctor join %db_prefix%contacts contacts on contacts.contact_id = doctor.contact_id join %db_prefix%users users on users.userid = doctor.userid;

--CREATE OR REPLACE VIEW %db_prefix%view_nurse AS SELECT nurse.contact_id,nurse.gender,nurse.joining_date,nurse.department_id,contacts.email,contacts.phone_number AS phone_number,contacts.title,contacts.first_name,contacts.middle_name,contacts.last_name,concat(ifnull(contacts.title,''),' ',ifnull(contacts.first_name,''),' ',ifnull(contacts.middle_name,''),' ',ifnull(contacts.last_name,'')) AS name,nurse.nurse_id AS nurse_id,nurse.userid AS userid,users.centers AS centers from %db_prefix%nurse nurse      join %db_prefix%contacts contacts on contacts.contact_id = nurse.contact_id	 left outer join %db_prefix%users users on users.userid = nurse.userid;
CREATE OR REPLACE VIEW %db_prefix%view_nurse AS SELECT nurse.contact_id,nurse.gender,nurse.joining_date,nurse.is_deleted,nurse.department_id,contacts.email,contacts.phone_number AS phone_number,contacts.title,contacts.first_name,contacts.middle_name,contacts.last_name,concat(ifnull(contacts.title,''),' ',ifnull(contacts.first_name,''),' ',ifnull(contacts.middle_name,''),' ',ifnull(contacts.last_name,'')) AS name,nurse.nurse_id AS nurse_id,nurse.userid AS userid,users.centers AS centers from %db_prefix%nurse nurse      join %db_prefix%contacts contacts on contacts.contact_id = nurse.contact_id	 left outer join %db_prefix%users users on users.userid = nurse.userid;
INSERT INTO %db_prefix%menu_access (menu_name, category_name, allow) SELECT navigation_menu.menu_name,'System Administrator', '1' FROM %db_prefix%navigation_menu AS navigation_menu WHERE navigation_menu.menu_name NOT IN (SELECT menu_name FROM %db_prefix%menu_access WHERE category_name = 'System Administrator');
INSERT INTO %db_prefix%menu_access (menu_name, category_name, allow) SELECT navigation_menu.menu_name,'Administrator', '1' FROM %db_prefix%navigation_menu AS navigation_menu WHERE navigation_menu.menu_name NOT IN (SELECT menu_name FROM %db_prefix%menu_access WHERE category_name = 'Administrator') AND navigation_menu.menu_name NOT IN ('rebrand');
INSERT INTO %db_prefix%menu_access (menu_name, category_name, allow) SELECT navigation_menu.menu_name,'Doctor', '1' FROM %db_prefix%navigation_menu AS navigation_menu WHERE navigation_menu.menu_name NOT IN (SELECT menu_name FROM %db_prefix%menu_access WHERE category_name = 'Doctor') AND navigation_menu.menu_name IN ('doctor_inavailability','doctor_schdule','fees_detail','nurse','doctor_preferences','patient_report','appointment_report','bill_report','tax_report','new_patient','payment','payments', 'bill','issue_refund','appointment report','reports','appointments','new_inquiry','all_patients','patients','bill report','pending_payments','doctor','doctor_detail');