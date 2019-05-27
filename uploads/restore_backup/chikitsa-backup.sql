#
# TABLE STRUCTURE FOR: ck_appointment_log
#

DROP TABLE IF EXISTS `ck_appointment_log`;

CREATE TABLE `ck_appointment_log` (
  `appointment_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `change_date_time` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `appointment_reason` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`appointment_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, 1, '13/05/2019 07:11:20', '10:00:00', '07:11:20', '07:24:54', ' ', 'Appointment', 'System Administrator', 'abc', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, 1, '13/05/2019 07:24:54', '10:00:00', '07:24:54', '00:00:00', 'Appointments', 'Complete', 'System Administrator', 'abc', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (3, 2, '13/05/2019 07:26:08', '11:00:00', '07:26:08', '07:26:25', ' ', 'Appointment', 'System Administrator', 'Fever', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (4, 2, '13/05/2019 07:26:25', '11:00:00', '07:26:25', '07:28:22', 'Appointments', 'Consultation', 'System Administrator', 'Fever', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (5, 2, '13/05/2019 07:28:22', '11:00:00', '07:28:22', '00:00:00', 'Consultation', 'Complete', 'System Administrator', 'Fever', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (6, 3, '13/05/2019 07:31:09', '10:30:00', '07:31:09', '07:31:32', ' ', 'Appointment', 'System Administrator', '', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (7, 3, '13/05/2019 07:31:32', '10:30:00', '07:31:32', '07:31:45', 'Appointments', 'Cancel', 'System Administrator', '', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (8, 3, '13/05/2019 07:31:45', '10:30:00', '07:31:45', '07:31:54', 'Cancel', 'Appointments', 'System Administrator', '', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (9, 3, '13/05/2019 07:31:54', '10:30:00', '07:31:54', '07:32:16', 'Appointments', 'Waiting', 'System Administrator', '', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (10, 3, '13/05/2019 07:32:16', '10:30:00', '07:32:16', '07:33:19', 'Waiting', 'Consultation', 'System Administrator', '', NULL, 0, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (11, 3, '13/05/2019 07:33:19', '10:30:00', '07:33:19', '00:00:00', 'Consultation', 'Complete', 'System Administrator', '', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_appointments
#

DROP TABLE IF EXISTS `ck_appointments`;

CREATE TABLE `ck_appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `title` varchar(150) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `visit_id` int(11) NOT NULL DEFAULT '0',
  `appointment_reason` varchar(100) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, '2019-05-13', NULL, '10:00:00', '10:30:00', 'nishi  ', 1, 2, 1, 'Complete', 0, 'abc', NULL, NULL, 0, NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, '2019-05-13', NULL, '11:00:00', '11:30:00', 'manisha  ', 2, 3, 2, 'Complete', 3, 'Fever', NULL, NULL, 0, NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (3, '2019-05-13', NULL, '10:30:00', '11:00:00', 'zeni  ', 3, 2, 1, 'Complete', 4, '', NULL, NULL, 0, NULL);


#
# TABLE STRUCTURE FOR: ck_bill
#

DROP TABLE IF EXISTS `ck_bill`;

CREATE TABLE `ck_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `bill_date` date NOT NULL,
  `bill_time` time DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(10,2) DEFAULT '0.00',
  `due_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (1, 1, NULL, '2019-05-13', '06:44:09', 1, 1, '705.00', NULL, '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (2, NULL, NULL, '2019-05-13', NULL, 1, 1, '0.00', '0.00', '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (3, 1, NULL, '2019-05-13', '07:03:33', 1, 2, '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (4, 1, NULL, '2019-05-13', '07:19:00', 1, NULL, '100.00', NULL, '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (5, 1, NULL, '2019-05-13', '07:19:00', 1, NULL, '100.00', NULL, '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (6, 1, NULL, '2019-05-13', '07:26:56', 2, 3, '600.00', NULL, '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (7, NULL, NULL, '2019-05-13', NULL, 2, 3, '0.00', '0.00', '0.00', NULL, 0, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `tax_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`, `appointment_id`) VALUES (8, 1, NULL, '2019-05-13', '07:32:36', 3, 4, '100.00', NULL, '0.00', NULL, 0, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_bill_detail
#

DROP TABLE IF EXISTS `ck_bill_detail`;

CREATE TABLE `ck_bill_detail` (
  `bill_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `particular` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `type` varchar(25) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (2, NULL, 1, 'bill', '500.00', 1, '500.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (3, NULL, 1, 'No Tax ( 5.00% )', '35.00', 1, '35.00', 'tax', NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (4, NULL, 1, 'bill', '200.00', 1, '200.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (5, NULL, 1, 'Discount', '5.00', 1, '5.00', 'discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (6, NULL, 4, 'bill', '100.00', 1, '100.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (7, NULL, 5, 'bill', '100.00', 1, '100.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (8, NULL, 6, 'bill', '600.00', 1, '600.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `tax_amount`, `is_deleted`, `sync_status`, `clinic_code`, `tax_id`) VALUES (9, NULL, 8, 'bill', '100.00', 1, '100.00', 'particular', NULL, NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_bill_payment_r
#

DROP TABLE IF EXISTS `ck_bill_payment_r`;

CREATE TABLE `ck_bill_payment_r` (
  `bill_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `adjust_amount` decimal(11,0) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`bill_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, 1, 1, '0', NULL, 0, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, 1, 2, '150', NULL, 0, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (3, 2, 2, '0', NULL, 0, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (4, 1, 3, '570', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (5, 2, 3, '525', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (6, 4, 3, '100', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (7, 5, 3, '100', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (8, 6, 4, '600', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (9, 7, 4, '1200', NULL, NULL, NULL);
INSERT INTO `ck_bill_payment_r` (`bill_payment_id`, `bill_id`, `payment_id`, `adjust_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (10, 8, 5, '100', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_clinic
#

DROP TABLE IF EXISTS `ck_clinic`;

CREATE TABLE `ck_clinic` (
  `clinic_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `time_interval` decimal(11,2) NOT NULL DEFAULT '0.50',
  `clinic_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `tag_line` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `clinic_address` varchar(500) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `google_plus` varchar(50) DEFAULT NULL,
  `next_followup_days` int(11) DEFAULT '15',
  `clinic_logo` varchar(255) DEFAULT NULL,
  `max_patient` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_clinic` (`clinic_id`, `start_time`, `end_time`, `time_interval`, `clinic_name`, `clinic_code`, `tag_line`, `clinic_address`, `landline`, `mobile`, `email`, `facebook`, `twitter`, `google_plus`, `next_followup_days`, `clinic_logo`, `max_patient`, `is_deleted`, `sync_status`, `website`) VALUES (1, '09:00', '18:00', '30.00', 'Chikitsa', NULL, 'Patient Management Software', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, 1, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_contact_details
#

DROP TABLE IF EXISTS `ck_contact_details`;

CREATE TABLE `ck_contact_details` (
  `contact_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` varchar(150) NOT NULL,
  `is_default` int(1) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`contact_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, 3, 'mobile', '2569865896', 1, NULL, NULL, NULL);
INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, 4, 'mobile', '9865956856', 1, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_contacts
#

DROP TABLE IF EXISTS `ck_contacts`;

CREATE TABLE `ck_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(5) DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `second_number` varchar(25) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact_image` varchar(255) NOT NULL DEFAULT 'images/Profile.png',
  `type` varchar(50) DEFAULT NULL,
  `address_line_1` varchar(150) DEFAULT NULL,
  `address_line_2` varchar(150) DEFAULT NULL,
  `area` varchar(25) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, '', 'Doctor1', '', '', NULL, NULL, NULL, NULL, 'images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, '', 'doctor2', '', '', NULL, NULL, NULL, NULL, 'images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (3, NULL, 'nishi', NULL, NULL, NULL, '2569865896', NULL, NULL, 'uploads/images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (4, NULL, 'manisha', NULL, NULL, NULL, '9865956856', NULL, NULL, 'uploads/images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (5, NULL, 'zeni', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_data
#

DROP TABLE IF EXISTS `ck_data`;

CREATE TABLE `ck_data` (
  `ck_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `ck_key` varchar(50) NOT NULL DEFAULT '',
  `ck_value` varchar(500) NOT NULL DEFAULT '',
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ck_data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (1, 'default_language', 'english', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (2, 'default_timezone', 'UTC', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (3, 'default_dateformate', 'd-m-Y', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (4, 'working_days', '7,1,2,3,4,5,6', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (5, 'software_name', 'Chikitsa', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (6, 'copyright_url', 'http://sanskruti.net/ ', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (7, 'copyright_text', '&copy; 2017 Sanskruti Technologies', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (8, 'default_timeformate', 'h:i A', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (9, 'website_text', 'Chikitsa', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (10, 'website_url', 'http://chikitsa.sanskruti.net/ ', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (11, 'support_text', 'Support Forum', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (12, 'support_url', 'http://sanskruti.net/chikitsa/bug-tracker/', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (13, 'support_url', '<h4>Chikitsa would not have been possible without the amazing works listed below</h4><h5><b>Framework</b></h5><a href=\"http://codeigniter.com\">CodeIgniter 3.0.0</a><h5><b></b></h5><a href=\"https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc\">Modular Extensions - HMVC<h5><b></b></h5></a><h5><b>Theme</b></h5><a href=\"http://www.bootstrapzero.com/bootstrap-template/binary\">Binary Admin (Bootstrap v3.1.1)</a><h5><b></b></h5><a href=\"https://fortawesome.github.io/Font-Awesome/\">Font', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (14, 'about_us_content', '<h4>Chikitsa would not have been possible without the amazing works listed below</h4><h5><b>Framework</b></h5><a href=\"http://codeigniter.com\">CodeIgniter 3.0.0</a><h5><b></b></h5><a href=\"https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc\">Modular Extensions - HMVC<h5><b></b></h5></a><h5><b>Theme</b></h5><a href=\"http://www.bootstrapzero.com/bootstrap-template/binary\">Binary Admin (Bootstrap v3.1.1)</a><h5><b></b></h5><a href=\"https://fortawesome.github.io/Font-Awesome/\">Font', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (15, 'login_page', 'appointment/index', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES (16, 'tax_type', 'bill', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_doctor
#

DROP TABLE IF EXISTS `ck_doctor`;

CREATE TABLE `ck_doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `degree` varchar(150) DEFAULT NULL,
  `specification` varchar(300) DEFAULT NULL,
  `experience` varchar(300) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `licence_number` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `userid` varchar(16) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT NULL,
  `erpnext_key` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `ck_doctor` (`doctor_id`, `contact_id`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `userid`, `sync_status`, `is_deleted`, `erpnext_key`, `description`, `dob`) VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_doctor` (`doctor_id`, `contact_id`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `userid`, `sync_status`, `is_deleted`, `erpnext_key`, `description`, `dob`) VALUES (2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_followup
#

DROP TABLE IF EXISTS `ck_followup`;

CREATE TABLE `ck_followup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `followup_date` date NOT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES (1, 1, 1, '2019-05-28', NULL, 0);
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES (2, 2, 2, '2019-05-28', NULL, NULL);
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES (3, 1, 3, '2019-05-28', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_invoice
#

DROP TABLE IF EXISTS `ck_invoice`;

CREATE TABLE `ck_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `static_prefix` varchar(10) NOT NULL DEFAULT '',
  `left_pad` int(11) NOT NULL,
  `next_id` int(11) NOT NULL,
  `currency_symbol` varchar(10) DEFAULT NULL,
  `currency_postfix` char(10) DEFAULT '/-',
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_invoice` (`invoice_id`, `static_prefix`, `left_pad`, `next_id`, `currency_symbol`, `currency_postfix`, `is_deleted`, `sync_status`) VALUES (1, '', 3, 1, 'Rs.', '', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_menu_access
#

DROP TABLE IF EXISTS `ck_menu_access`;

CREATE TABLE `ck_menu_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `allow` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_name` (`menu_name`,`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (1, 'bill report', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (2, 'patients', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (3, 'all_patients', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (4, 'new_inquiry', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (5, 'reports', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (6, 'appointments', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (7, 'all_patients', 'Receptionist', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (8, 'patients', 'Receptionist', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (9, 'new_inquiry', 'Receptionist', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (10, 'appointment report', 'Doctor', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (11, 'appointments', 'Receptionist', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (12, 'journal_voucher', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (13, 'cash_receipt', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (14, 'bank_payment', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (15, 'cash_payment', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (16, 'bank_receipt', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (17, 'patient_report', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (18, 'bill', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (19, 'payments', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (20, 'clinic_details', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (21, 'menu_access', 'Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (22, 'administration', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (23, 'all_patients', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (24, 'all_users', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (25, 'appointments', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (26, 'appointment_report', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (27, 'backup', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (28, 'bank_payment', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (29, 'bank_receipt', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (30, 'bill', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (31, 'bill_report', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (32, 'cash_payment', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (33, 'cash_receipt', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (34, 'clinic detail', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (35, 'general_settings', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (36, 'issue_refund', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (37, 'journal_voucher', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (38, 'modules', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (39, 'new_inquiry', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (40, 'new_patient', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (41, 'patients', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (42, 'patient_report', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (43, 'payment', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (44, 'payments', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (45, 'payment_methods', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (46, 'reference_by', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (47, 'reports', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (48, 'setting', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (49, 'tax_rates', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (50, 'tax_report', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (51, 'users', 'System Administrator', 1);
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES (52, 'working_days', 'System Administrator', 1);


#
# TABLE STRUCTURE FOR: ck_modules
#

DROP TABLE IF EXISTS `ck_modules`;

CREATE TABLE `ck_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_display_name` varchar(50) NOT NULL,
  `module_description` varchar(150) NOT NULL,
  `module_status` int(1) NOT NULL,
  `module_version` varchar(10) DEFAULT NULL,
  `activation_hook` varchar(50) DEFAULT NULL,
  `license_key` varchar(100) DEFAULT NULL,
  `license_status` varchar(100) DEFAULT NULL,
  `required_modules` varchar(250) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_navigation_menu
#

DROP TABLE IF EXISTS `ck_navigation_menu`;

CREATE TABLE `ck_navigation_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(250) DEFAULT NULL,
  `parent_name` varchar(250) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `menu_url` varchar(500) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_text` varchar(200) DEFAULT NULL,
  `required_module` varchar(25) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_name` (`menu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (1, 'cash_payment', 'account', 400, 'account/cash_payment', NULL, 'cash_payment', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (2, 'cash_receipt', 'account', 500, 'account/cash_receipt', NULL, 'cash_receipt', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (3, 'bank_payment', 'account', 200, 'account/bank_payment', NULL, 'bank_payment', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (4, 'journal_voucher', 'account', 600, 'account/journal_voucher', NULL, 'journal_voucher', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (5, 'bank_receipt', 'account', 300, 'account/bank_receipt', NULL, 'bank_receipt', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (6, 'reference_by', 'administration', 750, 'settings/reference_by', NULL, 'reference_by', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (7, 'general_settings', 'frontend', 400, 'frontend/general_settings', NULL, 'general_settings', 'frontend', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (8, 'backup', 'administration', 600, 'settings/backup', NULL, 'backup', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (9, 'working_days', 'administration', 200, 'settings/working_days', NULL, 'working_days', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (10, 'new_patient', 'patients', 100, 'patient/insert', NULL, 'add_patient', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (11, 'patients', '', 200, '#', 'fa-users', 'patients', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (12, 'all_users', 'users', 100, 'admin/users', NULL, 'all_users', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (13, 'all_patients', 'patients', 0, 'patient/index', NULL, 'all_patients', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (14, 'appointments', '', 100, 'appointment/index', 'fa-calendar', 'appointments', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (15, 'new_inquiry', 'patients', 200, 'patient/new_inquiry_report', NULL, 'new_inquiry', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (16, 'bill_report', 'reports', 300, 'patient/bill_detail_report', '', 'bill_report', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (17, 'appointment_report', 'reports', 100, 'appointment/appointment_report', '', 'appointment_report', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (18, 'administration', '', 500, '#', 'fa-cog', 'administration', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (19, 'modules', '', 600, 'module/index', 'fa-shopping-cart', 'modules', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (20, 'reports', '', 400, '#', 'fa-line-chart', 'reports', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (21, 'clinic detail', 'administration', 100, 'settings/clinic', '', 'clinic_details', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (22, 'users', 'administration', 300, '#', '', 'users', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (23, 'setting', 'administration', 500, 'settings/change_settings', '', 'setting', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (24, 'payment', '', 300, '#', 'fa-money', 'bills_payments', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (25, 'patient_report', 'reports', 90, 'patient/patient_report', NULL, 'patient_report', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (26, 'bill', 'payment', 100, 'bill/index', NULL, 'bills', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (27, 'payments', 'payment', 200, 'payment/index', NULL, 'payments', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (28, 'tax_rates', 'administration', 700, 'settings/tax_rates', NULL, 'tax_rates', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (29, 'tax_report', 'reports', 600, 'bill/tax_report', NULL, 'tax_report', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (30, 'payment_methods', 'administration', 650, 'payment/payment_methods', NULL, 'payment_methods', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES (31, 'issue_refund', 'payment', 300, 'payment/issue_refund', NULL, 'issue_refund', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_patient
#

DROP TABLE IF EXISTS `ck_patient`;

CREATE TABLE `ck_patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `patient_since` date NOT NULL,
  `display_id` varchar(12) DEFAULT NULL,
  `ssn_id` varchar(25) DEFAULT NULL,
  `followup_date` date DEFAULT NULL,
  `reference_by` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `wp_user_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `is_inquiry` int(1) DEFAULT NULL,
  `inquiry_reason` varchar(50) DEFAULT NULL,
  `erpnext_key` varchar(25) DEFAULT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `reference_by_detail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `ssn_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `is_inquiry`, `inquiry_reason`, `erpnext_key`, `blood_group`, `reference_by_detail`) VALUES (1, 3, '2019-05-13', '00001', NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `ssn_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `is_inquiry`, `inquiry_reason`, `erpnext_key`, `blood_group`, `reference_by_detail`) VALUES (2, 4, '2019-05-13', '00002', NULL, '2019-05-28', NULL, 'female', '1996-05-08', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '');
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `ssn_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `is_inquiry`, `inquiry_reason`, `erpnext_key`, `blood_group`, `reference_by_detail`) VALUES (3, 5, '2019-05-13', '00003', NULL, '2019-05-28', NULL, 'female', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '');


#
# TABLE STRUCTURE FOR: ck_patient_account
#

DROP TABLE IF EXISTS `ck_patient_account`;

CREATE TABLE `ck_patient_account` (
  `patient_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `adjust_amount` decimal(11,2) NOT NULL,
  `refund_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`patient_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_patient_account` (`patient_account_id`, `patient_id`, `payment_id`, `bill_id`, `adjust_amount`, `refund_id`) VALUES (1, 1, 1, NULL, '0.00', NULL);
INSERT INTO `ck_patient_account` (`patient_account_id`, `patient_id`, `payment_id`, `bill_id`, `adjust_amount`, `refund_id`) VALUES (2, 1, NULL, 1, '5.00', NULL);
INSERT INTO `ck_patient_account` (`patient_account_id`, `patient_id`, `payment_id`, `bill_id`, `adjust_amount`, `refund_id`) VALUES (3, 1, NULL, 2, '0.00', NULL);
INSERT INTO `ck_patient_account` (`patient_account_id`, `patient_id`, `payment_id`, `bill_id`, `adjust_amount`, `refund_id`) VALUES (4, 1, 2, NULL, '0.00', NULL);
INSERT INTO `ck_patient_account` (`patient_account_id`, `patient_id`, `payment_id`, `bill_id`, `adjust_amount`, `refund_id`) VALUES (5, 1, NULL, NULL, '-5.00', 0);


#
# TABLE STRUCTURE FOR: ck_payment
#

DROP TABLE IF EXISTS `ck_payment`;

CREATE TABLE `ck_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_mode` varchar(50) NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `additional_detail` varchar(50) DEFAULT NULL,
  `level` varchar(25) NOT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `payment_status` varchar(25) NOT NULL DEFAULT 'complete',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `additional_detail`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `payment_status`) VALUES (1, 1, '2019-05-13', 'Online Payment', '520', '25', '', NULL, NULL, 0, NULL, 'pending');
INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `additional_detail`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `payment_status`) VALUES (2, 1, '2019-05-13', 'Cash', '150', '', '', NULL, NULL, 0, NULL, 'complete');
INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `additional_detail`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `payment_status`) VALUES (3, 1, '2019-05-13', 'Cash', '1295', '', '', NULL, NULL, NULL, NULL, 'complete');
INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `additional_detail`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `payment_status`) VALUES (4, 2, '2019-05-13', 'Cash', '1800', '', '', NULL, NULL, NULL, NULL, 'complete');
INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `additional_detail`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`, `payment_status`) VALUES (5, 3, '2019-05-13', 'Cash', '100', '', '', NULL, NULL, NULL, NULL, 'complete');


#
# TABLE STRUCTURE FOR: ck_payment_methods
#

DROP TABLE IF EXISTS `ck_payment_methods`;

CREATE TABLE `ck_payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(25) NOT NULL,
  `has_additional_details` int(1) NOT NULL,
  `additional_detail_label` varchar(50) NOT NULL,
  `needs_cash_calc` int(1) NOT NULL DEFAULT '0',
  `payment_pending` int(1) DEFAULT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ck_payment_methods` (`payment_method_id`, `payment_method_name`, `has_additional_details`, `additional_detail_label`, `needs_cash_calc`, `payment_pending`) VALUES (1, 'Cash', 0, '', 1, NULL);
INSERT INTO `ck_payment_methods` (`payment_method_id`, `payment_method_name`, `has_additional_details`, `additional_detail_label`, `needs_cash_calc`, `payment_pending`) VALUES (2, 'Cheque', 1, 'Cheque Number', 0, NULL);
INSERT INTO `ck_payment_methods` (`payment_method_id`, `payment_method_name`, `has_additional_details`, `additional_detail_label`, `needs_cash_calc`, `payment_pending`) VALUES (3, 'Online Payment', 1, 'Fees', 1, 1);


#
# TABLE STRUCTURE FOR: ck_payment_transaction
#

DROP TABLE IF EXISTS `ck_payment_transaction`;

CREATE TABLE `ck_payment_transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_receipt_template
#

DROP TABLE IF EXISTS `ck_receipt_template`;

CREATE TABLE `ck_receipt_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_default` int(1) NOT NULL,
  `template_name` varchar(25) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES (1, '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><h3 style=\"text-align: center;\"><u style=\"text-align: center;\">RECEIPT</u></h3><p><span style=\"text-align: left;\"><strong>Date : </strong>[bill_date] [bill_time]</span><span style=\"float: right;\"><strong>Receipt Number :</strong> [bill_id]</span></p><p style=\"text-align: left;\"><strong style=\"text-align: left;\">Patient Name: </strong><span style=\"text-align: left;\">[patient_name]<br /></span></p><hr id=\"null\" style=\"text-align: left;\" /><p>Received fees for Professional services and other charges of our:</p><p>&nbsp;</p><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr><td style=\"width: 400px; text-align: left; padding: 5px; border: 1px solid black;\"><strong style=\"width: 400px; text-align: left;\">Item</strong></td><td style=\"padding: 5px; border: 1px solid black;\"><strong>Quantity</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>M.R.P.</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>Amount</strong></td></tr></thead><tbody><tr><td colspan=\"4\">[col:particular|quantity|mrp|amount]</td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Discount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[discount]</strong></td></tr><tr><td>[tax_details]</td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Total</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[total]</strong></td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Paid Amount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\">[paid_amount]</td></tr></tbody></table><p>Received with Thanks,</p><p>For [clinic_name]</p><p>&nbsp;</p><p>&nbsp;</p><p>Signature</p>', 0, 'Main', 'bill', NULL, NULL);
INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES (2, '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><h3 style=\"text-align: center;\"><u style=\"text-align: center;\">RECEIPT</u></h3><p><span style=\"text-align: left;\"><strong>Date : </strong>[bill_date] [bill_time]</span><span style=\"float: right;\"><strong>Receipt Number :</strong> [bill_id]</span></p><p style=\"text-align: left;\"><strong style=\"text-align: left;\">Patient Name: </strong><span style=\"text-align: left;\">[patient_name]<br /></span></p><hr id=\"null\" style=\"text-align: left;\" /><p>Received fees for Professional services and other charges of our:</p><p>&nbsp;</p><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr><td style=\"width: 400px; text-align: left; padding: 5px; border: 1px solid black;\"><strong style=\"width: 400px; text-align: left;\">Item</strong></td><td style=\"padding: 5px; border: 1px solid black;\"><strong>Quantity</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>M.R.P.</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>Amount</strong></td>[tax_column_header]</tr></thead><tbody><tr><td colspan=\"4\">[col:particular|quantity|mrp|amount|tax_amount]</td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Discount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[discount]</strong></td></tr><tr><td>[tax_details]</td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Total</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[total]</strong></td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Paid Amount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\">[paid_amount]</td></tr></tbody></table><p>Received with Thanks,</p><p>For [clinic_name]</p><p>&nbsp;</p><p>&nbsp;</p><p>Signature</p>', 1, 'Main with Tax', 'bill', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_reference_by
#

DROP TABLE IF EXISTS `ck_reference_by`;

CREATE TABLE `ck_reference_by` (
  `reference_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_option` varchar(25) NOT NULL,
  `reference_add_option` int(1) DEFAULT NULL,
  `placeholder` varchar(25) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_refund
#

DROP TABLE IF EXISTS `ck_refund`;

CREATE TABLE `ck_refund` (
  `refund_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `refund_amount` int(12) NOT NULL,
  `refund_date` date NOT NULL,
  `refund_note` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ck_refund` (`refund_id`, `patient_id`, `refund_amount`, `refund_date`, `refund_note`) VALUES (0, 1, 5, '2019-05-13', 'abc');


#
# TABLE STRUCTURE FOR: ck_tax_rates
#

DROP TABLE IF EXISTS `ck_tax_rates`;

CREATE TABLE `ck_tax_rates` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_rate_name` varchar(25) NOT NULL,
  `tax_rate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_tax_rates` (`tax_id`, `tax_rate_name`, `tax_rate`) VALUES (1, 'No Tax', '5.00');


#
# TABLE STRUCTURE FOR: ck_todos
#

DROP TABLE IF EXISTS `ck_todos`;

CREATE TABLE `ck_todos` (
  `id_num` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `todo` varchar(250) DEFAULT NULL,
  `done` int(11) DEFAULT '0',
  `add_date` datetime DEFAULT NULL,
  `done_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_todos` (`id_num`, `userid`, `todo`, `done`, `add_date`, `done_date`, `is_deleted`, `sync_status`) VALUES (1, 1, 'abc', 0, '2019-05-13 09:10:41', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_user_categories
#

DROP TABLE IF EXISTS `ck_user_categories`;

CREATE TABLE `ck_user_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES (1, 'System Administrator', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES (2, 'Administrator', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES (3, 'Doctor', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES (4, 'Nurse', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES (5, 'Receptionist', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_user_verification
#

DROP TABLE IF EXISTS `ck_user_verification`;

CREATE TABLE `ck_user_verification` (
  `verification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `verification_code` int(6) NOT NULL,
  `code_generated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code_is_verified` int(1) DEFAULT NULL,
  PRIMARY KEY (`verification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_users
#

DROP TABLE IF EXISTS `ck_users`;

CREATE TABLE `ck_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `contact_id` int(11) DEFAULT NULL,
  `centers` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES (1, 'System Administrator', 'admin', 'YWRtaW4=', 'System Administrator', 1, NULL, NULL, NULL, NULL);
INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES (2, ' Doctor1  ', 'doctor1', 'ZG9j', 'Doctor', 1, 1, '1', NULL, NULL);
INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES (3, ' doctor2  ', 'doctor2', 'ZG9j', 'Doctor', 1, 2, '1', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_version
#

DROP TABLE IF EXISTS `ck_version`;

CREATE TABLE `ck_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_version` varchar(11) NOT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_version` (`id`, `current_version`, `is_deleted`, `sync_status`) VALUES (1, '0.7.7', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_view_bill
#

DROP TABLE IF EXISTS `ck_view_bill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill` AS select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`doctor`.`name` AS `doctor_name`,ifnull(`visit`.`doctor_id`,`bill`.`doctor_id`) AS `doctor_id`,`visit`.`clinic_id` AS `clinic_id`,`clinic`.`clinic_name` AS `clinic_name`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,`bill`.`total_amount` AS `total_amount`,ifnull(`bill`.`tax_amount`,0) AS `item_tax_amount`,sum(`bill_detail`.`amount`) AS `bill_tax_amount`,`bill`.`due_amount` AS `due_amount`,((select sum(`bill_payment_r`.`adjust_amount`) from `ck_bill_payment_r` `bill_payment_r` where (`bill_payment_r`.`bill_id` = `bill`.`bill_id`)) + (select sum(`patient_account`.`adjust_amount`) from `ck_patient_account` `patient_account` where (`patient_account`.`bill_id` = `bill`.`bill_id`))) AS `pay_amount` from ((((((`ck_bill` `bill` left join `ck_visit` `visit` on((`bill`.`visit_id` = `visit`.`visit_id`))) left join `ck_clinic` `clinic` on((`clinic`.`clinic_id` = `bill`.`clinic_id`))) left join `ck_patient` `patient` on((`bill`.`patient_id` = `patient`.`patient_id`))) left join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`))) left join `ck_view_doctor` `doctor` on((ifnull(`visit`.`doctor_id`,`bill`.`doctor_id`) = `doctor`.`doctor_id`))) left join `ck_bill_detail` `bill_detail` on(((`bill_detail`.`bill_id` = `bill`.`bill_id`) and (`bill_detail`.`type` = 'tax')))) group by `bill`.`bill_id`,`doctor`.`name`,`visit`.`userid`,`patient`.`patient_id`;

latin1_swedish_ci;

INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (1, '2019-05-13', 1, ' Doctor1  ', '1', NULL, 'Chikitsa', 1, '00001', 'nishi', NULL, NULL, '705.00', '0.00', '35.00', '0.00', '725.00');
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (2, '2019-05-13', 1, ' Doctor1  ', '1', NULL, NULL, 1, '00001', 'nishi', NULL, NULL, '0.00', '0.00', NULL, '0.00', '525.00');
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (3, '2019-05-13', 2, ' Doctor1  ', '1', NULL, 'Chikitsa', 1, '00001', 'nishi', NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (4, '2019-05-13', NULL, '   ', NULL, NULL, 'Chikitsa', 1, '00001', 'nishi', NULL, NULL, '100.00', '0.00', NULL, '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (5, '2019-05-13', NULL, '   ', NULL, NULL, 'Chikitsa', 1, '00001', 'nishi', NULL, NULL, '100.00', '0.00', NULL, '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (6, '2019-05-13', 3, ' doctor2  ', '2', NULL, 'Chikitsa', 2, '00002', 'manisha', NULL, NULL, '600.00', '0.00', NULL, '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (7, '2019-05-13', 3, ' doctor2  ', '2', NULL, NULL, 2, '00002', 'manisha', NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `item_tax_amount`, `bill_tax_amount`, `due_amount`, `pay_amount`) VALUES (8, '2019-05-13', 4, ' Doctor1  ', '1', NULL, 'Chikitsa', 3, '00003', 'zeni', NULL, NULL, '100.00', '0.00', NULL, '0.00', NULL);


#
# TABLE STRUCTURE FOR: ck_view_bill_detail_report
#

DROP TABLE IF EXISTS `ck_view_bill_detail_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill_detail_report` AS select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`amount` AS `amount`,`bill_detail`.`tax_amount` AS `tax_amount`,`visit`.`userid` AS `userid`,concat(`view_patient`.`first_name`,' ',`view_patient`.`middle_name`,' ',convert(`view_patient`.`last_name` using utf8)) AS `patient_name`,`view_patient`.`display_id` AS `display_id`,`bill_detail`.`type` AS `type` from (((`ck_bill` `bill` left join `ck_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`))) left join `ck_visit` `visit` on((`visit`.`visit_id` = `bill`.`visit_id`))) left join `ck_view_patient` `view_patient` on((`view_patient`.`patient_id` = `bill`.`patient_id`))) where (ifnull(`bill_detail`.`is_deleted`,0) <> 1);

latin1_swedish_ci;

INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (1, '2019-05-13', 1, 'bill', '500.00', NULL, 2, NULL, '00001', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (1, '2019-05-13', 1, 'No Tax ( 5.00% )', '35.00', NULL, 2, NULL, '00001', 'tax');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (1, '2019-05-13', 1, 'bill', '200.00', NULL, 2, NULL, '00001', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (1, '2019-05-13', 1, 'Discount', '5.00', NULL, 2, NULL, '00001', 'discount');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (4, '2019-05-13', NULL, 'bill', '100.00', NULL, NULL, NULL, '00001', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (5, '2019-05-13', NULL, 'bill', '100.00', NULL, NULL, NULL, '00001', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (2, '2019-05-13', 1, NULL, NULL, NULL, 2, NULL, '00001', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (3, '2019-05-13', 2, NULL, NULL, NULL, 2, NULL, '00001', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (6, '2019-05-13', 3, 'bill', '600.00', NULL, 3, NULL, '00002', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (7, '2019-05-13', 3, NULL, NULL, NULL, 3, NULL, '00002', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `tax_amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES (8, '2019-05-13', 4, 'bill', '100.00', NULL, 2, NULL, '00003', 'particular');


#
# TABLE STRUCTURE FOR: ck_view_bill_payment_r
#

DROP TABLE IF EXISTS `ck_view_bill_payment_r`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill_payment_r` AS select `payment`.`pay_date` AS `pay_date`,`bill_payment_r`.`bill_id` AS `bill_id`,`bill_payment_r`.`adjust_amount` AS `adjust_amount`,`payment`.`payment_id` AS `payment_id` from (`ck_payment` `payment` join `ck_bill_payment_r` `bill_payment_r` on((`bill_payment_r`.`payment_id` = `payment`.`payment_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 1, '0', 1);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 1, '150', 2);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 2, '0', 2);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 1, '570', 3);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 2, '525', 3);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 4, '100', 3);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 5, '100', 3);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 6, '600', 4);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 7, '1200', 4);
INSERT INTO `ck_view_bill_payment_r` (`pay_date`, `bill_id`, `adjust_amount`, `payment_id`) VALUES ('2019-05-13', 8, '100', 5);


#
# TABLE STRUCTURE FOR: ck_view_bill_tax_report
#

DROP TABLE IF EXISTS `ck_view_bill_tax_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill_tax_report` AS select `patient`.`display_id` AS `display_id`,`patient`.`first_name` AS `first_name`,`patient`.`middle_name` AS `middle_name`,`patient`.`last_name` AS `last_name`,`bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`total_amount` AS `total_amount`,sum(`bill_detail`.`amount`) AS `tax_amount` from ((`ck_bill` `bill` join `ck_view_patient` `patient` on((`patient`.`patient_id` = `bill`.`patient_id`))) left join `ck_bill_detail` `bill_detail` on(((`bill_detail`.`bill_id` = `bill`.`bill_id`) and (`bill_detail`.`type` = 'tax')))) group by `bill`.`bill_id`;

latin1_swedish_ci;

INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00001', 'nishi', NULL, NULL, 1, '2019-05-13', '705.00', '35.00');
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00001', 'nishi', NULL, NULL, 2, '2019-05-13', '0.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00001', 'nishi', NULL, NULL, 3, '2019-05-13', '0.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00001', 'nishi', NULL, NULL, 4, '2019-05-13', '100.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00001', 'nishi', NULL, NULL, 5, '2019-05-13', '100.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00002', 'manisha', NULL, NULL, 6, '2019-05-13', '600.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00002', 'manisha', NULL, NULL, 7, '2019-05-13', '0.00', NULL);
INSERT INTO `ck_view_bill_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `total_amount`, `tax_amount`) VALUES ('00003', 'zeni', NULL, NULL, 8, '2019-05-13', '100.00', NULL);


#
# TABLE STRUCTURE FOR: ck_view_contact_email
#

DROP TABLE IF EXISTS `ck_view_contact_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_contact_email` AS select `ck_contact_details`.`contact_id` AS `contact_id`,`ck_contact_details`.`detail` AS `email` from `ck_contact_details` where (`ck_contact_details`.`type` = 'email');

latin1_swedish_ci;

#
# TABLE STRUCTURE FOR: ck_view_doctor
#

DROP TABLE IF EXISTS `ck_view_doctor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_doctor` AS select concat(convert(ifnull(`contacts`.`title`,'') using utf8),' ',ifnull(`contacts`.`first_name`,''),' ',ifnull(`contacts`.`middle_name`,''),' ',ifnull(`contacts`.`last_name`,'')) AS `name`,`users`.`centers` AS `centers`,`contacts`.`title` AS `title`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,`doctor`.`doctor_id` AS `doctor_id`,`doctor`.`userid` AS `userid`,`doctor`.`degree` AS `degree`,`doctor`.`specification` AS `specification`,`doctor`.`experience` AS `experience`,`doctor`.`joining_date` AS `joining_date`,`doctor`.`licence_number` AS `licence_number`,`doctor`.`department_id` AS `department_id`,`doctor`.`gender` AS `gender`,`doctor`.`description` AS `description`,`doctor`.`dob` AS `dob`,`doctor`.`contact_id` AS `contact_id` from ((`ck_doctor` `doctor` join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `doctor`.`contact_id`))) join `ck_users` `users` on((`users`.`userid` = `doctor`.`userid`)));

latin1_swedish_ci;

INSERT INTO `ck_view_doctor` (`name`, `centers`, `title`, `first_name`, `middle_name`, `last_name`, `doctor_id`, `userid`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `description`, `dob`, `contact_id`) VALUES (' Doctor1  ', '1', '', 'Doctor1', '', '', 1, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `ck_view_doctor` (`name`, `centers`, `title`, `first_name`, `middle_name`, `last_name`, `doctor_id`, `userid`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `description`, `dob`, `contact_id`) VALUES (' doctor2  ', '1', '', 'doctor2', '', '', 2, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);


#
# TABLE STRUCTURE FOR: ck_view_email
#

DROP TABLE IF EXISTS `ck_view_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_email` AS select `ck_contact_details`.`contact_id` AS `contact_id`,group_concat(`ck_contact_details`.`detail` separator ',') AS `emails` from `ck_contact_details` where (`ck_contact_details`.`type` = 'email') group by `ck_contact_details`.`contact_id`;

latin1_swedish_ci;

#
# TABLE STRUCTURE FOR: ck_view_patient
#

DROP TABLE IF EXISTS `ck_view_patient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_patient` AS select `patient`.`ssn_id` AS `ssn_id`,`patient`.`is_inquiry` AS `is_inquiry`,`patient`.`inquiry_reason` AS `inquiry_reason`,`patient`.`sync_status` AS `sync_status`,`patient`.`is_deleted` AS `is_deleted`,`patient`.`erpnext_key` AS `erpnext_key`,`patient`.`patient_id` AS `patient_id`,`patient`.`clinic_id` AS `clinic_id`,`patient`.`blood_group` AS `blood_group`,`patient`.`clinic_code` AS `clinic_code`,`patient`.`patient_since` AS `patient_since`,`patient`.`age` AS `age`,`patient`.`display_id` AS `display_id`,`patient`.`gender` AS `gender`,`patient`.`dob` AS `dob`,`patient`.`reference_by` AS `reference_by`,`patient`.`reference_by_detail` AS `reference_by_detail`,`patient`.`followup_date` AS `followup_date`,((select ifnull(sum(ifnull(`patient_account`.`adjust_amount`,0)),0) from `ck_patient_account` `patient_account` where ((`patient_account`.`patient_id` = `patient`.`patient_id`) and (`patient_account`.`payment_id` is not null))) - (select ifnull(sum(ifnull(`patient_account`.`adjust_amount`,0)),0) from `ck_patient_account` `patient_account` where ((`patient_account`.`patient_id` = `patient`.`patient_id`) and (`patient_account`.`bill_id` is not null)))) AS `in_account_amount`,`contacts`.`display_name` AS `display_name`,`contacts`.`contact_id` AS `contact_id`,`contacts`.`title` AS `title`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,concat(convert(ifnull(`contacts`.`title`,'') using utf8),' ',ifnull(`contacts`.`first_name`,''),' ',ifnull(`contacts`.`middle_name`,''),' ',ifnull(`contacts`.`last_name`,'')) AS `patient_name`,(select `contact_details`.`detail` from `ck_contact_details` `contact_details` where ((`contact_details`.`contact_id` = `contacts`.`contact_id`) and (`contact_details`.`type` = 'mobile')) limit 1) AS `phone_number`,`contacts`.`email` AS `email` from (`ck_patient` `patient` left join `ck_contacts` `contacts` on((`patient`.`contact_id` = `contacts`.`contact_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_patient` (`ssn_id`, `is_inquiry`, `inquiry_reason`, `sync_status`, `is_deleted`, `erpnext_key`, `patient_id`, `clinic_id`, `blood_group`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `reference_by_detail`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `patient_name`, `phone_number`, `email`) VALUES (NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2019-05-13', NULL, '00001', NULL, NULL, NULL, NULL, '0000-00-00', '-5.00', NULL, 3, NULL, 'nishi', NULL, NULL, ' nishi  ', '2569865896', NULL);
INSERT INTO `ck_view_patient` (`ssn_id`, `is_inquiry`, `inquiry_reason`, `sync_status`, `is_deleted`, `erpnext_key`, `patient_id`, `clinic_id`, `blood_group`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `reference_by_detail`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `patient_name`, `phone_number`, `email`) VALUES (NULL, NULL, NULL, 0, NULL, NULL, 2, NULL, NULL, NULL, '2019-05-13', NULL, '00002', 'female', '1996-05-08', NULL, '', '2019-05-28', '0.00', NULL, 4, NULL, 'manisha', NULL, NULL, ' manisha  ', '9865956856', NULL);
INSERT INTO `ck_view_patient` (`ssn_id`, `is_inquiry`, `inquiry_reason`, `sync_status`, `is_deleted`, `erpnext_key`, `patient_id`, `clinic_id`, `blood_group`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `reference_by_detail`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `patient_name`, `phone_number`, `email`) VALUES (NULL, NULL, NULL, 0, NULL, NULL, 3, NULL, NULL, NULL, '2019-05-13', NULL, '00003', 'female', NULL, NULL, '', '2019-05-28', '0.00', NULL, 5, NULL, 'zeni', NULL, NULL, ' zeni  ', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_view_payment
#

DROP TABLE IF EXISTS `ck_view_payment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_payment` AS select distinct `payment`.`payment_id` AS `payment_id`,`payment`.`clinic_id` AS `clinic_id`,`payment`.`pay_date` AS `pay_date`,`payment`.`pay_mode` AS `pay_mode`,`payment`.`payment_status` AS `payment_status`,`payment`.`additional_detail` AS `additional_detail`,`payment`.`pay_amount` AS `pay_amount`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name` from ((`ck_payment` `payment` join `ck_patient` `patient` on((`patient`.`patient_id` = `payment`.`patient_id`))) join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `payment_status`, `additional_detail`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES (1, NULL, '2019-05-13', 'Online Payment', 'pending', '25', '520', 1, '00001', 'nishi', NULL, NULL);
INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `payment_status`, `additional_detail`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES (2, NULL, '2019-05-13', 'Cash', 'complete', '', '150', 1, '00001', 'nishi', NULL, NULL);
INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `payment_status`, `additional_detail`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES (3, NULL, '2019-05-13', 'Cash', 'complete', '', '1295', 1, '00001', 'nishi', NULL, NULL);
INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `payment_status`, `additional_detail`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES (4, NULL, '2019-05-13', 'Cash', 'complete', '', '1800', 2, '00002', 'manisha', NULL, NULL);
INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `payment_status`, `additional_detail`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES (5, NULL, '2019-05-13', 'Cash', 'complete', '', '100', 3, '00003', 'zeni', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_view_report
#

DROP TABLE IF EXISTS `ck_view_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_report` AS select `appointment`.`appointment_id` AS `appointment_id`,`appointment`.`patient_id` AS `patient_id`,`appointment`.`clinic_code` AS `clinic_code`,concat(ifnull(`view_patient`.`first_name`,''),' ',ifnull(`view_patient`.`middle_name`,''),' ',convert(ifnull(`view_patient`.`last_name`,'') using utf8)) AS `patient_name`,`appointment`.`doctor_id` AS `doctor_id`,`appointment`.`clinic_id` AS `clinic_id`,`appointment`.`status` AS `status`,`clinic`.`clinic_name` AS `clinic_name`,concat(ifnull(`contacts`.`first_name`,''),' ',ifnull(`contacts`.`middle_name`,''),' ',convert(ifnull(`contacts`.`last_name`,'') using utf8)) AS `doctor_name`,`appointment`.`appointment_date` AS `appointment_date`,min(`appointment`.`start_time`) AS `appointment_time`,max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end)) AS `waiting_in`,(max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)) - max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end))) AS `waiting_duration`,max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)) AS `consultation_in`,max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)) AS `consultation_out`,(max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)) - max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end))) AS `consultation_duration`,max((case `appointment_log`.`old_status` when 'Consultation' then timediff(`appointment_log`.`to_time`,`appointment_log`.`from_time`) end)) AS `waiting_out`,max(`bill`.`total_amount`) AS `collection_amount` from ((((((`ck_appointments` `appointment` left join `ck_view_patient` `view_patient` on((`appointment`.`patient_id` = `view_patient`.`patient_id`))) left join `ck_bill` `bill` on((`appointment`.`visit_id` = `bill`.`visit_id`))) left join `ck_appointment_log` `appointment_log` on((`appointment`.`appointment_id` = `appointment_log`.`appointment_id`))) left join `ck_doctor` `doctor` on((`doctor`.`doctor_id` = `appointment`.`doctor_id`))) left join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `doctor`.`contact_id`))) left join `ck_clinic` `clinic` on((`clinic`.`clinic_id` = `appointment`.`clinic_id`))) group by `appointment`.`appointment_id`,concat(ifnull(`view_patient`.`first_name`,''),' ',ifnull(`view_patient`.`middle_name`,''),' ',convert(ifnull(`view_patient`.`last_name`,'') using utf8));

latin1_swedish_ci;

INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `clinic_code`, `patient_name`, `doctor_id`, `clinic_id`, `status`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES (1, 1, NULL, 'nishi  ', 1, NULL, 'Complete', NULL, 'Doctor1  ', '2019-05-13', '10:00:00', NULL, NULL, NULL, '07:24:54', NULL, NULL, NULL);
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `clinic_code`, `patient_name`, `doctor_id`, `clinic_id`, `status`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES (2, 2, NULL, 'manisha  ', 2, NULL, 'Complete', NULL, 'doctor2  ', '2019-05-13', '11:00:00', NULL, NULL, '07:26:25', '07:28:22', '197', '-07:28:22', '600.00');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `clinic_code`, `patient_name`, `doctor_id`, `clinic_id`, `status`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES (3, 3, NULL, 'zeni  ', 1, NULL, 'Complete', NULL, 'Doctor1  ', '2019-05-13', '10:30:00', '07:31:54', '62', '07:32:16', '07:33:19', '103', '-07:33:19', '100.00');


#
# TABLE STRUCTURE FOR: ck_view_tax_report
#

DROP TABLE IF EXISTS `ck_view_tax_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_tax_report` AS select `patient`.`display_id` AS `display_id`,`patient`.`first_name` AS `first_name`,`patient`.`middle_name` AS `middle_name`,`patient`.`last_name` AS `last_name`,`bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,(select sum(ifnull(`bill_detail_tax`.`amount`,0)) from `ck_bill_detail` `bill_detail_tax` where ((`bill_detail_tax`.`bill_id` = `bill`.`bill_id`) and (ifnull(`bill_detail_tax`.`tax_amount`,0) > 0))) AS `taxable_amount`,(select sum(ifnull(`bill_detail_non`.`amount`,0)) from `ck_bill_detail` `bill_detail_non` where ((`bill_detail_non`.`bill_id` = `bill`.`bill_id`) and (ifnull(`bill_detail_non`.`tax_amount`,0) = 0) and (`bill_detail_non`.`type` <> 'discount'))) AS `non_taxable_amount`,(select sum(ifnull(`bill_detail_discount`.`amount`,0)) from `ck_bill_detail` `bill_detail_discount` where ((`bill_detail_discount`.`bill_id` = `bill`.`bill_id`) and (`bill_detail_discount`.`type` = 'discount'))) AS `discount`,`bill`.`tax_amount` AS `item_tax_amount`,`bill`.`total_amount` AS `total_amount` from (`ck_bill` `bill` join `ck_view_patient` `patient` on((`patient`.`patient_id` = `bill`.`patient_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00001', 'nishi', NULL, NULL, 1, '2019-05-13', NULL, '735.00', '5.00', NULL, '705.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00001', 'nishi', NULL, NULL, 2, '2019-05-13', NULL, NULL, NULL, '0.00', '0.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00001', 'nishi', NULL, NULL, 3, '2019-05-13', NULL, NULL, NULL, '0.00', '0.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00001', 'nishi', NULL, NULL, 4, '2019-05-13', NULL, '100.00', NULL, NULL, '100.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00001', 'nishi', NULL, NULL, 5, '2019-05-13', NULL, '100.00', NULL, NULL, '100.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00002', 'manisha', NULL, NULL, 6, '2019-05-13', NULL, '600.00', NULL, NULL, '600.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00002', 'manisha', NULL, NULL, 7, '2019-05-13', NULL, NULL, NULL, '0.00', '0.00');
INSERT INTO `ck_view_tax_report` (`display_id`, `first_name`, `middle_name`, `last_name`, `bill_id`, `bill_date`, `taxable_amount`, `non_taxable_amount`, `discount`, `item_tax_amount`, `total_amount`) VALUES ('00003', 'zeni', NULL, NULL, 8, '2019-05-13', NULL, '100.00', NULL, NULL, '100.00');


#
# TABLE STRUCTURE FOR: ck_view_visit
#

DROP TABLE IF EXISTS `ck_view_visit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_visit` AS select `visit`.`visit_id` AS `visit_id`,`visit`.`visit_date` AS `visit_date`,`visit`.`visit_time` AS `visit_time`,`visit`.`type` AS `type`,`visit`.`notes` AS `notes`,`visit`.`patient_notes` AS `patient_notes`,`visit`.`doctor_id` AS `doctor_id`,`doctor`.`name` AS `name`,`visit`.`patient_id` AS `patient_id`,`patient`.`reference_by` AS `reference_by`,`patient`.`reference_by_detail` AS `reference_by_detail`,`bill`.`bill_id` AS `bill_id`,`bill`.`total_amount` AS `total_amount`,(select ifnull(sum(ifnull(`bill_detail`.`amount`,0)),0) from `ck_bill_detail` `bill_detail` where ((`bill_detail`.`bill_id` = `bill`.`bill_id`) and (`bill_detail`.`type` = 'tax'))) AS `bill_tax_amount`,(select sum(`item_bill_detail`.`tax_amount`) from `ck_bill_detail` `item_bill_detail` where (`item_bill_detail`.`bill_id` = `bill`.`bill_id`)) AS `item_tax_amount`,`bill`.`due_amount` AS `due_amount` from (((`ck_visit` `visit` join `ck_view_doctor` `doctor` on((`doctor`.`doctor_id` = `visit`.`doctor_id`))) join `ck_patient` `patient` on((`patient`.`patient_id` = `visit`.`patient_id`))) join `ck_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) order by `visit`.`patient_id`,`visit`.`visit_date`,`visit`.`visit_time`;

latin1_swedish_ci;

INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (2, '2019-05-13', '07:03', 'Established Patient', 'Test1', NULL, 1, ' Doctor1  ', 1, NULL, NULL, 3, '0.00', '0.00', NULL, '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (1, '2019-05-13', '10:00:00', 'New Visit', 'test', '', 1, ' Doctor1  ', 1, NULL, NULL, 1, '705.00', '35.00', NULL, '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (1, '2019-05-13', '10:00:00', 'New Visit', 'test', '', 1, ' Doctor1  ', 1, NULL, NULL, 2, '0.00', '0.00', NULL, '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (3, '2019-05-13', '11:00', 'New Visit', '', NULL, 2, ' doctor2  ', 2, NULL, '', 6, '600.00', '0.00', NULL, '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (3, '2019-05-13', '11:00', 'New Visit', '', NULL, 2, ' doctor2  ', 2, NULL, '', 7, '0.00', '0.00', NULL, '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `reference_by`, `reference_by_detail`, `bill_id`, `total_amount`, `bill_tax_amount`, `item_tax_amount`, `due_amount`) VALUES (4, '2019-05-13', '07:32', 'New Visit', '', NULL, 1, ' Doctor1  ', 3, NULL, '', 8, '100.00', '0.00', NULL, '0.00');


#
# TABLE STRUCTURE FOR: ck_view_visit_treatments
#

DROP TABLE IF EXISTS `ck_view_visit_treatments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_visit_treatments` AS select `visit`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`type` AS `type` from ((`ck_visit` `visit` left join `ck_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) left join `ck_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (1, 'bill', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (1, 'No Tax ( 5.00% )', 'tax');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (1, 'bill', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (1, 'Discount', 'discount');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (3, 'bill', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (4, 'bill', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (1, NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (2, NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES (3, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_visit
#

DROP TABLE IF EXISTS `ck_visit`;

CREATE TABLE `ck_visit` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `notes` text,
  `type` varchar(50) NOT NULL,
  `visit_date` varchar(60) NOT NULL,
  `clinic_id` int(1) DEFAULT NULL,
  `visit_time` varchar(50) DEFAULT NULL,
  `patient_notes` text,
  `appointment_reason` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `clinic_id`, `visit_time`, `patient_notes`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (1, 1, 2, 1, 'test', 'New Visit', '2019-05-13', NULL, '10:00:00', '', 'Fever', NULL, 0, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `clinic_id`, `visit_time`, `patient_notes`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (2, 1, 2, 1, 'Test1', 'Established Patient', '2019-05-13', NULL, '07:03', NULL, 'Test1', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `clinic_id`, `visit_time`, `patient_notes`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (3, 2, 3, 2, '', 'New Visit', '2019-05-13', NULL, '11:00', NULL, 'Fever', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `clinic_id`, `visit_time`, `patient_notes`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES (4, 3, 2, 1, '', 'New Visit', '2019-05-13', NULL, '07:32', NULL, '', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_working_days
#

DROP TABLE IF EXISTS `ck_working_days`;

CREATE TABLE `ck_working_days` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `working_date` date NOT NULL,
  `working_status` varchar(15) NOT NULL,
  `working_reason` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

