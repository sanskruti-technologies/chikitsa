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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', '1', '11/05/2018 15:57:56', '03:57:00', '15:57:56', '00:00:00', ' ', 'Appointment', 'System Administrator', '', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', '2', '11/05/2018 15:58:31', '09:30:00', '15:58:31', '00:00:00', ' ', 'Appointment', 'System Administrator', '', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', '3', '14/05/2018 11:57:11', '09:30:00', '11:57:11', '00:00:00', ' ', 'Appointment', 'System Administrator', '', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', '4', '17/05/2018 10:16:27', '09:00:00', '10:16:27', '16:17:00', ' ', 'Appointment', 'System Administrator', '', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('5', '5', '2018-05-17 10:38:00', '00:00:00', '10:38:00', '00:00:00', '', 'Consultation', 'System Administrator', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('6', '6', '2018-05-17 11:32:00', '00:00:00', '11:32:00', '12:41:49', '', 'Consultation', 'System Administrator', NULL, NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('7', '6', '17/05/2018 12:41:49', '11:32:00', '12:41:49', '00:00:00', 'Consultation', 'Complete', 'System Administrator', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('8', '4', '17/05/2018 16:17:00', '09:00:00', '16:17:00', '16:18:11', 'Appointments', 'Appointments', 'System Administrator', '', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('9', '4', '17/05/2018 16:18:11', '09:00:00', '16:18:11', '16:23:54', 'Appointments', 'Consultation', 'System Administrator', '', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('10', '4', '17/05/2018 16:23:54', '09:00:00', '16:23:54', '00:00:00', 'Consultation', 'Complete', 'System Administrator', '', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('11', '7', '17/05/2018 16:52:48', '04:51:00', '16:52:48', '16:52:58', ' ', 'Appointment', 'System Administrator', 'head pain', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('12', '7', '17/05/2018 16:52:58', '16:51:00', '16:52:58', '16:54:19', 'Appointments', 'Waiting', 'System Administrator', 'head pain', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('13', '7', '17/05/2018 16:54:19', '16:51:00', '16:54:19', '16:56:04', 'Waiting', 'Consultation', 'System Administrator', 'head pain', NULL, '0', NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('14', '7', '17/05/2018 16:56:04', '16:51:00', '16:56:04', '00:00:00', 'Consultation', 'Complete', 'System Administrator', 'head pain', NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('15', '8', '2018-05-17 17:04:00', '00:00:00', '17:04:00', '00:00:00', '', 'Consultation', 'System Administrator', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointment_log` (`appointment_log_id`, `appointment_id`, `change_date_time`, `start_time`, `from_time`, `to_time`, `old_status`, `status`, `name`, `appointment_reason`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('16', '9', '2018-05-17 17:07:00', '00:00:00', '17:07:00', '00:00:00', '', 'Consultation', 'System Administrator', NULL, NULL, NULL, NULL);


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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', '2018-05-11', NULL, '15:57:00', '21:57:00', 'Yashvi  Shah', '5', '2', '1', 'Appointments', '0', '', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', '2018-05-11', NULL, '09:30:00', '15:30:00', 'Dhara  Shah', '4', '2', '1', 'Appointments', '0', '', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', '2018-05-14', NULL, '09:30:00', '15:30:00', 'Dhara  Shah', '4', '2', '1', 'Appointments', '0', '', NULL, NULL, NULL, NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', '2018-05-17', NULL, '09:00:00', '09:30:00', 'Dhara Shah', '4', '2', '1', 'Complete', '8', '', NULL, NULL, '0', NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('5', '2018-05-17', NULL, '10:38:00', '00:00:00', 'Manoj Dhanraj patil', '7', '0', '1', 'Consultation', '6', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('6', '2018-05-17', NULL, '11:32:00', '09:11:49', 'Devang  Bhandari', '9', '0', '1', 'Complete', '7', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('7', '2018-05-17', NULL, '16:51:00', '17:21:00', 'mitul M surati', '11', '2', '1', 'Complete', '9', 'head pain', NULL, NULL, '0', NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('8', '2018-05-17', NULL, '17:04:00', '00:00:00', 'Devang  Bhandari', '9', '0', '1', 'Consultation', '10', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `doctor_id`, `status`, `visit_id`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('9', '2018-05-17', NULL, '17:07:00', '00:00:00', 'Nirav  Jariwala', '8', '0', '2', 'Consultation', '11', NULL, NULL, NULL, '0', NULL);


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
  `total_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `due_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', NULL, NULL, '2018-05-17', '10:26:09', '4', '4', '0', '0.00', NULL, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', NULL, NULL, '2018-05-17', '10:26:55', '4', '5', '0', '0.00', NULL, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', NULL, NULL, '2018-05-17', '10:39:10', '7', '6', '0', '0.00', NULL, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', NULL, NULL, '2018-05-17', '11:36:45', '9', '7', '1600', '1600.00', NULL, '0', NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('5', NULL, NULL, '2018-05-17', '16:21:05', '4', '8', '1500', '0.00', NULL, '0', NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('6', NULL, NULL, '2018-05-17', '16:55:25', '11', '9', '500', '0.00', NULL, '0', NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('7', NULL, NULL, '2018-05-17', '17:04:48', '9', '10', '0', '0.00', NULL, NULL, NULL);
INSERT INTO `ck_bill` (`bill_id`, `clinic_id`, `doctor_id`, `bill_date`, `bill_time`, `patient_id`, `visit_id`, `total_amount`, `due_amount`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('8', '1', NULL, '2018-05-17', '17:07:40', '8', '11', '0', '0.00', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_bill_detail
#

DROP TABLE IF EXISTS `ck_bill_detail`;

CREATE TABLE `ck_bill_detail` (
  `bill_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `particular` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `type` varchar(25) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`bill_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', NULL, '4', 'Test', '150.00', '1', '150.00', 'particular', NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', NULL, '4', 'Test', '150.00', '1', '150.00', 'particular', NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', NULL, '5', 'demno1', '1500.00', '1', '1500.00', 'particular', NULL, NULL, NULL, NULL);
INSERT INTO `ck_bill_detail` (`bill_detail_id`, `item_id`, `bill_id`, `particular`, `amount`, `quantity`, `mrp`, `type`, `purchase_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', NULL, '6', 'test', '500.00', '1', '500.00', 'particular', NULL, NULL, NULL, NULL);


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
  PRIMARY KEY (`bill_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_clinic
#

DROP TABLE IF EXISTS `ck_clinic`;

CREATE TABLE `ck_clinic` (
  `clinic_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `time_interval` decimal(11,2) NOT NULL DEFAULT '0.50',
  `clinic_name` varchar(50) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  `tag_line` varchar(100) DEFAULT NULL,
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

INSERT INTO `ck_clinic` (`clinic_id`, `start_time`, `end_time`, `time_interval`, `clinic_name`, `clinic_code`, `tag_line`, `clinic_address`, `landline`, `mobile`, `email`, `facebook`, `twitter`, `google_plus`, `next_followup_days`, `clinic_logo`, `max_patient`, `is_deleted`, `sync_status`, `website`) VALUES ('1', '09:00 AM', '06:00 PM', '120.00', 'Chikitsa', '', 'Patient Management Software', '', '', '', '', NULL, NULL, NULL, '15', NULL, '1', NULL, '0', '');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', '5', 'mobile', '9825115863', '1', NULL, NULL, NULL);
INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', '6', 'mobile', '9913938837', '1', NULL, NULL, NULL);
INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', '7', 'mobile', '2235468789', '1', NULL, NULL, NULL);
INSERT INTO `ck_contact_details` (`contact_detail_id`, `contact_id`, `type`, `detail`, `is_default`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', '8', 'mobile', '1234556789', '1', NULL, NULL, NULL);


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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', NULL, 'Dhara', NULL, 'Shah', NULL, NULL, NULL, NULL, '', 'Home', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', NULL, 'Yashvi', NULL, 'Shah', NULL, NULL, NULL, NULL, '', 'Home', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('3', '', 'kamal', '', 'prajapati', '', NULL, NULL, '', '', 'Home', '', '', '', '', '', '', '', NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', 'Mr. ', 'Manoj', 'Dhanraj', 'patil', 'manoj', NULL, NULL, 'manoj@gmail.com', 'profile_picture/.jpg', 'Home', '123,abc', 'xyz,', '', 'suart', 'gujarat', '394210', 'india', NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('5', '', 'Nirav', '', 'Jariwala', '', NULL, NULL, '', '', 'Home', '', '', '', '', '', '', '', NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('6', 'Mr', 'Devang', NULL, 'Bhandari', NULL, NULL, NULL, NULL, '', 'Home', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('7', 'MIss', 'Astha', 'R', 'Ramwala', NULL, NULL, NULL, NULL, '', 'Home', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('8', NULL, 'mitul', 'M', 'surati', NULL, NULL, NULL, 'mitul@sanskrutitech.in', 'images/Profile.png', NULL, '123', 'abc', '', 'surat', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_contacts` (`contact_id`, `title`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `second_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `area`, `city`, `state`, `postal_code`, `country`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('9', NULL, 'Dr. Dhaval', '', '', NULL, NULL, NULL, NULL, 'images/Profile.png', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);


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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('1', 'default_language', 'english', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('2', 'default_timezone', 'Asia/Kolkata', NULL, '0');
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('3', 'working_days', '1,2,3,4,5,6', NULL, '0');
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('4', 'copyright_text', '&copy; 2017 Sanskruti Technologies', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('5', 'copyright_url', 'http://sanskruti.net/ ', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('6', 'website_text', 'Chikitsa', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('7', 'software_name', 'Chikitsa', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('8', 'default_timeformate', 'h:i A', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('9', 'default_dateformate', 'd-m-Y', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('10', 'website_url', 'http://chikitsa.sanskruti.net/ ', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('11', 'support_text', 'Support Forum', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('12', 'support_url', 'http://sanskruti.net/chikitsa/support-2/', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('13', 'support_url', '<h4>Chikitsa would not have been possible without the amazing works listed below</h4><h5><b>Framework</b></h5><a href=\"http://codeigniter.com\">CodeIgniter 3.0.0</a><h5><b></b></h5><a href=\"https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc\">Modular Extensions - HMVC<h5><b></b></h5></a><h5><b>Theme</b></h5><a href=\"http://www.bootstrapzero.com/bootstrap-template/binary\">Binary Admin (Bootstrap v3.1.1)</a><h5><b></b></h5><a href=\"https://fortawesome.github.io/Font-Awesome/\">Font', NULL, NULL);
INSERT INTO `ck_data` (`ck_data_id`, `ck_key`, `ck_value`, `is_deleted`, `sync_status`) VALUES ('14', 'login_page', 'appointment/index', NULL, NULL);


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
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `ck_doctor` (`doctor_id`, `contact_id`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `userid`) VALUES ('1', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2');
INSERT INTO `ck_doctor` (`doctor_id`, `contact_id`, `degree`, `specification`, `experience`, `joining_date`, `licence_number`, `department_id`, `gender`, `userid`) VALUES ('2', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES ('1', '1', '4', '2018-06-01', NULL, '0');
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES ('2', '1', '7', '2018-06-01', NULL, NULL);
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES ('3', '1', '9', '2018-06-01', NULL, '0');
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES ('4', '1', '11', '2018-06-01', NULL, NULL);
INSERT INTO `ck_followup` (`id`, `doctor_id`, `patient_id`, `followup_date`, `is_deleted`, `sync_status`) VALUES ('5', '2', '8', '2018-06-01', NULL, NULL);


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

INSERT INTO `ck_invoice` (`invoice_id`, `static_prefix`, `left_pad`, `next_id`, `currency_symbol`, `currency_postfix`, `is_deleted`, `sync_status`) VALUES ('1', '', '3', '1', 'Rs.', '', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_medicines
#

DROP TABLE IF EXISTS `ck_medicines`;

CREATE TABLE `ck_medicines` (
  `medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(25) NOT NULL,
  PRIMARY KEY (`medicine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_menu_access
#

DROP TABLE IF EXISTS `ck_menu_access`;

CREATE TABLE `ck_menu_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `allow` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('1', 'bill report', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('2', 'patients', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('3', 'new_inquiry', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('4', 'all_patients', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('5', 'appointments', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('6', 'reports', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('7', 'all_patients', 'Receptionist', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('8', 'patients', 'Receptionist', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('9', 'appointments', 'Receptionist', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('10', 'new_inquiry', 'Receptionist', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('11', 'appointment report', 'Doctor', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('12', 'journal_voucher', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('13', 'cash_receipt', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('14', 'cash_payment', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('15', 'bank_receipt', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('16', 'bank_payment', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('17', 'cash_payment', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('18', 'patient_report', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('19', 'clinic_details', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('20', 'bill', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('21', 'menu_access', 'Administrator', '1');
INSERT INTO `ck_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES ('22', 'payments', 'Administrator', '1');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `ck_modules` (`module_id`, `module_name`, `module_display_name`, `module_description`, `module_status`, `module_version`, `activation_hook`, `license_key`, `license_status`, `required_modules`, `is_deleted`, `sync_status`) VALUES ('1', 'prescription', 'Prescription', 'Maintain and Print Prescription', '0', '0.0.3', NULL, NULL, 'inactive', NULL, NULL, '0');


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

INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('1', 'cash_payment', 'account', '400', 'account/cash_payment', NULL, 'cash_payment', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('2', 'journal_voucher', 'account', '600', 'account/journal_voucher', NULL, 'journal_voucher', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('3', 'cash_receipt', 'account', '500', 'account/cash_receipt', NULL, 'cash_receipt', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('4', 'reference_by', 'administration', '750', 'settings/reference_by', NULL, 'reference_by', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('5', 'backup', 'administration', '600', 'settings/backup', NULL, 'backup', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('6', 'new_patient', 'patients', '100', 'patient/insert', NULL, 'add_patient', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('7', 'all_users', 'users', '100', 'admin/users', NULL, 'all_users', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('8', 'patients', '', '200', '#', 'fa-users', 'patients', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('9', 'bank_receipt', 'account', '300', 'account/bank_receipt', NULL, 'bank_receipt', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('10', 'working_days', 'administration', '200', 'settings/working_days', NULL, 'working_days', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('11', 'general_settings', 'frontend', '400', 'frontend/general_settings', NULL, 'general_settings', 'frontend', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('12', 'bank_payment', 'account', '200', 'account/bank_payment', NULL, 'bank_payment', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('13', 'new_inquiry', 'patients', '200', 'patient/new_inquiry_report', NULL, 'new_inquiry', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('14', 'all_patients', 'patients', '0', 'patient/index', NULL, 'all_patients', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('15', 'appointments', '', '100', 'appointment/index', 'fa-calendar', 'appointments', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('16', 'reports', '', '400', '#', 'fa-line-chart', 'reports', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('17', 'modules', '', '600', 'module/index', 'fa-shopping-cart', 'modules', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('18', 'administration', '', '500', '#', 'fa-cog', 'administration', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('19', 'appointment_report', 'reports', '100', 'appointment/appointment_report', '', 'appointment_report', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('20', 'bill_report', 'reports', '300', 'patient/bill_detail_report', '', 'bill_report', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('21', 'clinic detail', 'administration', '100', 'settings/clinic', '', 'clinic_details', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('22', 'users', 'administration', '300', '#', '', 'users', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('23', 'setting', 'administration', '500', 'settings/change_settings', '', 'setting', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('24', 'payment', '', '300', '#', 'fa-money', 'bills_payments', '', NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('25', 'patient_report', 'reports', '90', 'patient/patient_report', NULL, 'patient_report', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('26', 'bill', 'payment', '100', 'bill/index', NULL, 'bills', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('27', 'payments', 'payment', '200', 'payment/index', NULL, 'payments', NULL, NULL, NULL);
INSERT INTO `ck_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`, `is_deleted`, `sync_status`) VALUES ('28', 'medicine', 'administration', '110', 'prescription/medicine', NULL, 'Medicine', 'prescription', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_patient
#

DROP TABLE IF EXISTS `ck_patient`;

CREATE TABLE `ck_patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `patient_since` date NOT NULL,
  `display_id` varchar(12) DEFAULT NULL,
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
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('4', '1', '2018-05-11', 'S00004', '2018-06-01', NULL, NULL, NULL, '0', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('5', '2', '2018-05-11', 'S00005', '0000-00-00', NULL, NULL, NULL, '0', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('6', '3', '2018-05-14', 'P00006', NULL, '', 'male', NULL, '0', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('7', '4', '2018-05-14', 'P00007', '2018-06-01', NULL, 'male', '1987-05-14', '31', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('8', '5', '2018-05-17', 'J00008', '2018-06-01', 'self', NULL, '1983-05-16', '35', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('9', '6', '2018-05-17', 'B00009', '2018-06-01', 'self', 'male', '1994-05-28', '23', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('10', '7', '2018-05-17', 'R00010', NULL, 'self', 'female', NULL, '0', NULL, NULL, NULL, '0', NULL);
INSERT INTO `ck_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`, `age`, `wp_user_id`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('11', '8', '2018-05-17', 'S00011', '2018-06-01', 'self', NULL, '1995-01-12', NULL, NULL, NULL, NULL, '0', NULL);


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
  PRIMARY KEY (`patient_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `cheque_no` varchar(50) DEFAULT NULL,
  `level` varchar(25) NOT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  `clinic_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `cheque_no`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('1', '4', '2018-05-17', 'cash', '1500', '', '', NULL, NULL, NULL, NULL);
INSERT INTO `ck_payment` (`payment_id`, `patient_id`, `pay_date`, `pay_mode`, `pay_amount`, `cheque_no`, `level`, `clinic_id`, `is_deleted`, `sync_status`, `clinic_code`) VALUES ('2', '11', '2018-05-17', 'cash', '500', '', '', NULL, NULL, NULL, NULL);


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
# TABLE STRUCTURE FOR: ck_prescription
#

DROP TABLE IF EXISTS `ck_prescription`;

CREATE TABLE `ck_prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `freq_morning` int(11) NOT NULL DEFAULT '0',
  `freq_afternoon` int(11) NOT NULL DEFAULT '0',
  `freq_night` int(11) NOT NULL DEFAULT '0',
  `for_days` int(11) NOT NULL,
  `instructions` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`prescription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ck_receipt_template
#

DROP TABLE IF EXISTS `ck_receipt_template`;

CREATE TABLE `ck_receipt_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template` text NOT NULL,
  `is_default` int(1) NOT NULL,
  `template_name` varchar(25) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES ('1', '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><h3 style=\"text-align: center;\"><u style=\"text-align: center;\">RECEIPT</u></h3><p><span style=\"text-align: left;\"><strong>Date : </strong>[bill_date] [bill_time]</span><span style=\"float: right;\"><strong>Receipt Number :</strong> [bill_id]</span></p><p style=\"text-align: left;\"><strong style=\"text-align: left;\">Patient Name: </strong><span style=\"text-align: left;\">[patient_name]<br /></span></p><hr id=\"null\" style=\"text-align: left;\" /><p>Received fees for Professional services and other charges of our:</p><p>&nbsp;</p><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr><td style=\"width: 400px; text-align: left; padding: 5px; border: 1px solid black;\"><strong style=\"width: 400px; text-align: left;\">Item</strong></td><td style=\"padding: 5px; border: 1px solid black;\"><strong>Quantity</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>M.R.P.</strong></td><td style=\"width: 100px; text-align: right; padding: 5px; border: 1px solid black;\"><strong>Amount</strong></td></tr></thead><tbody><tr><td colspan=\"4\">[col:particular|quantity|mrp|amount]</td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Discount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[discount]</strong></td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Total</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\"><strong>[total]</strong></td></tr><tr><td style=\"padding: 5px; border: 1px solid black;\" colspan=\"3\">Paid Amount</td><td style=\"text-align: right; padding: 5px; border: 1px solid black;\">[paid_amount]</td></tr></tbody></table><p>Received with Thanks,</p><p>For [clinic_name]</p><p>&nbsp;</p><p>&nbsp;</p><p>Signature</p>', '1', 'Main', 'bill', NULL, NULL);
INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES ('2', '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><p><span style=\"text-align: left;\"><strong>Date : </strong>[visit_date] </span><span style=\"float: right;\"><strong style=\"text-align: left;\">Patient ID: </strong>[patient_id]<br /><strong style=\"text-align: left;\">Patient Name: </strong>[patient_name]<br /><strong style=\"text-align: left;\">Age / Sex: </strong>[age] | [sex]</span></p><h1>Rx</h1><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr style=\"height: 28px;\"><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Medicine Name</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Dosage</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Quantity</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Instructions</strong></td></tr><tr style=\"height: 0px;\"><td style=\"height: 0px;\" colspan=\"4\"><strong>[col:medicine_name|dosage|quantity|instructions]</strong></td></tr></thead></table><p><strong>Notes&nbsp;</strong><br /> [patient_notes]</p><p>&nbsp;</p><p>[doctor_name]</p>', '1', 'Main', 'prescription', NULL, NULL);
INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES ('3', '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><p><span style=\"text-align: left;\"><strong>Date : </strong>[visit_date] </span><span style=\"float: right;\"><strong style=\"text-align: left;\">Patient ID: </strong>[patient_id]<br /><strong style=\"text-align: left;\">Patient Name: </strong>[patient_name]<br /><strong style=\"text-align: left;\">Age / Sex: </strong>[age] | [sex]</span></p><h1>Rx</h1><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr style=\"height: 28px;\"><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Medicine Name</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Dosage</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Quantity</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Instructions</strong></td></tr><tr style=\"height: 0px;\"><td style=\"height: 0px;\" colspan=\"4\"><strong>[col:medicine_name|dosage|quantity|instructions]</strong></td></tr></thead></table><p><strong>Notes&nbsp;</strong><br /> [patient_notes]</p><p>&nbsp;</p><p>[doctor_name]</p>', '1', 'Main', 'prescription', NULL, NULL);
INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES ('4', '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><p><span style=\"text-align: left;\"><strong>Date : </strong>[visit_date] </span><span style=\"float: right;\"><strong style=\"text-align: left;\">Patient ID: </strong>[patient_id]<br /><strong style=\"text-align: left;\">Patient Name: </strong>[patient_name]<br /><strong style=\"text-align: left;\">Age / Sex: </strong>[age] | [sex]</span></p><h1>Rx</h1><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr style=\"height: 28px;\"><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Medicine Name</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Dosage</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Quantity</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Instructions</strong></td></tr><tr style=\"height: 0px;\"><td style=\"height: 0px;\" colspan=\"4\"><strong>[col:medicine_name|dosage|quantity|instructions]</strong></td></tr></thead></table><p><strong>Notes&nbsp;</strong><br /> [patient_notes]</p><p>&nbsp;</p><p>[doctor_name]</p>', '1', 'Main', 'prescription', NULL, NULL);
INSERT INTO `ck_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`, `is_deleted`, `sync_status`) VALUES ('5', '<h1 style=\"text-align: center;\">[clinic_name]</h1><h2 style=\"text-align: center;\">[tag_line]</h2><p style=\"text-align: center;\">[clinic_address]</p><p style=\"text-align: center;\"><strong style=\"line-height: 1.42857143;\">Landline : </strong><span style=\"line-height: 1.42857143;\">[landline]</span> <strong style=\"line-height: 1.42857143;\">Mobile : </strong><span style=\"line-height: 1.42857143;\">[mobile]</span> <strong style=\"line-height: 1.42857143;\">Email : </strong><span style=\"text-align: center;\"> [email]</span></p><hr id=\"null\" /><p><span style=\"text-align: left;\"><strong>Date : </strong>[visit_date] </span><span style=\"float: right;\"><strong style=\"text-align: left;\">Patient ID: </strong>[patient_id]<br /><strong style=\"text-align: left;\">Patient Name: </strong>[patient_name]<br /><strong style=\"text-align: left;\">Age / Sex: </strong>[age] | [sex]</span></p><h1>Rx</h1><p>&nbsp;</p><table style=\"width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;\"><thead><tr style=\"height: 28px;\"><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Medicine Name</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Dosage</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Quantity</strong></td><td style=\"padding: 5px; border: 1px solid black; height: 28px;\"><strong>Instructions</strong></td></tr><tr style=\"height: 0px;\"><td style=\"height: 0px;\" colspan=\"4\"><strong>[col:medicine_name|dosage|quantity|instructions]</strong></td></tr></thead></table><p><strong>Notes&nbsp;</strong><br /> [patient_notes]</p><p>&nbsp;</p><p>[doctor_name]</p>', '1', 'Main', 'prescription', NULL, NULL);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ck_reference_by` (`reference_id`, `reference_option`, `reference_add_option`, `placeholder`, `is_deleted`, `sync_status`) VALUES ('1', 'self', NULL, '', NULL, '0');


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES ('1', 'System Administrator', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES ('2', 'Doctor', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES ('3', 'Receptionist', NULL, NULL);
INSERT INTO `ck_user_categories` (`id`, `category_name`, `is_deleted`, `sync_status`) VALUES ('4', 'Administrator', NULL, NULL);


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

INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES ('1', 'System Administrator', 'admin', 'YWRtaW4=', 'System Administrator', '1', NULL, NULL, NULL, NULL);
INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES ('2', 'Dr. Mahesh Shah', 'mahesh', 'bWFoZXNo', 'Doctor', '1', NULL, '1', NULL, NULL);
INSERT INTO `ck_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`, `centers`, `is_deleted`, `sync_status`) VALUES ('3', 'Dr. Dhaval', 'Dhaval', 'ZGhhdmFs', 'Doctor', '1', NULL, '1', NULL, NULL);


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

INSERT INTO `ck_version` (`id`, `current_version`, `is_deleted`, `sync_status`) VALUES ('1', '0.6.3', NULL, NULL);


#
# TABLE STRUCTURE FOR: ck_view_bill
#

DROP TABLE IF EXISTS `ck_view_bill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill` AS select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`doctor`.`name` AS `doctor_name`,`visit`.`doctor_id` AS `doctor_id`,`bill`.`clinic_id` AS `clinic_id`,`clinic`.`clinic_name` AS `clinic_name`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,`bill`.`total_amount` AS `total_amount`,`bill`.`due_amount` AS `due_amount`,sum(`bill_payment_r`.`adjust_amount`) AS `pay_amount` from (((((((`ck_bill` `bill` join `ck_patient` `patient` on((`bill`.`patient_id` = `patient`.`patient_id`))) join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`))) left join `ck_visit` `visit` on((`bill`.`visit_id` = `visit`.`visit_id`))) left join `ck_clinic` `clinic` on((`clinic`.`clinic_id` = `bill`.`clinic_id`))) left join `ck_view_doctor` `doctor` on(((`visit`.`doctor_id` = `doctor`.`doctor_id`) or (`bill`.`doctor_id` = `doctor`.`doctor_id`)))) left join `ck_bill_payment_r` `bill_payment_r` on((`bill_payment_r`.`bill_id` = `bill`.`bill_id`))) left join `ck_payment` `payment` on((`payment`.`payment_id` = `bill_payment_r`.`payment_id`))) group by `bill`.`bill_id`,`doctor`.`name`,`visit`.`userid`,`patient`.`patient_id`;

latin1_swedish_ci;

INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('1', '2018-05-17', '4', 'Yashvi  Shah', '1', NULL, NULL, '4', 'S00004', 'Dhara', NULL, 'Shah', '0', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('2', '2018-05-17', '5', 'Yashvi  Shah', '1', NULL, NULL, '4', 'S00004', 'Dhara', NULL, 'Shah', '0', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('3', '2018-05-17', '6', 'Yashvi  Shah', '1', NULL, NULL, '7', 'P00007', 'Manoj', 'Dhanraj', 'patil', '0', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('4', '2018-05-17', '7', 'Yashvi  Shah', '1', NULL, NULL, '9', 'B00009', 'Devang', NULL, 'Bhandari', '1600', '1600.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('5', '2018-05-17', '8', 'Yashvi  Shah', '1', NULL, NULL, '4', 'S00004', 'Dhara', NULL, 'Shah', '1500', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('6', '2018-05-17', '9', 'Yashvi  Shah', '1', NULL, NULL, '11', 'S00011', 'mitul', 'M', 'surati', '500', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('7', '2018-05-17', '10', 'Yashvi  Shah', '1', NULL, NULL, '9', 'B00009', 'Devang', NULL, 'Bhandari', '0', '0.00', NULL);
INSERT INTO `ck_view_bill` (`bill_id`, `bill_date`, `visit_id`, `doctor_name`, `doctor_id`, `clinic_id`, `clinic_name`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`, `total_amount`, `due_amount`, `pay_amount`) VALUES ('8', '2018-05-17', '11', 'Dr. Dhaval  ', '2', '1', 'Chikitsa', '8', 'J00008', 'Nirav', '', 'Jariwala', '0', '0.00', NULL);


#
# TABLE STRUCTURE FOR: ck_view_bill_detail_report
#

DROP TABLE IF EXISTS `ck_view_bill_detail_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill_detail_report` AS select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`amount` AS `amount`,`visit`.`userid` AS `userid`,concat(`view_patient`.`first_name`,' ',`view_patient`.`middle_name`,' ',convert(`view_patient`.`last_name` using utf8)) AS `patient_name`,`view_patient`.`display_id` AS `display_id`,`bill_detail`.`type` AS `type` from (((`ck_bill` `bill` left join `ck_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`))) left join `ck_visit` `visit` on((`visit`.`visit_id` = `bill`.`visit_id`))) left join `ck_view_patient` `view_patient` on((`view_patient`.`patient_id` = `bill`.`patient_id`))) where (ifnull(`bill_detail`.`is_deleted`,0) <> 1);

latin1_swedish_ci;

INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('5', '2018-05-17', '8', 'demno1', '1500.00', '2', NULL, 'S00004', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('1', '2018-05-17', '4', NULL, NULL, '2', NULL, 'S00004', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('2', '2018-05-17', '5', NULL, NULL, '2', NULL, 'S00004', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('3', '2018-05-17', '6', NULL, NULL, '2', 'Manoj Dhanraj patil', 'P00007', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('8', '2018-05-17', '11', NULL, NULL, '3', 'Nirav  Jariwala', 'J00008', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('4', '2018-05-17', '7', 'Test', '150.00', '2', NULL, 'B00009', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('4', '2018-05-17', '7', 'Test', '150.00', '2', NULL, 'B00009', 'particular');
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('7', '2018-05-17', '10', NULL, NULL, '2', NULL, 'B00009', NULL);
INSERT INTO `ck_view_bill_detail_report` (`bill_id`, `bill_date`, `visit_id`, `particular`, `amount`, `userid`, `patient_name`, `display_id`, `type`) VALUES ('6', '2018-05-17', '9', 'test', '500.00', '2', 'mitul M surati', 'S00011', 'particular');


#
# TABLE STRUCTURE FOR: ck_view_bill_payment_r
#

DROP TABLE IF EXISTS `ck_view_bill_payment_r`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_bill_payment_r` AS select `payment`.`pay_date` AS `pay_date`,`bill_payment_r`.`bill_id` AS `bill_id`,`bill_payment_r`.`adjust_amount` AS `adjust_amount`,`payment`.`payment_id` AS `payment_id` from (`ck_payment` `payment` join `ck_bill_payment_r` `bill_payment_r` on((`bill_payment_r`.`payment_id` = `payment`.`payment_id`)));

latin1_swedish_ci;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_doctor` AS select `doctor`.`contact_id` AS `contact_id`,concat(ifnull(`contacts`.`first_name`,''),' ',ifnull(`contacts`.`middle_name`,''),' ',convert(ifnull(`contacts`.`last_name`,'') using utf8)) AS `name`,`doctor`.`doctor_id` AS `doctor_id`,`doctor`.`userid` AS `userid`,`users`.`centers` AS `centers` from ((`ck_doctor` `doctor` join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `doctor`.`contact_id`))) join `ck_users` `users` on((`users`.`userid` = `doctor`.`userid`)));

latin1_swedish_ci;

INSERT INTO `ck_view_doctor` (`contact_id`, `name`, `doctor_id`, `userid`, `centers`) VALUES ('2', 'Yashvi  Shah', '1', '2', '1');
INSERT INTO `ck_view_doctor` (`contact_id`, `name`, `doctor_id`, `userid`, `centers`) VALUES ('9', 'Dr. Dhaval  ', '2', '3', '1');


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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_patient` AS select `patient`.`patient_id` AS `patient_id`,`patient`.`clinic_id` AS `clinic_id`,`patient`.`clinic_code` AS `clinic_code`,`patient`.`patient_since` AS `patient_since`,`patient`.`age` AS `age`,`patient`.`display_id` AS `display_id`,`patient`.`gender` AS `gender`,`patient`.`dob` AS `dob`,`patient`.`reference_by` AS `reference_by`,`patient`.`followup_date` AS `followup_date`,((select ifnull(sum(ifnull(`patient_account`.`adjust_amount`,0)),0) from `ck_patient_account` `patient_account` where ((`patient_account`.`patient_id` = `patient`.`patient_id`) and (`patient_account`.`payment_id` is not null))) - (select ifnull(sum(ifnull(`patient_account`.`adjust_amount`,0)),0) from `ck_patient_account` `patient_account` where ((`patient_account`.`patient_id` = `patient`.`patient_id`) and (`patient_account`.`bill_id` is not null)))) AS `in_account_amount`,`contacts`.`display_name` AS `display_name`,`contacts`.`contact_id` AS `contact_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,(select `contact_details`.`detail` from `ck_contact_details` `contact_details` where ((`contact_details`.`contact_id` = `contacts`.`contact_id`) and (`contact_details`.`type` = 'mobile')) limit 1) AS `phone_number`,`contacts`.`email` AS `email` from (`ck_patient` `patient` left join `ck_contacts` `contacts` on((`patient`.`contact_id` = `contacts`.`contact_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('4', NULL, NULL, '2018-05-11', '0', 'S00004', NULL, NULL, NULL, '2018-06-01', '0.00', NULL, '1', 'Dhara', NULL, 'Shah', NULL, NULL);
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('5', NULL, NULL, '2018-05-11', '0', 'S00005', NULL, NULL, NULL, '0000-00-00', '0.00', NULL, '2', 'Yashvi', NULL, 'Shah', NULL, NULL);
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('6', NULL, NULL, '2018-05-14', '0', 'P00006', 'male', NULL, '', NULL, '0.00', '', '3', 'kamal', '', 'prajapati', NULL, '');
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('7', NULL, NULL, '2018-05-14', '31', 'P00007', 'male', '1987-05-14', NULL, '2018-06-01', '0.00', 'manoj', '4', 'Manoj', 'Dhanraj', 'patil', NULL, 'manoj@gmail.com');
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('8', NULL, NULL, '2018-05-17', '35', 'J00008', NULL, '1983-05-16', 'self', '2018-06-01', '0.00', '', '5', 'Nirav', '', 'Jariwala', '9825115863', '');
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('9', NULL, NULL, '2018-05-17', '23', 'B00009', 'male', '1994-05-28', 'self', '2018-06-01', '0.00', NULL, '6', 'Devang', NULL, 'Bhandari', '9913938837', NULL);
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('10', NULL, NULL, '2018-05-17', '0', 'R00010', 'female', NULL, 'self', NULL, '0.00', NULL, '7', 'Astha', 'R', 'Ramwala', '2235468789', NULL);
INSERT INTO `ck_view_patient` (`patient_id`, `clinic_id`, `clinic_code`, `patient_since`, `age`, `display_id`, `gender`, `dob`, `reference_by`, `followup_date`, `in_account_amount`, `display_name`, `contact_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `email`) VALUES ('11', NULL, NULL, '2018-05-17', NULL, 'S00011', NULL, '1995-01-12', 'self', '2018-06-01', '0.00', NULL, '8', 'mitul', 'M', 'surati', '1234556789', 'mitul@sanskrutitech.in');


#
# TABLE STRUCTURE FOR: ck_view_payment
#

DROP TABLE IF EXISTS `ck_view_payment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_payment` AS select distinct `payment`.`payment_id` AS `payment_id`,`payment`.`clinic_id` AS `clinic_id`,`payment`.`pay_date` AS `pay_date`,`payment`.`pay_mode` AS `pay_mode`,`payment`.`cheque_no` AS `cheque_no`,`payment`.`pay_amount` AS `pay_amount`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name` from ((`ck_payment` `payment` join `ck_patient` `patient` on((`patient`.`patient_id` = `payment`.`patient_id`))) join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `cheque_no`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES ('1', NULL, '2018-05-17', 'cash', '', '1500', '4', 'S00004', 'Dhara', NULL, 'Shah');
INSERT INTO `ck_view_payment` (`payment_id`, `clinic_id`, `pay_date`, `pay_mode`, `cheque_no`, `pay_amount`, `patient_id`, `display_id`, `first_name`, `middle_name`, `last_name`) VALUES ('2', NULL, '2018-05-17', 'cash', '', '500', '11', 'S00011', 'mitul', 'M', 'surati');


#
# TABLE STRUCTURE FOR: ck_view_report
#

DROP TABLE IF EXISTS `ck_view_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_report` AS select `appointment`.`appointment_id` AS `appointment_id`,`appointment`.`patient_id` AS `patient_id`,concat(ifnull(`view_patient`.`first_name`,''),' ',ifnull(`view_patient`.`middle_name`,''),' ',convert(ifnull(`view_patient`.`last_name`,'') using utf8)) AS `patient_name`,`appointment`.`doctor_id` AS `doctor_id`,`appointment`.`clinic_id` AS `clinic_id`,`clinic`.`clinic_name` AS `clinic_name`,concat(ifnull(`contacts`.`first_name`,''),' ',ifnull(`contacts`.`middle_name`,''),' ',convert(ifnull(`contacts`.`last_name`,'') using utf8)) AS `doctor_name`,`appointment`.`appointment_date` AS `appointment_date`,min(`appointment`.`start_time`) AS `appointment_time`,max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end)) AS `waiting_in`,(max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)) - max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end))) AS `waiting_duration`,max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)) AS `consultation_in`,max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)) AS `consultation_out`,(max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)) - max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end))) AS `consultation_duration`,max((case `appointment_log`.`old_status` when 'Consultation' then timediff(`appointment_log`.`to_time`,`appointment_log`.`from_time`) end)) AS `waiting_out`,max(`bill`.`total_amount`) AS `collection_amount` from ((((((`ck_appointments` `appointment` left join `ck_view_patient` `view_patient` on((`appointment`.`patient_id` = `view_patient`.`patient_id`))) left join `ck_bill` `bill` on((`appointment`.`visit_id` = `bill`.`visit_id`))) left join `ck_appointment_log` `appointment_log` on((`appointment`.`appointment_id` = `appointment_log`.`appointment_id`))) left join `ck_doctor` `doctor` on((`doctor`.`doctor_id` = `appointment`.`doctor_id`))) left join `ck_contacts` `contacts` on((`contacts`.`contact_id` = `doctor`.`contact_id`))) left join `ck_clinic` `clinic` on((`clinic`.`clinic_id` = `appointment`.`clinic_id`))) group by `appointment`.`appointment_id`,`patient_name`;

latin1_swedish_ci;

INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('1', '5', 'Yashvi  Shah', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-11', '15:57:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('2', '4', 'Dhara  Shah', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-11', '09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('3', '4', 'Dhara  Shah', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-14', '09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('4', '4', 'Dhara  Shah', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-17', '09:00:00', NULL, NULL, '16:18:11', '16:23:54', '543', '-16:23:54', '1500');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('5', '7', 'Manoj Dhanraj patil', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-17', '10:38:00', NULL, NULL, '10:38:00', NULL, NULL, NULL, '0');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('6', '9', 'Devang  Bhandari', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-17', '11:32:00', NULL, NULL, '11:32:00', '12:41:49', '10949', '-12:41:49', '1600');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('7', '11', 'mitul M surati', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-17', '16:51:00', '16:52:58', '161', '16:54:19', '16:56:04', '185', '-16:56:04', '500');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('8', '9', 'Devang  Bhandari', '1', NULL, NULL, 'Yashvi  Shah', '2018-05-17', '17:04:00', NULL, NULL, '17:04:00', NULL, NULL, NULL, '0');
INSERT INTO `ck_view_report` (`appointment_id`, `patient_id`, `patient_name`, `doctor_id`, `clinic_id`, `clinic_name`, `doctor_name`, `appointment_date`, `appointment_time`, `waiting_in`, `waiting_duration`, `consultation_in`, `consultation_out`, `consultation_duration`, `waiting_out`, `collection_amount`) VALUES ('9', '8', 'Nirav  Jariwala', '2', NULL, NULL, 'Dr. Dhaval  ', '2018-05-17', '17:07:00', NULL, NULL, '17:07:00', NULL, NULL, NULL, '0');


#
# TABLE STRUCTURE FOR: ck_view_visit
#

DROP TABLE IF EXISTS `ck_view_visit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_visit` AS select `visit`.`visit_id` AS `visit_id`,`visit`.`visit_date` AS `visit_date`,`visit`.`visit_time` AS `visit_time`,`visit`.`type` AS `type`,`visit`.`notes` AS `notes`,`visit`.`patient_notes` AS `patient_notes`,`visit`.`doctor_id` AS `doctor_id`,`doctor`.`name` AS `name`,`visit`.`patient_id` AS `patient_id`,`bill`.`bill_id` AS `bill_id`,`bill`.`total_amount` AS `total_amount`,`bill`.`due_amount` AS `due_amount` from ((`ck_visit` `visit` join `ck_view_doctor` `doctor` on((`doctor`.`doctor_id` = `visit`.`doctor_id`))) join `ck_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) order by `visit`.`patient_id`,`visit`.`visit_date`,`visit`.`visit_time`;

latin1_swedish_ci;

INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('4', '2018-05-17', '10:20', 'New Visit', 'Test', 'Test', '1', 'Yashvi  Shah', '4', '1', '0', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('5', '2018-05-17', '10:20', 'New Visit', 'Test', 'Test', '1', 'Yashvi  Shah', '4', '2', '0', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('8', '2018-05-17', '16:20', 'Established Patient', 'test 2', 'test2', '1', 'Yashvi  Shah', '4', '5', '1500', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('6', '2018-05-17', '10:38', 'New Visit', 'Test', 'Test', '1', 'Yashvi  Shah', '7', '3', '0', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('11', '2018-05-17', '17:07', 'New Visit', 'Test', 'Test', '2', 'Dr. Dhaval  ', '8', '8', '0', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('7', '2018-05-17', '11:32', 'New Visit', 'test', 'twat', '1', 'Yashvi  Shah', '9', '4', '1600', '1600.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('10', '2018-05-17', '17:04', 'Established Patient', 'Test', 'Test', '1', 'Yashvi  Shah', '9', '7', '0', '0.00');
INSERT INTO `ck_view_visit` (`visit_id`, `visit_date`, `visit_time`, `type`, `notes`, `patient_notes`, `doctor_id`, `name`, `patient_id`, `bill_id`, `total_amount`, `due_amount`) VALUES ('9', '2018-05-17', '16:54', 'New Visit', 'test', 'test', '1', 'Yashvi  Shah', '11', '6', '500', '0.00');


#
# TABLE STRUCTURE FOR: ck_view_visit_treatments
#

DROP TABLE IF EXISTS `ck_view_visit_treatments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ck_view_visit_treatments` AS select `visit`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`type` AS `type` from ((`ck_visit` `visit` left join `ck_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) left join `ck_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`)));

latin1_swedish_ci;

INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('7', 'Test', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('7', 'Test', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('8', 'demno1', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('9', 'test', 'particular');
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('4', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('5', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('6', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('10', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('11', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('1', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('2', NULL, NULL);
INSERT INTO `ck_view_visit_treatments` (`visit_id`, `particular`, `type`) VALUES ('3', NULL, NULL);


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
  `visit_time` varchar(50) DEFAULT NULL,
  `patient_notes` text,
  `appointment_reason` varchar(100) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `sync_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('1', '4', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:19', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('2', '4', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:19', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('3', '4', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:20', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('4', '4', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:20', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('5', '4', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:20', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('6', '7', '2', '1', 'Test', 'New Visit', '2018-05-17', '10:38', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('7', '9', '2', '1', 'test', 'New Visit', '2018-05-17', '11:32', 'twat', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('8', '4', '2', '1', 'test 2', 'Established Patient', '2018-05-17', '16:20', 'test2', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('9', '11', '2', '1', 'test', 'New Visit', '2018-05-17', '16:54', 'test', 'head pain', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('10', '9', '2', '1', 'Test', 'Established Patient', '2018-05-17', '17:04', 'Test', '', NULL, NULL, NULL);
INSERT INTO `ck_visit` (`visit_id`, `patient_id`, `userid`, `doctor_id`, `notes`, `type`, `visit_date`, `visit_time`, `patient_notes`, `appointment_reason`, `clinic_id`, `is_deleted`, `sync_status`) VALUES ('11', '8', '3', '2', 'Test', 'New Visit', '2018-05-17', '17:07', 'Test', '', NULL, NULL, NULL);


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

